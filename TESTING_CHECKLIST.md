# ✅ Comprehensive Testing Checklist & QA Protocol

> **Document Version:** 1.0.0  
> **Test Harness:** Pest PHP 3.x / PHPUnit 11.x, Chrome Extension Manual Harness & API Assertions  
> **Target:** AmanProjects CRM, API v1 & LeadHarvest Extension  
> **Status:** Production Readiness Checklist

---

## 1. Test Architecture & Coverage Goals

The testing strategy validates functionality across 5 levels:

```
┌────────────────────────────────────────────────────────┐
│  Level 5: End-to-End User Acceptance Testing (UAT)     │
├────────────────────────────────────────────────────────┤
│  Level 4: Chrome Extension Integration Tests (MV3)     │
├────────────────────────────────────────────────────────┤
│  Level 3: Security, Privacy & Compliance Tests         │
├────────────────────────────────────────────────────────┤
│  Level 2: API Feature & Endpoint Integration Tests     │
├────────────────────────────────────────────────────────┤
│  Level 1: Unit Tests (Models, Scoring, Observers)      │
└────────────────────────────────────────────────────────┘
```

---

## 2. Unit Testing Matrix (Pest / PHPUnit)

### 2.1 Eloquent Models & Relational Integrity
- [ ] **`tests/Unit/LeadTest.php`**
  - [ ] Can create a `Lead` model with valid attributes.
  - [ ] Has many `contacts` (`LeadContact` relationship).
  - [ ] Has many `socialProfiles` (`LeadSocialProfile` relationship).
  - [ ] Has many `opportunityAnalyses` and retrieves `latestAnalysis`.
  - [ ] Has many `proposals`.
  - [ ] Soft delete functions properly without cascading deletion of historical logs.
  - [ ] Automatic slug generation operates correctly when slug is omitted.

- [ ] **`tests/Unit/ProposalTest.php`**
  - [ ] Can create a `Proposal` model.
  - [ ] Belongs to a `Lead`.
  - [ ] Has many `proposalItems`.
  - [ ] Belongs to an approving `User` (`approved_by_user_id`).
  - [ ] Generates unique `proposal_number` in format `PROP-YYYY-XXXX`.
  - [ ] Generates cryptographically secure 64-character `public_view_token`.

### 2.2 Opportunity Analysis Engine
- [ ] **`tests/Unit/OpportunityAnalysisEngineTest.php`**
  - [ ] Calculates `web_score` correctly (+100 for missing website, +35 for missing viewport, +30 for HTTP-only).
  - [ ] Calculates `mobile_score` correctly based on business category and high review volume.
  - [ ] Calculates `seo_score` correctly for low ratings and review counts.
  - [ ] Calculates composite `overall_score` applying accurate weights (35% web, 25% app, 20% SEO, 20% brand).
  - [ ] Correctly identifies and maps deficits to active `services` and `plans` database rows.

### 2.3 Pricing & Proposal Engine
- [ ] **`tests/Unit/ProposalGeneratorTest.php`**
  - [ ] Strict enforcement: Rejects any item without valid `service_id` or `plan_id` in database.
  - [ ] Correctly calculates subtotal, discounts, taxes, and final total.
  - [ ] Defaults newly generated proposal to `status: draft` and `approved_at: null`.
  - [ ] Prevents setting status to `sent` or `dispatched` if `approved_by_user_id` is null.

---

## 3. API Feature & Integration Tests

### 3.1 Authentication & Token Lifecycle (`tests/Feature/Api/AuthTest.php`)
- [ ] `POST /api/v1/auth/token` succeeds with valid admin credentials.
- [ ] `POST /api/v1/auth/token` fails with `401 Unauthorized` for bad credentials.
- [ ] `POST /api/v1/auth/token` enforces rate limit (max 5 attempts per minute).
- [ ] Token has limited abilities (`leads:sync`, `leads:validate`, `leads:read`).
- [ ] `GET /api/v1/auth/me` returns operator profile with valid Bearer token.
- [ ] `GET /api/v1/auth/me` returns `401 Unauthorized` when token is missing or forged.
- [ ] `POST /api/v1/auth/revoke` successfully invalidates token.

### 3.2 Lead Synchronization & Idempotency (`tests/Feature/Api/LeadSyncTest.php`)
- [ ] `POST /api/v1/leads/sync` creates new lead record and sub-entities with valid payload.
- [ ] `POST /api/v1/leads/sync` rejects request without `X-Idempotency-Key` header with `400 Bad Request`.
- [ ] Identical request with same `X-Idempotency-Key` returns cached replay without creating duplicate DB rows.
- [ ] Request with same `X-Idempotency-Key` but modified payload returns `409 Conflict`.
- [ ] Automatically detects duplicate leads by `google_place_id`.
- [ ] Automatically detects duplicate leads by `normalized_domain` and `primary_phone`.
- [ ] Creates appropriate `sync_batches` and `integration_logs` entries.

### 3.3 Contact Validation Service (`tests/Feature/Api/ContactValidationTest.php`)
- [ ] Validates valid E.164 phone numbers (`+919876543210`).
- [ ] Rejects malformed phone strings (`12345`, `abcdef`).
- [ ] Validates syntactically correct email addresses with live MX records.
- [ ] Flags disposable/blacklisted email domains (`mailinator.com`, `tempmail.com`).

---

## 4. Chrome Extension Functional Tests (LeadHarvest)

### 4.1 UI & Settings Panel
- [ ] Settings tab renders inputs for API URL and Bearer token.
- [ ] "Test Connection" button performs `GET /api/v1/auth/me` and displays success/failure pill.
- [ ] Credentials correctly persist in `chrome.storage.local` across browser restarts.
- [ ] Changing tabs or opening dashboard does not erase saved credentials.

### 4.2 Lead Dashboard Sync Flow
- [ ] Dashboard displays Tabulator table with checkbox column for selection.
- [ ] "Sync Selected to AmanProjects" button enables only when 1+ leads are selected.
- [ ] Sync action displays loading spinner with progress indicator (`Syncing 3 of 10...`).
- [ ] Successfully synced rows display green `Synced ✓` pill with lead ID.
- [ ] Duplicates display amber `Duplicate ⚠️` pill.
- [ ] Network errors display red `Retry ↻` pill without losing scraped leads from table.

---

## 5. Security, Compliance & Privacy Tests

### 5.1 ToS & Legal Compliance
- [ ] Verify that no background cron or headless automation runs unattended against Google Maps.
- [ ] Verify that lead ingestion requires operator-initiated action.
- [ ] Verify that provenance source and URL are recorded on every lead.

### 5.2 Opt-Out & Anonymization
- [ ] `POST /api/v1/leads/{id}/opt-out` marks lead `is_opted_out = true`.
- [ ] Scrubs `business_name`, `phone`, `email`, and `address` from `leads` and `lead_contacts`.
- [ ] Inserts hashed identifiers into `lead_opt_outs` table.
- [ ] Subsequent sync attempts matching opted-out hashes are rejected with `SKIPPED_OPTED_OUT`.

### 5.3 Automated Data Retention
- [ ] `php artisan leads:prune-retention` identifies leads older than 90 days.
- [ ] Successfully soft-deletes leads with no active proposals or conversions.
- [ ] Retains leads with active/accepted proposals.

---

## 6. End-to-End User Acceptance Walkthrough (UAT)

| Step | Action | Expected Result | Pass/Fail |
|---|---|---|---|
| **1** | Open LeadHarvest extension popup in Chrome | Popup renders smoothly; settings tab accessible | [ ] |
| **2** | Enter AmanProjects API URL & Admin credentials | Authenticates and returns Bearer token | [ ] |
| **3** | Conduct prospect research on Google Maps | Leads populate in LeadHarvest dashboard | [ ] |
| **4** | Select 2 leads and click "Sync to AmanProjects CRM" | Contacts validated; API returns `200 OK`; badges turn green | [ ] |
| **5** | Log into AmanProjects Admin Panel (`/admin`) | New leads appear in Leads Manager with "New" status | [ ] |
| **6** | Open Lead Dossier and click "Run Digital Audit" | Opportunity scorecard displays breakdown (0–100) | [ ] |
| **7** | Click "Generate Draft Proposal" | Proposal draft created using DB prices; status is `draft` | [ ] |
| **8** | Review quotation, adjust discount, and click "Approve" | Status updates to `approved`; dispatch link unlocked | [ ] |
| **9** | Open public proposal link in incognito browser | Clean client-facing proposal loads; accept button works | [ ] |
| **10**| Click "Accept Proposal" as client | Status updates to `accepted`; converts to active Project | [ ] |
