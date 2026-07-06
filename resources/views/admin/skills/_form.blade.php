<div style="display:grid;grid-template-columns:1fr;gap:18px;margin-bottom:8px;">

    <div class="form-section">
        <div class="form-section-header">
            <h3><i class="fa-solid fa-code" style="color:#6366f1;"></i> Skill Information</h3>
        </div>
        <div class="form-section-body" style="display:grid;gap:16px;">

            <div>
                <label for="name" class="form-label-custom">Skill Name <span style="color:#ef4444;">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $skill->name ?? '') }}" required
                    class="form-control-custom" placeholder="e.g., Laravel, Vue.js…">
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="category" class="form-label-custom">Category</label>
                <input type="text" name="category" id="category" value="{{ old('category', $skill->category ?? '') }}"
                    class="form-control-custom" placeholder="e.g., Frontend, Backend, DevOps…">
                @error('category')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="level" class="form-label-custom">Proficiency Level (%) <span style="color:#ef4444;">*</span></label>
                <input type="range" name="level" id="level" value="{{ old('level', $skill->level ?? 50) }}"
                    min="0" max="100"
                    style="width:100%;accent-color:#6366f1;height:6px;cursor:pointer;"
                    oninput="document.getElementById('levelDisplay').textContent=this.value+'%'">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:8px;">
                    <span style="font-size:12px;color:#94a3b8;">0%</span>
                    <span id="levelDisplay" style="font-size:16px;font-weight:700;color:#6366f1;">{{ old('level', $skill->level ?? 50) }}%</span>
                    <span style="font-size:12px;color:#94a3b8;">100%</span>
                </div>
                @error('level')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div>
                <input type="hidden" name="show" value="0">
                <div class="switch-wrapper">
                    <input type="checkbox" name="show" id="show" value="1"
                        {{ old('show', $skill->show ?? true) ? 'checked' : '' }}
                        style="accent-color:#6366f1;width:18px;height:18px;cursor:pointer;">
                    <div>
                        <label for="show" class="switch-label" style="cursor:pointer;">Show on website</label>
                        <p style="font-size:12px;color:#94a3b8;margin:0;">Display this skill on your portfolio</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
