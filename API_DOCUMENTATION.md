# 🔌 REST API Documentation — AmanProjects API v1

> **Base URL:** `https://amanprojects.com/api/v1` (Production) / `http://localhost/AmanProjects/public/api/v1` (Local)  
> **API Version:** `v1`  
> **Authentication:** Bearer Token via Laravel Sanctum  
> **Standard:** OpenAPI 3.0 & RFC 7807 Problem Details  
> **Format:** `application/json`

---

## 1. Authentication & Security Headers

All requests to protected endpoints must supply an `Authorization` header containing a valid Sanctum personal access token:

```http
Authorization: Bearer 1|a8f9c0e2d4b6...
Accept: application/json
Content-Type: application/json
X-Client-Name: LeadHarvest
X-Client-Version: 1.9.1
```

For state-mutating requests (such as lead synchronization), an `X-Idempotency-Key` header is strictly required to guarantee zero duplicates on retry.

---

## 2. Endpoints Overview

| Method | Endpoint | Auth | Purpose |
|---|---|---|---|
| `POST` | `/api/v1/auth/token` | Public | Authenticate extension user and issue Sanctum token |
| `GET` | `/api/v1/auth/me` | Bearer | Verify token validity and return current operator profile |
| `POST` | `/api/v1/auth/revoke` | Bearer | Revoke current extension token |
| `GET` | `/api/v1/services` | Bearer | Retrieve active service catalog, pricing tiers, and process steps |
| `POST` | `/api/v1/leads/sync` | Bearer | Idempotent single/batch lead synchronization |
| `GET` | `/api/v1/leads` | Bearer | List leads with filtering, search, and pagination |
| `GET` | `/api/v1/leads/{id}` | Bearer | Retrieve comprehensive lead dossier |
| `POST` | `/api/v1/leads/validate-contact`| Bearer | Validate phone numbers and email addresses |
| `POST` | `/api/v1/leads/{id}/analyze` | Bearer | Trigger digital opportunity analysis for a lead |
| `POST` | `/api/v1/leads/{id}/proposals` | Bearer | Generate draft proposal based on analyzed gaps |
| `POST` | `/api/v1/leads/{id}/opt-out` | Bearer | Register prospect opt-out and scrub identifiable data |

---

## 3. Detailed Endpoint Specifications

### 3.1 `POST /api/v1/auth/token`
Generate a new personal access token for the LeadHarvest extension.

**Request Headers:**
```http
Content-Type: application/json
Accept: application/json
```

**Request Body:**
```json
{
  "email": "admin@amanprojects.com",
  "password": "SecurePassword123!",
  "device_name": "LeadHarvest_Chrome_Extension_Office_PC"
}
```

**Response `200 OK`:**
```json
{
  "status": "success",
  "data": {
    "token": "3|Kj8s9d7f6a5s4d3f2g1h...",
    "token_type": "Bearer",
    "expires_at": "2027-11-14T12:00:00Z",
    "user": {
      "id": 1,
      "name": "Aman Technical",
      "email": "admin@amanprojects.com",
      "roles": ["super-admin"]
    }
  }
}
```

**Error `401 Unauthorized`:**
```json
{
  "status": "error",
  "error_code": "INVALID_CREDENTIALS",
  "message": "The provided credentials do not match our records."
}
```

---

### 3.2 `GET /api/v1/auth/me`
Test connection validity from the LeadHarvest extension settings panel.

**Request Headers:**
```http
Authorization: Bearer 3|Kj8s9d7f6a5s4d3f2g1h...
Accept: application/json
```

**Response `200 OK`:**
```json
{
  "status": "success",
  "data": {
    "user_id": 1,
    "name": "Aman Technical",
    "email": "admin@amanprojects.com",
    "roles": ["super-admin"],
    "permissions": ["manage_leads", "approve_proposals"]
  }
}
```

---

### 3.3 `POST /api/v1/leads/sync`
Synchronize one or more leads collected by the extension into the AmanProjects CRM.

**Request Headers:**
```http
Authorization: Bearer 3|Kj8s9d7f6a5s4d3f2g1h...
Content-Type: application/json
Accept: application/json
X-Idempotency-Key: c9d8e7f6-5a4b-3c2d-1e0f-9a8b7c6d5e4f
```

**Request Body:**
```json
{
  "batch_metadata": {
    "client_name": "LeadHarvest",
    "client_version": "1.9.1",
    "keyword": "digital marketing agency in mumbai",
    "captured_at": "2026-11-14T12:30:00Z"
  },
  "leads": [
    {
      "business_name": "Apex Digital Solutions",
      "category": "Marketing Agency",
      "website": "https://apexdigital.in",
      "primary_phone": "+919876543210",
      "primary_email": "contact@apexdigital.in",
      "address": "402, Platinum Tower, Andheri East, Mumbai, Maharashtra 400069",
      "latitude": 19.1136,
      "longitude": 72.8697,
      "google_place_id": "ChIJN1t_tDeuEmsRUsoyG83frY4",
      "google_cid": "1234567890123456789",
      "rating": 4.6,
      "review_count": 84,
      "provenance_source": "extension_assisted",
      "provenance_url": "https://www.google.com/maps/search/digital+marketing+agency+in+mumbai",
      "contacts": [
        {
          "type": "email",
          "value": "contact@apexdigital.in",
          "is_primary": true
        },
        {
          "type": "phone",
          "value": "+91 98765 43210",
          "is_primary": true
        }
      ],
      "social_profiles": [
        {
          "platform": "linkedin",
          "profile_url": "https://www.linkedin.com/company/apexdigital"
        },
        {
          "platform": "instagram",
          "profile_url": "https://www.instagram.com/apexdigital"
        }
      ]
    }
  ]
}
```

**Response `200 OK` (Processed):**
```json
{
  "status": "success",
  "data": {
    "sync_batch_id": 42,
    "idempotency_key": "c9d8e7f6-5a4b-3c2d-1e0f-9a8b7c6d5e4f",
    "summary": {
      "total": 1,
      "inserted": 1,
      "updated": 0,
      "duplicates_skipped": 0,
      "failed": 0
    },
    "results": [
      {
        "google_place_id": "ChIJN1t_tDeuEmsRUsoyG83frY4",
        "lead_id": 105,
        "action": "inserted",
        "status": "new"
      }
    ]
  }
}
```

**Response `200 OK` (Idempotent Replay):**
*If the exact same `X-Idempotency-Key` and payload are received again, the exact same response is returned without creating duplicates.*

---

### 3.4 `POST /api/v1/leads/validate-contact`
Validates phone numbers or email addresses using offline syntax checkers and live DNS/network probes.

**Request Body:**
```json
{
  "items": [
    {
      "type": "email",
      "value": "info@sampledomain.com"
    },
    {
      "type": "phone",
      "value": "+919876543210"
    }
  ]
}
```

**Response `200 OK`:**
```json
{
  "status": "success",
  "data": {
    "results": [
      {
        "type": "email",
        "value": "info@sampledomain.com",
        "normalized": "info@sampledomain.com",
        "is_syntax_valid": true,
        "is_disposable": false,
        "has_mx_records": true,
        "overall_valid": true
      },
      {
        "type": "phone",
        "value": "+919876543210",
        "normalized": "+919876543210",
        "is_e164_valid": true,
        "country_code": "IN",
        "line_type": "mobile",
        "overall_valid": true
      }
    ]
  }
}
```

---

### 3.5 `POST /api/v1/leads/{id}/analyze`
Analyzes a lead's digital presence and generates opportunity scores.

**Response `200 OK`:**
```json
{
  "status": "success",
  "data": {
    "lead_id": 105,
    "analysis_id": 28,
    "overall_opportunity_score": 78,
    "scores": {
      "web_presence": 35,
      "mobile_readiness": 40,
      "seo_optimization": 25,
      "reputation_authority": 85
    },
    "identified_deficiencies": [
      {
        "code": "NO_MOBILE_VIEWPORT",
        "severity": "high",
        "description": "Website lacks responsive viewport tag and fails mobile audit."
      },
      {
        "code": "MISSING_SCHEMA_MARKUP",
        "severity": "medium",
        "description": "No LocalBusiness or Organization JSON-LD structured data detected."
      },
      {
        "code": "SLOW_TTFB",
        "severity": "medium",
        "description": "Server response time exceeds 1.8 seconds."
      }
    ],
    "recommended_services": [
      {
        "service_id": 1,
        "service_title": "Custom Responsive Web Development",
        "recommended_plan_id": 2,
        "plan_title": "Professional Business Suite",
        "standard_price": 25000,
        "currency": "INR",
        "fit_reason": "Addresses mobile-readiness deficit and modernizes tech stack."
      }
    ]
  }
}
```

---

### 3.6 `POST /api/v1/leads/{id}/proposals`
Creates a draft proposal for an analyzed lead. The proposal references database prices and defaults to `status: draft` requiring human approval.

**Request Body:**
```json
{
  "title": "Comprehensive Web Modernization & Mobile Optimization",
  "currency": "INR",
  "valid_until": "2026-12-14",
  "items": [
    {
      "service_id": 1,
      "plan_id": 2,
      "item_title": "Professional Responsive Web Platform",
      "item_description": "Full redesign with mobile-first layout, SEO optimization, and speed tuning.",
      "unit_price": 25000,
      "quantity": 1
    }
  ],
  "discount_amount": 2000,
  "terms_and_conditions": "50% upfront deposit, balance due upon project deployment."
}
```

**Response `201 Created`:**
```json
{
  "status": "success",
  "data": {
    "proposal_id": 14,
    "proposal_number": "PROP-2026-0014",
    "status": "draft",
    "is_approved": false,
    "subtotal": 25000.00,
    "discount": 2000.00,
    "total": 23000.00,
    "public_view_token": "a1b2c3d4e5f6...",
    "approval_notice": "Proposal requires human approval in the Admin Panel before dispatch."
  }
}
```

---

### 3.7 `POST /api/v1/leads/{id}/opt-out`
Prospect privacy opt-out endpoint. Scrubs personal data and logs privacy hash.

**Request Body:**
```json
{
  "reason": "Business owner requested exclusion from prospecting."
}
```

**Response `200 OK`:**
```json
{
  "status": "success",
  "message": "Lead successfully opted out and identifiable records scrubbed.",
  "data": {
    "lead_id": 105,
    "is_opted_out": true,
    "anonymized_at": "2026-11-14T12:45:00Z"
  }
}
```

---

## 4. API Error Handling (RFC 7807)

When an error occurs, the API returns standard HTTP error codes with detailed JSON payloads:

```json
{
  "type": "https://amanprojects.com/errors/validation-error",
  "title": "Validation Failed",
  "status": 422,
  "detail": "The primary_phone must be formatted in valid E.164 notation.",
  "invalid_params": [
    {
      "name": "leads.0.primary_phone",
      "reason": "Invalid international phone format."
    }
  ]
}
```

### Common Error Codes:
- `400 BAD_REQUEST`: Missing headers, invalid payload syntax.
- `401 UNAUTHORIZED`: Invalid, revoked, or expired Bearer token.
- `403 FORBIDDEN`: Insufficient role permissions or account deactivated.
- `409 CONFLICT`: Idempotency key mismatch with distinct payload hash.
- `422 UNPROCESSABLE_ENTITY`: Schema validation errors.
- `429 TOO_MANY_REQUESTS`: Rate limit exceeded (`throttle:60,1`).
- `500 INTERNAL_SERVER_ERROR`: Unhandled server exception (logged in `storage/logs`).
