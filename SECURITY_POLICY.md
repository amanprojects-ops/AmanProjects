# 🛡️ Security, Privacy & Compliance Policy

> **Document Version:** 1.0.0  
> **Classification:** Security Governance & Regulatory Compliance  
> **Applies to:** AmanProjects (CRM & REST API) and LeadHarvest (Chrome Extension)  
> **Standard:** GDPR, CCPA, OWASP Top 10, Google Maps Platform ToS

---

## 1. Authentication & Credential Architecture

### 1.1 Laravel Sanctum Token Standards
- **Token Type:** Cryptographically random 64-character SHA-256 hashed Bearer tokens managed via Laravel Sanctum.
- **Issuance:** Tokens are issued exclusively over HTTPS via `POST /api/v1/auth/token` with valid operator credentials.
- **Token Scope & Abilities:** Tokens issued to the Chrome extension are scoped specifically to `["leads:sync", "leads:validate", "leads:read"]`. They are prevented from performing administrative actions (e.g. updating system settings, managing users, or deleting backups).
- **Expiration Policy:** Tokens expire after 365 days unless explicitly revoked.
- **Revocation:** Tokens can be revoked instantly by the operator from either the extension UI or the AmanProjects Admin Settings panel.

### 1.2 Extension Credential Isolation (Rule 8)
- **Zero Hardcoded Secrets:** Neither API tokens, passwords, nor private endpoints shall ever be committed to git or bundled in the extension source code (`manifest.json`, `bg.js`, `popup.js`, etc.).
- **Client Storage:** Tokens entered by the operator are persisted exclusively in `chrome.storage.local`, which is sandboxed per-extension by the Chromium browser and inaccessible to regular web pages.
- **Memory Protection:** Background service workers clear credential objects from active memory when not in use.

---

## 2. Network & API Protection Layer

```
┌────────────────────────┐         HTTPS / TLS 1.3
│  LeadHarvest Client    │───────────────────────────────────┐
└────────────────────────┘                                   ▼
                                                  ┌─────────────────────┐
┌────────────────────────┐         HTTPS / TLS 1.3│  CORS White-list    │
│  Admin Web Browser     │───────────────────────▶│  (Origin Check)     │
└────────────────────────┘                        └──────────┬──────────┘
                                                             │
                                                             ▼
                                                  ┌─────────────────────┐
                                                  │  Rate Limiting      │
                                                  │  (throttle:60,1)    │
                                                  └──────────┬──────────┘
                                                             │
                                                             ▼
                                                  ┌─────────────────────┐
                                                  │  Sanctum Auth Guard │
                                                  │  (Ability Check)    │
                                                  └──────────┬──────────┘
                                                             │
                                                             ▼
                                                  ┌─────────────────────┐
                                                  │  Idempotent Check   │
                                                  │  (X-Idempotency-Key)│
                                                  └─────────────────────┘
```

### 2.1 Cross-Origin Resource Sharing (CORS)
- `config/cors.php` restricts API access to authorized domain origins and the specific extension protocol:
  - Allowed Origins: `https://amanprojects.com`, `chrome-extension://<EXTENSION_ID>`
  - Allowed Methods: `GET`, `POST`, `PUT`, `DELETE`, `OPTIONS`
  - Allowed Headers: `Authorization`, `Content-Type`, `Accept`, `X-Idempotency-Key`, `X-Client-Name`, `X-Client-Version`
  - Exposed Headers: `X-RateLimit-Limit`, `X-RateLimit-Remaining`

### 2.2 Rate Limiting & Denial of Service Defense
- API endpoints are throttled using Laravel's Redis/Database cache limiter:
  - Token Issuance: `5 attempts per minute` (`throttle:5,1`)
  - Lead Sync & Contact Validation: `60 requests per minute` (`throttle:60,1`)
  - Public Proposal Views: `30 requests per minute` (`throttle:30,1`)

### 2.3 Input Sanitization & SQL Injection Defense
- All incoming payloads pass through dedicated Form Request classes (`SyncLeadRequest`, `ValidateContactRequest`).
- Strict Eloquent ORM parameter binding prevents SQL injection.
- String fields are sanitized via `App\Helpers\HtmlPurifier` to strip malicious script tags, iframes, and onerror handlers.

---

## 3. Google Maps Platform Terms of Service Compliance (Rule 16)

### 3.1 Regulatory Analysis of Google Maps ToS (Section 3.2.3)
Google Maps Terms of Service explicitly prohibit:
> *"Scraping, systematic database extraction, or bulk export of Google Maps Content for use in an external database or service without Google's prior written authorization."*

### 3.2 Platform Compliance Policy:
To ensure 100% legal adherence and ethical operation:
1. **No Automated Mass Scraping:** The system does not run headless bots, automated pagination loops, or background scrapers feeding directly into the database.
2. **Human-Guided Prospecting Assistant:** LeadHarvest functions exclusively as an **in-browser research assistant for manual, operator-initiated prospecting**.
3. **Independent Data Verification:** Any business detail identified during research must be verified against independent, publicly accessible sources (e.g. the business's own website contact page, official corporate registry, or direct business communication).
4. **Non-Redistribution:** Lead data stored in AmanProjects CRM is used exclusively for 1-to-1 client outreach by the agency and is never sold, brokered, or redistributed as a commercial database.

---

## 4. Privacy, Data Provenance & Opt-Out Controls (Rule 15)

### 4.1 Data Provenance Tracking
Every ingested lead record is stamped with immutable provenance metadata:
- `provenance_source`: Method of discovery (`manual_entry`, `extension_assisted`, `public_registry`).
- `provenance_url`: Exact public URL where contact information was verified.
- `captured_at`: UTC timestamp of the capture.
- `assigned_user_id`: Operator ID responsible for the record.

### 4.2 Prospect Opt-Out & Right to be Forgotten (GDPR / CCPA)
1. **Opt-Out Endpoint:** `POST /api/v1/leads/{id}/opt-out` allows immediate exclusion.
2. **Permanent Anonymization:**
   - The prospect's `business_name`, `phone`, `email`, and `address` are permanently scrubbed from the `leads` and `lead_contacts` tables.
   - Irreversible SHA-256 hashes of the email, phone, and domain are stored in the `lead_opt_outs` blacklist table.
   - Any future sync attempt matching a blacklisted hash is automatically rejected at the API layer with status `SKIPPED_OPTED_OUT`.

### 4.3 Automated Data Retention Policy
- Unconverted leads with no active proposals or communications are automatically soft-deleted after **90 days** (`retention_until` timestamp).
- A scheduled cron job (`php artisan leads:prune-retention`) runs weekly to clean up stale records and optimize database performance.

---

## 5. Audit Logging & Security Event Monitoring

1. **`activity_logs` Table:** Records all user events:
   - Login attempts (successful & failed with IP and User-Agent).
   - Lead creation, modification, export, and deletion.
   - Proposal approval, dispatch, and client acceptance.
2. **`integration_logs` Table:** Captures API payload hashes, HTTP response codes, latency metrics, and failure traces for debugging and non-repudiation.
3. **Log Sanitization:** Passwords, API tokens, credit card details, and full contact hashes are masked (`***`) before being written to persistent log files.
