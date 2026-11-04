<div style="display:grid;grid-template-columns:1fr;gap:20px;margin-bottom:12px;">

    {{-- SECTION 1: BASIC INFORMATION & ROUTING --}}
    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-server" style="color:#6366f1;"></i> 1. Service Identity & URL Slug</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">
            <div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;">
                <div>
                    <label for="title" class="form-label-custom">Service Title <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $service->title ?? '') }}" required
                        class="form-control-custom" placeholder="e.g., Web Development, Mobile App Development…">
                    @error('title')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="badge" class="form-label-custom">Card Badge <small style="color:#94a3b8;font-size:11px;">(optional)</small></label>
                    <input type="text" name="badge" id="badge" value="{{ old('badge', $service->badge ?? '') }}"
                        class="form-control-custom" placeholder="e.g., Most Requested in Saharsa">
                    @error('badge')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="slug" class="form-label-custom">URL Slug <span style="color:#ef4444;">*</span> <small style="color:#94a3b8;font-size:11px;">(High-intent SEO URL, e.g. website-developer-in-saharsa)</small></label>
                <div style="display:flex;align-items:center;background:#f8fafc;border:1px solid #cbd5e1;border-radius:8px;padding:0 12px;">
                    <span style="color:#64748b;font-size:13px;font-family:monospace;">{{ url('/') }}/</span>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $service->slug ?? '') }}"
                        style="border:none;background:transparent;width:100%;padding:10px 4px;font-size:13px;font-weight:600;color:#0f172a;outline:none;"
                        placeholder="website-developer-in-saharsa">
                </div>
                @error('slug')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="tagline" class="form-label-custom">Tagline / Subtitle <small style="color:#94a3b8;font-size:11px;">(Displayed prominently under H1)</small></label>
                <input type="text" name="tagline" id="tagline" value="{{ old('tagline', $service->tagline ?? '') }}"
                    class="form-control-custom" placeholder="e.g., High-Performance, Custom Websites & Web Applications Built with Laravel, React & Next.js">
                @error('tagline')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="desc" class="form-label-custom">Short Summary <small style="color:#94a3b8;font-size:11px;">(Used on homepage card & meta preview, ~150-200 chars)</small></label>
                <textarea name="desc" id="desc" class="form-control-custom" rows="3" placeholder="Pixel-perfect, performant web apps built with Laravel, React, and modern stacks…">{{ old('desc', $service->desc ?? '') }}</textarea>
                @error('desc')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;align-items:center;">
                <div>
                    <label for="sort_order" class="form-label-custom">Display Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}"
                        class="form-control-custom" style="max-width:140px;">
                    @error('sort_order')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div style="margin-top:20px;">
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                            style="width:18px;height:18px;accent-color:#6366f1;">
                        <span style="font-weight:600;font-size:14px;color:#1e293b;">Active & Published on Website</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 2: APPEARANCE & ICONS --}}
    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-palette" style="color:#6366f1;"></i> 2. Theme Styling & SVG Icon</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label for="color" class="form-label-custom">Theme Gradient <small style="color:#94a3b8;font-size:11px;">(Tailwind gradient classes)</small></label>
                    <input type="text" name="color" id="color" value="{{ old('color', $service->color ?? 'from-blue-500 to-cyan-500') }}"
                        class="form-control-custom" placeholder="e.g., from-blue-500 to-cyan-500">
                    @error('color')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="bg" class="form-label-custom">Background / Icon Base <small style="color:#94a3b8;font-size:11px;">(Tailwind color class)</small></label>
                    <input type="text" name="bg" id="bg" value="{{ old('bg', $service->bg ?? 'blue-500') }}"
                        class="form-control-custom" placeholder="e.g., blue-500">
                    @error('bg')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="icon_path" class="form-label-custom">SVG Icon Path <small style="color:#94a3b8;font-size:11px;">('d' attribute of SVG &lt;path&gt;)</small></label>
                <textarea name="icon_path" id="icon_path" class="form-control-custom" rows="2" placeholder="e.g., M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4">{{ old('icon_path', $service->icon_path ?? '') }}</textarea>
                @if(old('icon_path', $service->icon_path ?? ''))
                    <div style="margin-top:8px;display:flex;align-items:center;gap:8px;color:#6366f1;">
                        <svg style="width:32px;height:32px;background:#0d1526;padding:4px;border-radius:6px;color:#fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ old('icon_path', $service->icon_path ?? '') }}"/>
                        </svg>
                        <span style="font-size:12px;color:#94a3b8;">SVG Icon Preview</span>
                    </div>
                @endif
                @error('icon_path')<p class="form-error">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- SECTION 3: SEO METADATA --}}
    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-magnifying-glass" style="color:#6366f1;"></i> 3. Google SEO & Structured Meta Tags</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">
            <div>
                <label for="meta_title" class="form-label-custom">Meta Title <small style="color:#94a3b8;font-size:11px;">(Appears on Google search snippet, 50-65 chars)</small></label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $service->meta_title ?? '') }}"
                    class="form-control-custom" placeholder="e.g., Website Developer in Saharsa | Best Web Design Agency Bihar — AmanProjects">
                @error('meta_title')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="meta_description" class="form-label-custom">Meta Description <small style="color:#94a3b8;font-size:11px;">(Appears in search preview, 140-160 chars)</small></label>
                <textarea name="meta_description" id="meta_description" class="form-control-custom" rows="2" placeholder="Looking for a top website developer in Saharsa, Bihar? AmanProjects builds high-speed, SEO-optimized custom websites…">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
                @error('meta_description')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="meta_keywords" class="form-label-custom">Meta Keywords <small style="color:#94a3b8;font-size:11px;">(Comma-separated list)</small></label>
                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $service->meta_keywords ?? '') }}"
                    class="form-control-custom" placeholder="website developer in saharsa, web development company in saharsa, app developer saharsa, bihar software">
                @error('meta_keywords')<p class="form-error">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    {{-- SECTION 4: LONG-FORM DETAILED CONTENT (600–900 words) --}}
    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-file-lines" style="color:#6366f1;"></i> 4. In-Depth Page Content (600–900 words HTML)</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">
            <p style="font-size:12px;color:#64748b;margin:0;">
                Write comprehensive, localized SEO content with headings (<code>&lt;h2&gt;</code>, <code>&lt;h3&gt;</code>), paragraphs (<code>&lt;p&gt;</code>), and bullet lists (<code>&lt;ul&gt;&lt;li&gt;</code>) targeting local queries in Saharsa and Bihar.
            </p>
            <textarea name="content" id="content" class="form-control-custom" rows="16" style="font-family:monospace;font-size:13px;line-height:1.6;" placeholder="<h2>Why Your Business in Saharsa Needs a High-Performance Custom Website</h2>&#10;<p>In today's digital economy...</p>">{{ old('content', $service->content ?? '') }}</textarea>
            @error('content')<p class="form-error">{{ $message }}</p>@enderror
        </div>
    </div>

    {{-- SECTION 5: CORE FEATURES / BULLET POINTS --}}
    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-list-check" style="color:#6366f1;"></i> 5. Key Offerings & Capabilities</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">
            <label for="features" class="form-label-custom">Key Features <small style="color:#94a3b8;font-size:11px;">(Write each feature on a new line)</small></label>
            <textarea name="features" id="features" class="form-control-custom" rows="6" placeholder="Custom Hand-Coded Architecture&#10;Sub-Second Page Load Speed with Tailwind CSS&#10;Mobile-First Responsive Design&#10;Built-in Local SEO & Schema.org Markup">{{ old('features', is_array($service->features) ? implode("\n", $service->features) : ($service->features ?? '')) }}</textarea>
            @error('features')<p class="form-error">{{ $message }}</p>@enderror
        </div>
    </div>

    {{-- SECTION 6: STRUCTURED PRICING TIERS, PROCESS STEPS & FAQS (VISUAL BUILDERS) --}}
    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-cubes" style="color:#6366f1;"></i> 6. Pricing, Process Roadmap &amp; FAQs</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:32px;">

            {{-- ======================== PRICING BUILDER ======================== --}}
            <div class="ub-section" id="pricing-builder-section">
                <div class="ub-section-header">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span class="ub-icon" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);"><i class="fa-solid fa-tags"></i></span>
                        <div>
                            <div class="ub-title">Pricing Packages</div>
                            <div class="ub-subtitle">Add, edit, or reorder your pricing tiers visually</div>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <button type="button" id="addPricingBtn" class="ub-btn-add" onclick="addPricingCard()">
                            <i class="fa-solid fa-plus"></i> Add Package
                        </button>
                        <button type="button" class="ub-btn-sample" onclick="loadDefaultPricingTemplate()">
                            <i class="fa-solid fa-wand-magic-sparkles"></i> Load Sample
                        </button>
                        <button type="button" class="ub-btn-advanced" onclick="toggleAdvanced('pricing')">
                            <i class="fa-solid fa-code"></i> JSON
                        </button>
                    </div>
                </div>

                <div id="pricing_cards_ui" class="ub-cards-grid"></div>

                {{-- Advanced JSON Toggle --}}
                <div id="pricing_advanced" style="display:none;margin-top:12px;">
                    <div class="ub-advanced-bar">
                        <span><i class="fa-solid fa-triangle-exclamation" style="color:#f59e0b;"></i> Advanced: Direct JSON Editor</span>
                        <div style="display:flex;gap:6px;">
                            <button type="button" onclick="pricingEditor.setMode('tree')" class="ub-mode-btn">Tree</button>
                            <button type="button" onclick="pricingEditor.setMode('code')" class="ub-mode-btn ub-mode-btn--active">Code</button>
                            <button type="button" onclick="pricingEditor.setMode('form')" class="ub-mode-btn">Form</button>
                            <button type="button" onclick="formatPricingJson()" class="ub-mode-btn">Beautify</button>
                            <button type="button" onclick="syncJsonToUi('pricing')" class="ub-mode-btn" style="background:#dcfce7;color:#16a34a;border-color:#86efac;">↑ Sync to UI</button>
                        </div>
                    </div>
                    <div id="pricing_tiers_editor" style="height:300px;border-radius:0 0 10px 10px;overflow:hidden;"></div>
                </div>
                <textarea name="pricing_tiers" id="pricing_tiers" style="display:none;">{{ old('pricing_tiers', is_array($service->pricing_tiers) ? json_encode($service->pricing_tiers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : ($service->pricing_tiers ?? '[]')) }}</textarea>
                @error('pricing_tiers')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- ======================== PROCESS STEPS BUILDER ======================== --}}
            <div class="ub-section" id="process-builder-section">
                <div class="ub-section-header">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span class="ub-icon" style="background:linear-gradient(135deg,#0ea5e9,#6366f1);"><i class="fa-solid fa-timeline"></i></span>
                        <div>
                            <div class="ub-title">Development Process Roadmap</div>
                            <div class="ub-subtitle">Define your step-by-step project delivery stages</div>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <button type="button" class="ub-btn-add" onclick="addProcessStep()">
                            <i class="fa-solid fa-plus"></i> Add Step
                        </button>
                        <button type="button" class="ub-btn-sample" onclick="loadDefaultProcessTemplate()">
                            <i class="fa-solid fa-wand-magic-sparkles"></i> Load Sample
                        </button>
                        <button type="button" class="ub-btn-advanced" onclick="toggleAdvanced('process')">
                            <i class="fa-solid fa-code"></i> JSON
                        </button>
                    </div>
                </div>

                <div id="process_steps_ui" class="ub-steps-list"></div>

                <div id="process_advanced" style="display:none;margin-top:12px;">
                    <div class="ub-advanced-bar">
                        <span><i class="fa-solid fa-triangle-exclamation" style="color:#f59e0b;"></i> Advanced: Direct JSON Editor</span>
                        <div style="display:flex;gap:6px;">
                            <button type="button" onclick="processEditor.setMode('tree')" class="ub-mode-btn">Tree</button>
                            <button type="button" onclick="processEditor.setMode('code')" class="ub-mode-btn ub-mode-btn--active">Code</button>
                            <button type="button" onclick="processEditor.setMode('form')" class="ub-mode-btn">Form</button>
                            <button type="button" onclick="formatProcessJson()" class="ub-mode-btn">Beautify</button>
                            <button type="button" onclick="syncJsonToUi('process')" class="ub-mode-btn" style="background:#dcfce7;color:#16a34a;border-color:#86efac;">↑ Sync to UI</button>
                        </div>
                    </div>
                    <div id="process_steps_editor" style="height:300px;border-radius:0 0 10px 10px;overflow:hidden;"></div>
                </div>
                <textarea name="process_steps" id="process_steps" style="display:none;">{{ old('process_steps', is_array($service->process_steps) ? json_encode($service->process_steps, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : ($service->process_steps ?? '[]')) }}</textarea>
                @error('process_steps')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- ======================== FAQ BUILDER ======================== --}}
            <div class="ub-section" id="faq-builder-section">
                <div class="ub-section-header">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span class="ub-icon" style="background:linear-gradient(135deg,#f59e0b,#ef4444);"><i class="fa-solid fa-circle-question"></i></span>
                        <div>
                            <div class="ub-title">FAQs <small style="font-size:11px;font-weight:400;color:#94a3b8;">(Powers Google FAQPage Schema)</small></div>
                            <div class="ub-subtitle">Add questions &amp; answers — shown as rich snippets in Google</div>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <button type="button" class="ub-btn-add" onclick="addFaqItem()">
                            <i class="fa-solid fa-plus"></i> Add FAQ
                        </button>
                        <button type="button" class="ub-btn-sample" onclick="loadDefaultFaqsTemplate()">
                            <i class="fa-solid fa-wand-magic-sparkles"></i> Load Sample
                        </button>
                        <button type="button" class="ub-btn-advanced" onclick="toggleAdvanced('faqs')">
                            <i class="fa-solid fa-code"></i> JSON
                        </button>
                    </div>
                </div>

                <div id="faqs_ui" class="ub-faq-list"></div>

                <div id="faqs_advanced" style="display:none;margin-top:12px;">
                    <div class="ub-advanced-bar">
                        <span><i class="fa-solid fa-triangle-exclamation" style="color:#f59e0b;"></i> Advanced: Direct JSON Editor</span>
                        <div style="display:flex;gap:6px;">
                            <button type="button" onclick="faqsEditor.setMode('tree')" class="ub-mode-btn">Tree</button>
                            <button type="button" onclick="faqsEditor.setMode('code')" class="ub-mode-btn ub-mode-btn--active">Code</button>
                            <button type="button" onclick="faqsEditor.setMode('form')" class="ub-mode-btn">Form</button>
                            <button type="button" onclick="formatFaqsJson()" class="ub-mode-btn">Beautify</button>
                            <button type="button" onclick="syncJsonToUi('faqs')" class="ub-mode-btn" style="background:#dcfce7;color:#16a34a;border-color:#86efac;">↑ Sync to UI</button>
                        </div>
                    </div>
                    <div id="faqs_editor" style="height:300px;border-radius:0 0 10px 10px;overflow:hidden;"></div>
                </div>
                <textarea name="faqs" id="faqs" style="display:none;">{{ old('faqs', is_array($service->faqs) ? json_encode($service->faqs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : ($service->faqs ?? '[]')) }}</textarea>
                @error('faqs')<p class="form-error">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>

</div>

@push('styles')
    <!-- Summernote Lite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- JSONEditor CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/10.1.0/jsoneditor.min.css" rel="stylesheet" type="text/css">
    <style>
        .note-editor.note-frame {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 12px !important;
            overflow: hidden;
            box-shadow: none !important;
        }
        .note-toolbar {
            background: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 8px 10px !important;
        }
        .note-btn-group {
            margin-right: 6px !important;
        }
        .note-btn {
            background: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            color: #334155 !important;
            padding: 5px 10px !important;
            font-size: 13px !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
        }
        .note-btn:hover, .note-btn.active {
            background: #6366f1 !important;
            color: #ffffff !important;
            border-color: #6366f1 !important;
        }
        .note-dropdown-menu {
            border-radius: 10px !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
            border: 1px solid #e2e8f0 !important;
        }
        .note-editable {
            font-family: 'Inter', sans-serif !important;
            font-size: 14.5px !important;
            line-height: 1.7 !important;
            color: #0f172a !important;
            background: #ffffff !important;
            min-height: 380px;
        }
        .note-statusbar {
            background: #f8fafc !important;
            border-top: 1px solid #e2e8f0 !important;
        }

        /* JSONEditor Modern Styling */
        .jsoneditor {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 12px !important;
            overflow: hidden !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
        }
        .jsoneditor-menu {
            background-color: #4f46e5 !important;
            border-bottom: 1px solid #4338ca !important;
            padding: 6px 10px !important;
        }
        .jsoneditor-menu > button {
            opacity: 0.9 !important;
            border-radius: 5px !important;
        }
        .jsoneditor-menu > button:hover {
            opacity: 1 !important;
            background-color: rgba(255, 255, 255, 0.25) !important;
        }
        .jsoneditor-statusbar {
            background-color: #f8fafc !important;
            border-top: 1px solid #e2e8f0 !important;
            color: #64748b !important;
        }
        .ace_editor {
            font-family: 'JetBrains Mono', 'Fira Code', 'Consolas', monospace !important;
            font-size: 13px !important;
            line-height: 1.6 !important;
        }

        /* ========== VISUAL UI BUILDER STYLES ========== */
        .ub-section {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
        }
        .ub-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            padding: 14px 18px;
            background: #ffffff;
            border-bottom: 1.5px solid #e2e8f0;
        }
        .ub-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px; height: 38px;
            border-radius: 10px;
            color: #fff; font-size: 16px; flex-shrink: 0;
        }
        .ub-title  { font-size: 14px; font-weight: 700; color: #1e293b; }
        .ub-subtitle { font-size: 12px; color: #64748b; margin-top: 2px; }
        .ub-btn-add {
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            color: #fff; border: none; padding: 7px 14px;
            border-radius: 8px; font-size: 12px; font-weight: 600;
            cursor: pointer; display: inline-flex; align-items: center;
            gap: 5px; transition: opacity .2s;
        }
        .ub-btn-add:hover { opacity: .87; }
        .ub-btn-sample {
            background: #ecfdf5; color: #047857;
            border: 1px solid #a7f3d0;
            padding: 6px 12px; border-radius: 8px;
            font-size: 12px; font-weight: 600; cursor: pointer;
            display: inline-flex; align-items: center; gap: 5px; transition: background .2s;
        }
        .ub-btn-sample:hover { background: #d1fae5; }
        .ub-btn-advanced {
            background: #f1f5f9; color: #475569;
            border: 1px solid #cbd5e1;
            padding: 6px 12px; border-radius: 8px;
            font-size: 12px; font-weight: 600; cursor: pointer;
            display: inline-flex; align-items: center; gap: 5px; transition: background .2s;
        }
        .ub-btn-advanced:hover { background: #e2e8f0; }
        .ub-btn-danger {
            background: #fff1f2; color: #be123c;
            border: 1px solid #fecdd3;
            padding: 5px 9px; border-radius: 7px;
            font-size: 11px; font-weight: 600; cursor: pointer; transition: background .15s;
        }
        .ub-btn-danger:hover { background: #fecdd3; }
        .ub-advanced-bar {
            display: flex; justify-content: space-between; align-items: center;
            flex-wrap: wrap; gap: 8px; padding: 8px 12px;
            background: #fefce8; border: 1px solid #fde68a; border-bottom: none;
            border-radius: 10px 10px 0 0;
            font-size: 12px; font-weight: 600; color: #92400e;
        }
        .ub-mode-btn {
            background: #f8fafc; color: #475569;
            border: 1px solid #cbd5e1;
            padding: 4px 9px; border-radius: 6px; font-size: 11px; font-weight: 600; cursor: pointer;
        }
        .ub-mode-btn--active { background: #e0e7ff; color: #4338ca; border-color: #c7d2fe; }
        .ub-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 14px; padding: 16px;
        }
        .ub-pricing-card {
            background: #fff; border: 1.5px solid #e2e8f0;
            border-radius: 12px; padding: 16px; position: relative; transition: box-shadow .2s;
        }
        .ub-pricing-card:hover { box-shadow: 0 4px 16px rgba(99,102,241,.1); border-color: #c7d2fe; }
        .ub-pricing-card.is-featured { border-color: #6366f1; box-shadow: 0 0 0 2px #e0e7ff; }
        .ub-card-badge {
            position: absolute; top: -10px; right: 12px;
            background: #6366f1; color: #fff;
            font-size: 10px; font-weight: 700;
            padding: 2px 10px; border-radius: 20px; letter-spacing: .5px;
        }
        .ub-input {
            width: 100%; border: 1px solid #e2e8f0; border-radius: 7px;
            padding: 7px 10px; font-size: 13px; color: #1e293b;
            background: #f8fafc; outline: none; box-sizing: border-box; transition: border-color .2s;
        }
        .ub-input:focus { border-color: #6366f1; background: #fff; }
        .ub-label {
            font-size: 11px; font-weight: 600; color: #64748b;
            display: block; margin-bottom: 4px;
            text-transform: uppercase; letter-spacing: .4px;
        }
        .ub-field { margin-bottom: 10px; }
        .ub-field:last-child { margin-bottom: 0; }
        .ub-features-list { list-style: none; padding: 0; margin: 4px 0 6px 0; }
        .ub-features-list li { display: flex; align-items: center; gap: 6px; margin-bottom: 5px; }
        .ub-features-list li input { flex: 1; }
        .ub-feat-del {
            background: none; border: none; color: #ef4444;
            cursor: pointer; font-size: 14px; padding: 2px 5px; border-radius: 5px; line-height: 1;
        }
        .ub-feat-del:hover { background: #fff1f2; }
        .ub-add-feat-btn {
            background: #f0fdf4; color: #15803d;
            border: 1px dashed #86efac; border-radius: 7px;
            padding: 5px 10px; font-size: 11px; font-weight: 600;
            cursor: pointer; width: 100%; text-align: left;
        }
        .ub-add-feat-btn:hover { background: #dcfce7; }
        .ub-steps-list { padding: 16px; display: flex; flex-direction: column; gap: 10px; }
        .ub-step-row {
            display: grid;
            grid-template-columns: auto auto 1fr 1.5fr auto;
            align-items: center; gap: 10px;
            background: #fff; border: 1.5px solid #e2e8f0;
            border-radius: 11px; padding: 12px 14px; transition: box-shadow .2s;
        }
        .ub-step-row:hover { box-shadow: 0 2px 10px rgba(99,102,241,.08); border-color: #c7d2fe; }
        .ub-step-badge {
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            color: #fff; font-size: 12px; font-weight: 800;
            width: 32px; height: 32px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .ub-drag-handle { cursor: grab; color: #94a3b8; font-size: 16px; padding: 0 4px; user-select: none; }
        .ub-drag-handle:active { cursor: grabbing; }
        .ub-faq-list { padding: 16px; display: flex; flex-direction: column; gap: 10px; }
        .ub-faq-row {
            background: #fff; border: 1.5px solid #e2e8f0;
            border-radius: 11px; padding: 14px;
            display: grid; grid-template-columns: auto 1fr auto;
            gap: 12px; align-items: start; transition: box-shadow .2s;
        }
        .ub-faq-row:hover { box-shadow: 0 2px 10px rgba(99,102,241,.08); border-color: #c7d2fe; }
        .ub-faq-num {
            width: 28px; height: 28px;
            background: linear-gradient(135deg,#f59e0b,#ef4444);
            color: #fff; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; flex-shrink: 0; margin-top: 2px;
        }
        .ub-empty { text-align: center; padding: 28px 20px; color: #94a3b8; font-size: 13px; }
        .ub-empty i { font-size: 28px; display: block; margin-bottom: 8px; opacity: .5; }
    </style>
@endpush

@push('scripts')
    <!-- jQuery, Summernote Lite JS & JSONEditor JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/10.1.0/jsoneditor.min.js"></script>
    <script>
        // Global JSON editor instances (lazy-initialised only when Advanced toggle is opened)
        let pricingEditor, processEditor, faqsEditor;

        const defaultPricingTemplate = [
            {
                "name": "Starter Package",
                "price": "₹7,999",
                "period": "one-time",
                "desc": "Ideal for local startups and small businesses in Saharsa.",
                "features": [
                    "Up to 5 Pages",
                    "Mobile Responsive",
                    "WhatsApp & Call Integration",
                    "Basic Local SEO"
                ],
                "is_featured": false
            },
            {
                "name": "Business Package",
                "price": "₹18,999",
                "period": "one-time",
                "desc": "Comprehensive dynamic solution with admin dashboard.",
                "features": [
                    "Up to 15 Dynamic Pages",
                    "Product / Service Catalog",
                    "Online Payment Integration",
                    "Advanced SEO & Schema"
                ],
                "is_featured": true
            },
            {
                "name": "Enterprise Custom",
                "price": "Custom Quote",
                "period": "milestone-based",
                "desc": "Tailor-made architecture for large operations.",
                "features": [
                    "Custom Backend & REST APIs",
                    "Cloud Deployment (AWS / DigitalOcean)",
                    "Dedicated Developer Support"
                ],
                "is_featured": false
            }
        ];

        const defaultProcessTemplate = [
            {
                "step": "01",
                "title": "Discovery & Planning",
                "desc": "Understanding your business goals, target audience, and local competitors in Bihar."
            },
            {
                "step": "02",
                "title": "UI/UX Wireframing",
                "desc": "Designing high-converting mobile and desktop interfaces in Figma."
            },
            {
                "step": "03",
                "title": "Clean Hand-Coding",
                "desc": "Developing the solution with modern frameworks like Laravel and React."
            },
            {
                "step": "04",
                "title": "QA & Speed Optimization",
                "desc": "Testing for sub-second loading speeds, security vulnerabilities, and mobile responsiveness."
            },
            {
                "step": "05",
                "title": "Deployment & Local Indexing",
                "desc": "Launching on high-speed cloud servers with Schema markup and Google Search Console submission."
            }
        ];

        const defaultFaqsTemplate = [
            {
                "question": "How long does it take to complete this project in Saharsa?",
                "answer": "Standard projects typically take 7 to 14 days depending on specific requirements and custom features."
            },
            {
                "question": "Will I own the complete source code?",
                "answer": "Yes, 100% of the source code and intellectual property belongs to you upon project delivery."
            },
            {
                "question": "Do you provide on-site or local support in Saharsa?",
                "answer": "Yes, we are based locally in Saharsa, Bihar and offer direct support via WhatsApp, phone, and in-person consultations."
            }
        ];

        // ===================== UTILITY =====================
        function escHtml(str) {
            return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
        }

        // ===================== JSON FORMAT HELPERS =====================
        function formatPricingJson() { if (pricingEditor) pricingEditor.format(); }
        function formatProcessJson() { if (processEditor) processEditor.format(); }
        function formatFaqsJson()    { if (faqsEditor)    faqsEditor.format(); }

        // ===================== ADVANCED JSON TOGGLE =====================
        function toggleAdvanced(type) {
            const el = document.getElementById(type + '_advanced');
            const isOpening = el.style.display === 'none';
            el.style.display = isOpening ? 'block' : 'none';
            if (isOpening) {
                if (type === 'pricing' && !pricingEditor) initPricingJsonEditor();
                if (type === 'process' && !processEditor) initProcessJsonEditor();
                if (type === 'faqs'    && !faqsEditor)    initFaqsJsonEditor();
            }
        }

        function syncJsonToUi(type) {
            try {
                if (type === 'pricing') {
                    renderPricingUI(pricingEditor ? pricingEditor.get() : JSON.parse(document.getElementById('pricing_tiers').value || '[]'));
                } else if (type === 'process') {
                    renderProcessUI(processEditor ? processEditor.get() : JSON.parse(document.getElementById('process_steps').value || '[]'));
                } else if (type === 'faqs') {
                    renderFaqsUI(faqsEditor ? faqsEditor.get() : JSON.parse(document.getElementById('faqs').value || '[]'));
                }
            } catch(e) { alert('JSON is invalid — please fix it before syncing to UI.'); }
        }

        // ===================== PRICING UI BUILDER =====================
        function getPricingData() {
            return Array.from(document.querySelectorAll('#pricing_cards_ui .ub-pricing-card')).map(card => ({
                name:        card.querySelector('[data-field="name"]').value.trim(),
                price:       card.querySelector('[data-field="price"]').value.trim(),
                period:      card.querySelector('[data-field="period"]').value.trim(),
                desc:        card.querySelector('[data-field="desc"]').value.trim(),
                features:    Array.from(card.querySelectorAll('[data-field="feature"]')).map(i=>i.value.trim()).filter(Boolean),
                is_featured: card.querySelector('[data-field="is_featured"]').checked,
            }));
        }
        function syncPricingToTextarea() {
            document.getElementById('pricing_tiers').value = JSON.stringify(getPricingData());
        }
        function addPricingFeature(featList) {
            const li = document.createElement('li');
            li.innerHTML = `<input type="text" class="ub-input" data-field="feature" placeholder="Feature description..." oninput="syncPricingToTextarea()">
                            <button type="button" class="ub-feat-del" onclick="this.closest('li').remove();syncPricingToTextarea();" title="Remove">×</button>`;
            featList.appendChild(li);
            li.querySelector('input').focus();
        }
        function createPricingCard(data) {
            data = data || {};
            const card = document.createElement('div');
            card.className = 'ub-pricing-card' + (data.is_featured ? ' is-featured' : '');
            const feats = Array.isArray(data.features) ? data.features : [];
            const featHtml = feats.map(f =>
                `<li><input type="text" class="ub-input" data-field="feature" value="${escHtml(f)}" placeholder="Feature..." oninput="syncPricingToTextarea()">
                 <button type="button" class="ub-feat-del" onclick="this.closest('li').remove();syncPricingToTextarea();" title="Remove">×</button></li>`
            ).join('');
            card.innerHTML = `
                ${data.is_featured ? '<span class="ub-card-badge">⭐ Featured</span>' : ''}
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                    <span style="font-size:11px;font-weight:700;color:#6366f1;text-transform:uppercase;letter-spacing:.5px;">Package</span>
                    <button type="button" class="ub-btn-danger" onclick="this.closest('.ub-pricing-card').remove();syncPricingToTextarea();" title="Remove"><i class="fa-solid fa-trash"></i></button>
                </div>
                <div class="ub-field">
                    <label class="ub-label">Package Name</label>
                    <input type="text" class="ub-input" data-field="name" value="${escHtml(data.name||'')}" placeholder="e.g., Starter Package" oninput="syncPricingToTextarea()">
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;" class="ub-field">
                    <div><label class="ub-label">Price</label><input type="text" class="ub-input" data-field="price" value="${escHtml(data.price||'')}" placeholder="₹7,999" oninput="syncPricingToTextarea()"></div>
                    <div><label class="ub-label">Period</label><input type="text" class="ub-input" data-field="period" value="${escHtml(data.period||'one-time')}" placeholder="one-time" oninput="syncPricingToTextarea()"></div>
                </div>
                <div class="ub-field">
                    <label class="ub-label">Description</label>
                    <textarea class="ub-input" data-field="desc" rows="2" placeholder="Short description..." oninput="syncPricingToTextarea()">${escHtml(data.desc||'')}</textarea>
                </div>
                <div class="ub-field">
                    <label class="ub-label">Features</label>
                    <ul class="ub-features-list">${featHtml}</ul>
                    <button type="button" class="ub-add-feat-btn" onclick="addPricingFeature(this.previousElementSibling);syncPricingToTextarea();"><i class="fa-solid fa-plus"></i> Add Feature</button>
                </div>
                <div class="ub-field" style="border-top:1px solid #f1f5f9;padding-top:10px;margin-top:4px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:600;color:#334155;">
                        <input type="checkbox" data-field="is_featured" ${data.is_featured?'checked':''} onchange="this.closest('.ub-pricing-card').classList.toggle('is-featured',this.checked);syncPricingToTextarea();" style="accent-color:#6366f1;width:15px;height:15px;">
                        Mark as Featured (Highlighted)
                    </label>
                </div>`;
            return card;
        }
        function addPricingCard(data) {
            const grid = document.getElementById('pricing_cards_ui');
            const empty = grid.querySelector('.ub-empty');
            if (empty) empty.remove();
            grid.appendChild(createPricingCard(data || {}));
            syncPricingToTextarea();
        }
        function renderPricingUI(data) {
            const grid = document.getElementById('pricing_cards_ui');
            grid.innerHTML = '';
            if (!data || !data.length) {
                grid.innerHTML = '<div class="ub-empty"><i class="fa-solid fa-tags"></i>No packages yet — click "Add Package" or "Load Sample"</div>';
                return;
            }
            data.forEach(pkg => grid.appendChild(createPricingCard(pkg)));
            syncPricingToTextarea();
        }

        // ===================== PROCESS STEPS UI BUILDER =====================
        function getProcessData() {
            return Array.from(document.querySelectorAll('#process_steps_ui .ub-step-row')).map((row, idx) => ({
                step:  String(idx + 1).padStart(2, '0'),
                title: row.querySelector('[data-field="title"]').value.trim(),
                desc:  row.querySelector('[data-field="desc"]').value.trim(),
            }));
        }
        function syncProcessToTextarea() {
            document.getElementById('process_steps').value = JSON.stringify(getProcessData());
            document.querySelectorAll('#process_steps_ui .ub-step-badge').forEach((b, i) => { b.textContent = String(i+1).padStart(2,'0'); });
        }
        function createProcessRow(data, idx) {
            data = data || {}; idx = idx || 0;
            const row = document.createElement('div');
            row.className = 'ub-step-row';
            row.innerHTML = `
                <span class="ub-step-badge">${String(idx+1).padStart(2,'0')}</span>
                <span class="ub-drag-handle" title="Drag to reorder">⠿</span>
                <div><label class="ub-label">Step Title</label><input type="text" class="ub-input" data-field="title" value="${escHtml(data.title||'')}" placeholder="e.g., Discovery & Planning" oninput="syncProcessToTextarea()"></div>
                <div><label class="ub-label">Description</label><textarea class="ub-input" data-field="desc" rows="2" placeholder="Brief description..." oninput="syncProcessToTextarea()">${escHtml(data.desc||'')}</textarea></div>
                <button type="button" class="ub-btn-danger" onclick="this.closest('.ub-step-row').remove();syncProcessToTextarea();" title="Remove"><i class="fa-solid fa-trash"></i></button>`;
            return row;
        }
        function addProcessStep(data) {
            const list = document.getElementById('process_steps_ui');
            const empty = list.querySelector('.ub-empty');
            if (empty) empty.remove();
            const idx = list.querySelectorAll('.ub-step-row').length;
            list.appendChild(createProcessRow(data || {}, idx));
            syncProcessToTextarea();
        }
        function renderProcessUI(data) {
            const list = document.getElementById('process_steps_ui');
            list.innerHTML = '';
            if (!data || !data.length) {
                list.innerHTML = '<div class="ub-empty"><i class="fa-solid fa-timeline"></i>No steps yet — click "Add Step" or "Load Sample"</div>';
                return;
            }
            data.forEach((step, i) => list.appendChild(createProcessRow(step, i)));
            syncProcessToTextarea();
        }

        // ===================== FAQS UI BUILDER =====================
        function getFaqsData() {
            return Array.from(document.querySelectorAll('#faqs_ui .ub-faq-row')).map(row => ({
                question: row.querySelector('[data-field="question"]').value.trim(),
                answer:   row.querySelector('[data-field="answer"]').value.trim(),
            }));
        }
        function syncFaqsToTextarea() {
            document.getElementById('faqs').value = JSON.stringify(getFaqsData());
            document.querySelectorAll('#faqs_ui .ub-faq-num').forEach((n, i) => { n.textContent = i + 1; });
        }
        function createFaqRow(data, idx) {
            data = data || {}; idx = idx || 0;
            const row = document.createElement('div');
            row.className = 'ub-faq-row';
            row.innerHTML = `
                <span class="ub-faq-num">${idx+1}</span>
                <div style="display:grid;gap:8px;">
                    <div><label class="ub-label">Question</label><input type="text" class="ub-input" data-field="question" value="${escHtml(data.question||'')}" placeholder="e.g., How long does it take?" oninput="syncFaqsToTextarea()"></div>
                    <div><label class="ub-label">Answer</label><textarea class="ub-input" data-field="answer" rows="2" placeholder="Detailed answer..." oninput="syncFaqsToTextarea()">${escHtml(data.answer||'')}</textarea></div>
                </div>
                <button type="button" class="ub-btn-danger" onclick="this.closest('.ub-faq-row').remove();syncFaqsToTextarea();" title="Remove"><i class="fa-solid fa-trash"></i></button>`;
            return row;
        }
        function addFaqItem(data) {
            const list = document.getElementById('faqs_ui');
            const empty = list.querySelector('.ub-empty');
            if (empty) empty.remove();
            const idx = list.querySelectorAll('.ub-faq-row').length;
            list.appendChild(createFaqRow(data || {}, idx));
            syncFaqsToTextarea();
        }
        function renderFaqsUI(data) {
            const list = document.getElementById('faqs_ui');
            list.innerHTML = '';
            if (!data || !data.length) {
                list.innerHTML = '<div class="ub-empty"><i class="fa-solid fa-circle-question"></i>No FAQs yet — click "Add FAQ" or "Load Sample"</div>';
                return;
            }
            data.forEach((faq, i) => list.appendChild(createFaqRow(faq, i)));
            syncFaqsToTextarea();
        }

        // ===================== LOAD SAMPLES =====================
        function loadDefaultPricingTemplate() {
            if (confirm('Replace current pricing with sample Starter/Business/Enterprise packages?')) {
                renderPricingUI(defaultPricingTemplate);
                if (pricingEditor) pricingEditor.set(defaultPricingTemplate);
            }
        }
        function loadDefaultProcessTemplate() {
            if (confirm('Replace current roadmap with sample 5-stage process?')) {
                renderProcessUI(defaultProcessTemplate);
                if (processEditor) processEditor.set(defaultProcessTemplate);
            }
        }
        function loadDefaultFaqsTemplate() {
            if (confirm('Replace current FAQs with sample localized questions?')) {
                renderFaqsUI(defaultFaqsTemplate);
                if (faqsEditor) faqsEditor.set(defaultFaqsTemplate);
            }
        }

        // ===================== LAZY JSON EDITOR INIT =====================
        function _jsonEditorOpts(textarea) {
            return { modes:['tree','code','form','text','view'], mode:'code', search:true, navigationBar:true, statusBar:true,
                     onChangeText: function(str) { textarea.value = str; } };
        }
        function initPricingJsonEditor() {
            const c = document.getElementById('pricing_tiers_editor'), t = document.getElementById('pricing_tiers');
            try { pricingEditor = new JSONEditor(c, _jsonEditorOpts(t)); pricingEditor.set(JSON.parse(t.value||'[]')); }
            catch(e) { const o=_jsonEditorOpts(t); o.mode='text'; pricingEditor=new JSONEditor(c,o); pricingEditor.setText(t.value||'[]'); }
        }
        function initProcessJsonEditor() {
            const c = document.getElementById('process_steps_editor'), t = document.getElementById('process_steps');
            try { processEditor = new JSONEditor(c, _jsonEditorOpts(t)); processEditor.set(JSON.parse(t.value||'[]')); }
            catch(e) { const o=_jsonEditorOpts(t); o.mode='text'; processEditor=new JSONEditor(c,o); processEditor.setText(t.value||'[]'); }
        }
        function initFaqsJsonEditor() {
            const c = document.getElementById('faqs_editor'), t = document.getElementById('faqs');
            try { faqsEditor = new JSONEditor(c, _jsonEditorOpts(t)); faqsEditor.set(JSON.parse(t.value||'[]')); }
            catch(e) { const o=_jsonEditorOpts(t); o.mode='text'; faqsEditor=new JSONEditor(c,o); faqsEditor.setText(t.value||'[]'); }
        }

        // ===================== DOCUMENT READY =====================
        $(document).ready(function() {
            // Slug Auto Generator
            function generateSlug(text) {
                return text.toString().toLowerCase().trim()
                    .replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
            }
            let isSlugManuallyEdited = {{ (isset($service) && $service->slug) ? 'true' : 'false' }};
            $('#slug').on('input', function() { isSlugManuallyEdited = $(this).val().trim().length > 0; });
            $('#title').on('input keyup change', function() {
                if (!isSlugManuallyEdited) $('#slug').val(generateSlug($(this).val()));
            });

            // Summernote Editor
            $('#content').summernote({
                placeholder: 'Write comprehensive, localized SEO content with headings, paragraphs, and lists...',
                tabsize: 2, height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']], ['fontsize', ['fontsize']],
                    ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']], ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Render Visual UI Builders from existing data
            try { renderPricingUI(JSON.parse(document.getElementById('pricing_tiers').value || '[]')); } catch(e) { renderPricingUI([]); }
            try { renderProcessUI(JSON.parse(document.getElementById('process_steps').value || '[]')); } catch(e) { renderProcessUI([]); }
            try { renderFaqsUI(JSON.parse(document.getElementById('faqs').value || '[]'));             } catch(e) { renderFaqsUI([]); }

            // Sync to textareas on submit
            $('form').on('submit', function() {
                syncPricingToTextarea();
                syncProcessToTextarea();
                syncFaqsToTextarea();
            });
        });
    </script>
@endpush
