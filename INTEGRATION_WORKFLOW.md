# 🔄 End-to-End Integration & Prospecting Workflow

> **Document Version:** 1.0.0  
> **Systems Involved:** LeadHarvest (Chrome MV3 Extension) & AmanProjects (Laravel 12 API / CRM)  
> **Standard:** Enterprise Asynchronous Pipeline with Idempotency Guarantees

---

## 1. High-Level Prospecting Lifecycle

The end-to-end client acquisition journey transitions through eight distinct stages across the client-extension and server-CRM boundary:

```
┌────────────────────────────────────────────────────────────────────────────────────────┐
│                                 LEADHARVEST (CLIENT)                                   │
└───────────────────────────────────────────┬────────────────────────────────────────────┘
                                            │
                                            ▼
                 [Stage 1: Business Research & Public Discovery]
                  Operator targets niche & reviews public listings.
                                            │
                                            ▼
                 [Stage 2: Client-Side Contact Verification]
                  Offline regex checks + Online MX/DNS probes.
                                            │
                                            ▼
                 [Stage 3: Idempotent REST API Synchronization]
                  Secure push to AmanProjects via Sanctum Bearer Token.
                                            │
┌───────────────────────────────────────────┴────────────────────────────────────────────┐
│                                 AMANPROJECTS (SERVER)                                  │
└───────────────────────────────────────────┬────────────────────────────────────────────┘
                                            │
                                            ▼
                 [Stage 4: CRM Ingestion & Deduplication]
                  Multi-key deduplication (Place ID, normalized phone/domain).
                                            │
                                            ▼
                 [Stage 5: Digital Opportunity & Gap Analysis]
                  Deficit scoring (Web 35%, App 25%, SEO 20%, Brand 20%).
                                            │
                                            ▼
                 [Stage 6: Service Recommendation & Proposal Draft]
                  Automated mapping to active DB catalog services & plans.
                                            │
                                            ▼
                 [Stage 7: Mandatory Human Review & Approval]
                  Operator inspects proposal in Admin UI & signs off.
                                            │
                                            ▼
                 [Stage 8: Client Conversion & Project Handover]
                  Client accepts proposal; project initialized in AmanProjects.
```

---

## 2. Sequence Diagrams

### 2.1 Extension Authentication & Health Check Workflow

```mermaid
sequenceDiagram
    autonumber
    actor Operator
    participant Popup as LeadHarvest Popup UI
    participant Storage as chrome.storage.local
    participant API as AmanProjects API (/api/v1)
    participant DB as MySQL Database

    Operator->>Popup: Enter API URL, Email & Password
    Popup->>API: POST /auth/token {email, password, device_name}
    API->>DB: Verify credentials & role (Admin/Super-Admin)
    alt Credentials Valid
        DB-->>API: User authenticated
        API->>DB: Insert personal_access_tokens record
        API-->>Popup: 200 OK {token, expires_at, user}
        Popup->>Storage: Store token & api_url securely
        Popup-->>Operator: Display "Connected to AmanProjects ✓"
    else Invalid Credentials
        API-->>Popup: 401 Unauthorized {error: "INVALID_CREDENTIALS"}
        Popup-->>Operator: Display error notification
    end

    Note over Popup, API: Verification Ping
    Popup->>API: GET /auth/me (Authorization: Bearer <TOKEN>)
    API-->>Popup: 200 OK {user_id, name, permissions}
```

---

### 2.2 Lead Synchronization & Idempotency Workflow

```mermaid
sequenceDiagram
    autonumber
    actor Operator
    participant Ext as LeadHarvest Dashboard
    participant Validator as Extension Validator
    participant API as AmanProjects API (/api/v1/leads/sync)
    participant Mid as Idempotency Middleware
    participant DB as MySQL Database

    Operator->>Ext: Select Leads & Click "Sync to CRM"
    Ext->>Validator: Run Offline & Online Validation
    Validator-->>Ext: Validated contacts (E.164 phone, MX verified email)
    
    Ext->>Ext: Generate UUID v4 for X-Idempotency-Key
    Ext->>API: POST /leads/sync with X-Idempotency-Key & Payload
    
    API->>Mid: Check sync_batches for Idempotency Key
    alt Idempotency Key Exists (Duplicate / Retry)
        Mid->>DB: Fetch existing batch result
        Mid-->>Ext: 200 OK (Replay cached response, zero duplicates)
    else New Request
        Mid->>DB: Create sync_batches record (status: 'processing')
        loop For Each Lead in Payload
            API->>DB: Check duplicate (place_id OR phone OR domain)
            alt Duplicate Found
                API->>DB: Update lead (if newer) or mark SKIPPED
            else Unique Lead
                API->>DB: Insert into leads, lead_contacts, lead_social_profiles
            end
        end
        API->>DB: Update sync_batches (status: 'completed', counts)
        API-->>Ext: 200 OK {batch_id, summary: {inserted, updated, skipped}}
        Ext-->>Operator: Update UI badges to "Synced ✓"
    end
```

---

### 2.3 Opportunity Analysis & Proposal Approval Workflow

```mermaid
sequenceDiagram
    autonumber
    actor Admin
    participant AdminUI as AmanProjects Admin
    participant Engine as Opportunity Analysis Engine
    participant ProposalSvc as Proposal Generator
    participant DB as MySQL Database
    actor Client

    Admin->>AdminUI: Open Lead Dossier (admin/leads/{id})
    Admin->>Engine: Click "Run Digital Audit"
    Engine->>Engine: Calculate Scores (Web, App, SEO, Brand)
    Engine->>DB: Store record in opportunity_analyses
    Engine->>AdminUI: Display Scorecard (e.g. Score: 78 - High Need)

    Admin->>ProposalSvc: Click "Generate Draft Proposal"
    ProposalSvc->>DB: Query active services & plans for best fit
    ProposalSvc->>DB: Insert proposals (status: 'draft', is_approved: 0)
    ProposalSvc->>DB: Insert proposal_items (linked to service_id, plan_id)
    ProposalSvc-->>AdminUI: Render Proposal Editor

    Admin->>AdminUI: Adjust line items, discount, terms
    Admin->>AdminUI: Click "Approve & Finalize" (Rule 14 Gate)
    AdminUI->>DB: Update proposal (status: 'approved', approved_by_user_id, approved_at)
    AdminUI-->>Admin: Unlock Dispatch & Public Link

    Admin->>Client: Send Proposal Link / PDF
    Client->>AdminUI: Access proposal via public_view_token
    AdminUI->>DB: Record viewed_at timestamp
    Client->>AdminUI: Click "Accept Proposal"
    AdminUI->>DB: Update status to 'accepted'
    AdminUI->>DB: Initialize new Project in AmanProjects
```

---

## 3. LeadHarvest Chrome Extension Upgrades

To support this workflow cleanly, the LeadHarvest extension (`K:\MyExtensions\LeadHarvest`) requires three modular enhancements:

### 3.1 Settings Configuration Module (`js/settings.js`)
- UI fields in `popup.html`:
  - `AmanProjects API Endpoint` (Default: `https://amanprojects.com/api/v1`)
  - `Sanctum API Bearer Token`
  - `Auto-Verify Contacts Before Sync` (Toggle)
  - `Test Connection` button

### 3.2 Dual-Layer Contact Validator (`js/validator.js`)
- **Offline Phone Validation:**
  - Standardizes raw input to E.164 international format (`+<country_code><number>`).
  - Regex checks for mobile vs landline prefixes based on territory.
- **Offline Email Validation:**
  - Strict RFC 5322 syntax validation.
  - Blacklist filter for fake/sample domains (`test.com`, `example.com`, `domain.com`).
- **Online DNS/MX Probing:**
  - Calls `POST /api/v1/leads/validate-contact` to verify active MX DNS records on target recipient domains before CRM transmission.

### 3.3 Dashboard Sync Controller (`js/sync-controller.js`)
- Extends Tabulator table in `dashboard.html`:
  - Adds checkbox selection for individual leads.
  - Adds **"Sync Selected to AmanProjects CRM"** button.
  - Displays real-time status pills: `⏳ Validating`, `🔄 Syncing`, `✅ Synced (ID: 105)`, `⚠️ Duplicate`, `❌ Failed`.
