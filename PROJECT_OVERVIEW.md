# 📋 AmanProjects & LeadHarvest Platform Overview

> **Document Version:** 1.0.0  
> **Classification:** Architectural Blueprint & Repository Audit  
> **Target Environment:** AmanProjects (Laravel 12 CRM / API Server) & LeadHarvest (Manifest V3 Chrome Extension)  
> **Status:** Approved Architecture Definition

---

## 1. Executive Summary

This enterprise platform bridges the gap between digital prospecting and client acquisition. It connects **LeadHarvest** (a high-precision client-side prospecting Chrome extension) with **AmanProjects** (a production-grade Laravel 12 agency CRM, portfolio, and service platform) via a secure, idempotent REST API.

The platform transforms raw prospecting into an end-to-end, human-supervised client acquisition lifecycle:

```
┌─────────────────┐       ┌──────────────────────┐       ┌──────────────────┐
│  LeadHarvest    │       │     AmanProjects     │       │ Opportunity      │
│  Prospecting    │──────▶│      Sanctum API     │──────▶│ Analysis Engine  │
│  & Validation   │       │   (Idempotent Sync)  │       │ (Gap Scoring)    │
└─────────────────┘       └──────────────────────┘       └────────┬─────────┘
                                                                  │
┌─────────────────┐       ┌──────────────────────┐                ▼
│ Client Active   │       │ Human-Approved       │       ┌──────────────────┐
│ Project Delivery│◀──────│ Proposal & Quotation │◀──────│ Recommended Svc  │
│ (AmanProjects)  │       │ (Tied to DB Pricing) │       │ (Web / App / SEO)│
└─────────────────┘       └──────────────────────┘       └──────────────────┘
```

---

## 2. Platform Objectives

1. **Centralized CRM System:** Maintain `AmanProjects` as the single authoritative source of truth for all business leads, opportunities, proposals, and projects.
2. **Decoupled Prospecting Client:** Retain `LeadHarvest` as an independent Manifest V3 extension operating within Chrome security sandbox guidelines.
3. **Multi-Stage Lead Verification:** Validate business phone numbers (E.164 and telecom line formats), emails (offline syntax + MX/DNS verification), and websites before CRM ingestion.
4. **Intelligent Opportunity Scoring:** Quantify a prospect's digital deficiencies (no website, poor mobile UX, lack of structured SEO, weak social presence) into actionable opportunities.
5. **Dynamic Service Recommendation:** Automatically map identified digital deficiencies directly to AmanProjects catalog services (`Web Development`, `Mobile Applications`, `Custom SaaS`, `SEO & Branding`).
6. **Compliant & Transparent Prospecting:** Strictly honor platform Terms of Service (including Google Maps ToS), data provenance standards, opt-out mechanics, and automated retention rules.
7. **Strict Human Oversight:** Mandate human-in-the-loop validation for all opportunity scores and pricing proposals before any client communication occurs.

---

## 3. Existing Architecture Assessment

### 3.1 AmanProjects (Primary Backend & CRM)

- **Framework:** Laravel 12.0 on PHP 8.2+
- **Database:** MariaDB / MySQL with Eloquent ORM
- **Frontend Engine:** Blade templates styled with Tailwind CSS, MDB5 UI Kit, and Alpine.js
- **Current Core Capabilities:**
  - **Identity & RBAC:** Multi-role authorization (`super-admin`, `admin`, `user`) with fine-grained permissions (`RoleMiddleware`, `PermissionMiddleware`, `AdminMiddleware`).
  - **Portfolio & Project Management:** `Project` model with tech tags, hero cropper, gallery albums (`Album`, `AlbumImage`), status tracking, and slug generators.
  - **Service Catalog & Pricing:** `Service` and `Plan` models supporting multi-tier pricing, process timelines, feature checklists, and rich FAQs.
  - **Contact & Inquiries:** `Contact` model capturing inbound web submissions with reply timestamps and unread state scopes.
  - **SEO & Performance:** Granular cache busting observers, multi-sitemap generators (`sitemap-projects.xml`, `sitemap-blogs.xml`, etc.), and dynamic JSON-LD schema generation.
  - **System Administration:** Dynamic branding live sync, SMTP configuration tester, activity logging, and script injection.

### 3.2 LeadHarvest (Chrome Extension Client)

- **Platform:** Chrome Extension Manifest V3 (`manifest_version: 3`)
- **Location:** `K:\MyExtensions\LeadHarvest`
- **Core Components:**
  - `manifest.json`: Configured with `storage`, `scripting`, `tabs`, and broad host permissions.
  - `bg.js` (Service Worker): Background handler managing multi-keyword queues, tab updates, contact page link resolution, and social link normalizers.
  - `contentScript.js`: Embedded panel injected into Google Maps DOM (`.w6VYqd`), controlling extraction and local deduplication via Place IDs.
  - `injected.js`: Interceptor hooking `XMLHttpRequest` to capture asynchronous search result payloads.
  - `popup.html` / `popup.js`: User interface for multi-keyword entry, queue progress visualization, and status tracking.
  - `dashboard.html` / `dashboard.js`: In-browser Tabulator data grid rendering extracted records with CSV/XLSX export.
  - `lib/`: Tabulator, Axios, ECharts, and SheetJS libraries.

---

## 4. Architectural Gap Analysis & Missing Components

| Component | Current State | Required State for Platform Integration |
|---|---|---|
| **API Infrastructure** | No `routes/api.php`, no API routing configured in `bootstrap/app.php` | Dedicated versioned API router (`/api/v1/`) with CORS and throttling |
| **API Authentication** | Web session only (`auth:web`) | **Laravel Sanctum** personal access tokens for machine-to-machine extension auth |
| **Lead Entity** | Basic `contacts` table (inbound web submissions only) | Comprehensive `leads` table with place IDs, coordinates, verification states, and provenance |
| **Lead Sub-Entities** | Unnormalized columns in contact table | Normalized `lead_contacts`, `lead_social_profiles`, and `lead_validation_logs` |
| **Idempotent Ingestion** | Not implemented | `sync_batches` with `X-Idempotency-Key` and SHA-256 payload verification |
| **Opportunity Engine** | Non-existent | `OpportunityAnalyzer` evaluating digital footprint gaps (Web, App, SEO, Reputation) |
| **Proposal System** | Static plans only (`Plan` model) | Dynamic `Proposal` and `ProposalItem` models linked to `Service` and `Plan` catalog |
| **Human Approval Gate** | Not required for existing contacts | Strict state machine (`draft` → `under_review` → `approved` → `dispatched`) |
| **Compliance & Opt-Out** | Missing | `lead_opt_outs` table, provenance audit logs, and automatic 90-day pruning policies |
| **Extension API Client** | Standalone local storage only | Secure settings panel for API URL + Bearer token, sync queue, and direct API client |

---

## 5. Scope Boundaries & Compliance Rules

### 5.1 Google Maps Terms of Service & Scraping Governance (Rule 16)
- **Direct Automation Ban:** Automated bulk crawling or systematic scraping of Google Maps content directly into an external database violates Google Maps Platform Terms of Service.
- **Permissible Usage Pattern:**
  - LeadHarvest must function solely as a **client-side research and verification assistant**.
  - All synchronization into AmanProjects CRM requires **manual operator inspection, curation, or independent business data entry**.
  - Data points must be independently validated against the target business's public web presence (website contact pages, public WHOIS/DNS, registered business registries).
  - Bulk automated database scraping scripts are strictly forbidden from being integrated into the core CRM.

### 5.2 Decoupled Repository Integrity (Rules 1 & 2)
- Under no circumstances will `AmanProjects` and `LeadHarvest` be merged into a monorepo.
- `AmanProjects` remains the single API server and CRM authority.
- `LeadHarvest` remains an independent client communicating over standard HTTPS REST protocols.

---

## 6. Document Roadmap

To execute the project safely without breaking existing production functionality, eight dedicated architectural specifications are provided:

1. [PROJECT_OVERVIEW.md](file:///c:/xampp/htdocs/AmanProjects/PROJECT_OVERVIEW.md) — System boundaries, architecture review, and compliance charter.
2. [IMPLEMENTATION_PLAN.md](file:///c:/xampp/htdocs/AmanProjects/IMPLEMENTATION_PLAN.md) — Phased engineering roadmap, WBS, and risk management.
3. [DATABASE_SCHEMA.md](file:///c:/xampp/htdocs/AmanProjects/DATABASE_SCHEMA.md) — Complete database migrations, tables, keys, and ER diagrams.
4. [API_DOCUMENTATION.md](file:///c:/xampp/htdocs/AmanProjects/API_DOCUMENTATION.md) — OpenAPI v1 REST specifications, request/response payloads, and error codes.
5. [ANALYSIS_LOGIC.md](file:///c:/xampp/htdocs/AmanProjects/ANALYSIS_LOGIC.md) — Digital opportunity scoring formulas, service mappings, and proposal logic.
6. [SECURITY_POLICY.md](file:///c:/xampp/htdocs/AmanProjects/SECURITY_POLICY.md) — Sanctum token lifecycle, CORS, compliance, provenance, and privacy controls.
7. [INTEGRATION_WORKFLOW.md](file:///c:/xampp/htdocs/AmanProjects/INTEGRATION_WORKFLOW.md) — Step-by-step end-to-end data pipelines and sequence diagrams.
8. [TESTING_CHECKLIST.md](file:///c:/xampp/htdocs/AmanProjects/TESTING_CHECKLIST.md) — Verification suite covering Unit, Feature, Extension, and Security tests.
