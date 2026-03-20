@extends('admin.layout')

@section('title', 'Manage: ' . $agent->fullname . ' — PadosiAgent Admin')

@section('content')
<style>
    .manage-grid { display: grid; grid-template-columns: 340px 1fr; gap: 24px; }
    .info-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #edf3f8; font-size: 14px; }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: #5f6b7a; font-weight: 500; }
    .info-value { font-weight: 600; text-align: right; }
    .section-title { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: #5f6b7a; margin: 0 0 14px; }
    .avatar-circle { width: 64px; height: 64px; border-radius: 50%; background: linear-gradient(135deg, #1d7d5d, #2258a5); display: flex; align-items: center; justify-content: center; font-size: 26px; font-weight: 800; color: #fff; flex-shrink: 0; }
    .stat-box { background: #f8fafc; border: 1px solid #edf3f8; border-radius: 10px; padding: 14px 18px; text-align: center; flex: 1; min-width: 100px; }
    .stat-box .num { font-size: 22px; font-weight: 800; }
    .stat-box .lbl { font-size: 11px; color: #5f6b7a; margin-top: 2px; }
    .review-card { background: #f8fafc; border: 1px solid #edf3f8; border-radius: 10px; padding: 14px; margin-bottom: 10px; }
    .plan-btn { padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; border: 2px solid #d7e0ea; background: #fff; color: #5f6b7a; cursor: pointer; transition: all .15s; }
    .plan-btn.selected { border-color: #1d7d5d; background: #e6f4f0; color: #1d7d5d; }
    .plan-btn:hover:not(.selected) { border-color: #aab8c8; }
    .alert-success { background: #e6f4f0; border: 1px solid #1d7d5d; color: #1a5c45; padding: 10px 16px; border-radius: 8px; font-size: 14px; margin-bottom: 16px; }
    .alert-error { background: #fef2f2; border: 1px solid #ef4444; color: #b91c1c; padding: 10px 16px; border-radius: 8px; font-size: 14px; margin-bottom: 16px; }
    .expired-text { color: #ef4444; }
    @media(max-width:900px) { .manage-grid { grid-template-columns: 1fr; } }
</style>

<div style="padding-bottom: 60px;">
  <!-- BREADCRUMB -->
  <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:13px;color:#5f6b7a;">
    <a href="{{ route('admin.agents') }}" style="color:#1d7d5d;text-decoration:none;font-weight:600;">👥 Agents</a>
    <span>›</span>
    <span style="font-weight:600;color:#1e293b;">{{ $agent->fullname }}</span>
  </div>

  <!-- FLASH ALERTS -->
  @if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert-error">❌ {{ session('error') }}</div>
  @endif

  <!-- HEADER -->
  <div style="display:flex;align-items:center;gap:16px;margin-bottom:24px;flex-wrap:wrap;">
    <div class="avatar-circle">{{ strtoupper(substr($agent->fullname, 0, 1)) }}</div>
    <div style="flex:1;">
      <h1 style="font-size:24px;font-weight:800;margin:0;">{{ $agent->fullname }}</h1>
      <p style="color:#5f6b7a;font-size:14px;margin:4px 0 0;">{{ $agent->email }} &nbsp;·&nbsp; {{ $agent->mobile ?? 'No phone' }}</p>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
      <span class="badge {{ $agent->status === 'active' ? 'badge-green' : 'badge-destructive' }}" style="font-size:13px;padding:6px 14px;">
        {{ $agent->status === 'active' ? '🟢 Active' : '🔴 Inactive' }}
      </span>
      <form method="POST" action="{{ route('admin.agents.toggle_status') }}" style="margin:0;">
        @csrf
        <input type="hidden" name="id" value="{{ $agent->id }}">
        <input type="hidden" name="status" value="{{ $agent->status === 'active' ? 'inactive' : 'active' }}">
        <button type="submit" class="btn" style="font-size:13px;">
          {{ $agent->status === 'active' ? '⏸ Deactivate' : '▶ Activate' }}
        </button>
      </form>
      <a href="{{ route('admin.agents') }}" class="btn" style="font-size:13px;background:#f1f5f9;color:#1e293b;border:1px solid #d7e0ea;text-decoration:none;">← Back</a>
    </div>
  </div>

  <!-- STATS ROW -->
  <div style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <div class="stat-box">
      <div class="num">⭐ {{ $agent->avg_rating ? round($agent->avg_rating, 1) : '—' }}</div>
      <div class="lbl">Avg Rating</div>
    </div>
    <div class="stat-box">
      <div class="num">{{ (int)$agent->review_count }}</div>
      <div class="lbl">Approved Reviews</div>
    </div>
    <div class="stat-box">
      <div class="num">{{ (int)$agent->pending_reviews }}</div>
      <div class="lbl">Pending Reviews</div>
    </div>
    <div class="stat-box">
      <div class="num">
        @php 
          $exp = !empty($agent->experience_range) ? $agent->experience_range : ($agent->experience_years ?? '—');
        @endphp
        {{ $exp }}{{ is_numeric($exp) ? ' yrs' : '' }}
      </div>
      <div class="lbl">Experience</div>
    </div>
    <div class="stat-box">
      <div class="num">{{ $agent->selected_plan ? '✅' : '❌' }}</div>
      <div class="lbl">{{ $agent->selected_plan ?? 'No Plan' }}</div>
    </div>
  </div>

  <!-- MAIN GRID -->
  <div class="manage-grid">

    <!-- LEFT: Info + Subscription -->
    <div>

      <div class="card" style="padding:20px;margin-bottom:16px;">
        <p class="section-title">📋 Agent Information</p>
        <div class="info-row"><span class="info-label">Full Name</span><span class="info-value">{{ $agent->fullname }}</span></div>
        <div class="info-row"><span class="info-label">Email</span><span class="info-value">{{ $agent->email }}</span></div>
        <div class="info-row"><span class="info-label">Phone</span><span class="info-value">{{ $agent->mobile ?? 'N/A' }}</span></div>
        <div class="info-row"><span class="info-label">Location</span><span class="info-value">{{ $agent->address ?? 'N/A' }}</span></div>
        <div class="info-row"><span class="info-label">License No.</span><span class="info-value">{{ $agent->license_number ?? 'Pending' }}</span></div>
        <div class="info-row"><span class="info-label">Experience</span><span class="info-value">{{ $exp }}{{ is_numeric($exp) ? ' years' : '' }}</span></div>
        <div class="info-row"><span class="info-label">Registered On</span><span class="info-value">{{ date('d M Y', strtotime($agent->created_at)) }}</span></div>
        <div class="info-row">
          <span class="info-label">Status</span>
          <span class="badge {{ $agent->status === 'active' ? 'badge-green' : 'badge-destructive' }}">{{ ucfirst($agent->status) }}</span>
        </div>
      </div>

      <div class="card" style="padding:20px;margin-bottom:16px;">
        <p class="section-title">💳 Subscription</p>
        <div class="info-row">
          <span class="info-label">Current Plan</span>
          <span class="badge {{ stripos($agent->selected_plan ?? '', 'Professional') !== false ? 'badge-primary' : 'badge-secondary' }}">
            {{ $agent->selected_plan ?? 'No Plan' }}
          </span>
        </div>
        <div class="info-row">
          <span class="info-label">Expires At</span>
          @php
            $expired = !empty($agent->expires_at) && strtotime($agent->expires_at) < time();
            $expText = !empty($agent->expires_at) ? date('d M Y', strtotime($agent->expires_at)) : 'N/A';
          @endphp
          <span class="info-value {{ $expired ? 'expired-text' : '' }}">{{ $expText }}</span>
        </div>

        <form method="POST" action="{{ route('admin.agents.update_plan') }}" style="margin-top:14px;">
          @csrf
          <input type="hidden" name="id" value="{{ $agent->id }}">
          <p style="font-size:13px;font-weight:600;margin:0 0 10px;">Change Plan:</p>
          <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <button type="submit" name="selected_plan" value="Starter's Plan"
              class="plan-btn {{ ($agent->selected_plan ?? '') === "Starter's Plan" ? 'selected' : '' }}">
              Starter's
            </button>
            <button type="submit" name="selected_plan" value="Professional's Plan"
              class="plan-btn {{ ($agent->selected_plan ?? '') === "Professional's Plan" ? 'selected' : '' }}">
              Professional's
            </button>
            <button type="submit" name="selected_plan" value=""
              class="plan-btn {{ empty($agent->selected_plan) ? 'selected' : '' }}">
              No Plan
            </button>
          </div>
        </form>
      </div>

    </div>

    <!-- RIGHT: Controls + Reviews + Notes -->
    <div>

      <div class="card" style="padding:20px;margin-bottom:16px;">
        <p class="section-title">🎛️ Profile Section Controls</p>
        <p style="font-size:13px;color:#5f6b7a;margin:0 0 14px;">Toggle which sections appear on the public profile.</p>
        
        @php
            $visibilitySettings = [
                ['label' => 'Full Profile Visibility', 'field' => 'is_profile_visible', 'value' => $agent->is_profile_visible],
                ['label' => 'Certificates Section', 'field' => 'show_certificates', 'value' => $agent->show_certificates],
                ['label' => 'Achievements Section', 'field' => 'show_achievements', 'value' => $agent->show_achievements],
                ['label' => 'Comments / Reviews Section', 'field' => 'show_reviews', 'value' => $agent->show_reviews],
            ];
        @endphp

        @foreach ($visibilitySettings as $setting)
        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#f8fafc;border-radius:8px;border:1px solid #edf3f8;margin-bottom:10px;">
          <span style="font-size:14px;font-weight:500;">{{ $setting['label'] }}</span>
          <button type="button" 
                  class="toggle {{ $setting['value'] ? 'on' : 'off' }}" 
                  onclick="updateVisibility('{{ $setting['field'] }}', this)"></button>
        </div>
        @endforeach
      </div>

<script>
function updateVisibility(field, btn) {
    const isNowOn = !btn.classList.contains('on');
    
    // Toggle UI optimistically
    btn.classList.toggle('on');
    btn.classList.toggle('off');

    fetch("{{ route('admin.agents.update_visibility', [], false) }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ 
            id: {{ $agent->id }}, 
            field: field, 
            value: isNowOn ? 1 : 0 
        })
    })
    .then(r => r.json())
    .then(data => {
        if (!data.success) {
            btn.classList.toggle('on');
            btn.classList.toggle('off');
            alert('Error: ' + (data.message || 'Server error'));
        }
    })
    .catch(err => {
        btn.classList.toggle('on');
        btn.classList.toggle('off');
        alert('Network error: ' + err.message);
    });
}
</script>

      <div class="card" style="padding:20px;margin-bottom:16px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;">
            <p class="section-title" style="margin:0;">⭐ Recent Reviews</p>
            <div style="font-size:12px;color:#5f6b7a;">
                <span style="color:#22c55e;">●</span> {{ (int)$agent->review_count }} Approved &nbsp;
                <span style="color:#f59e0b;">●</span> {{ (int)$agent->pending_reviews }} Pending
            </div>
        </div>
        @if(count($reviews) === 0)
          <p style="font-size:14px;color:#5f6b7a;margin:0;">No reviews yet.</p>
        @else
          @foreach ($reviews as $r)
          <div class="review-card" style="position:relative;margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
            <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
              <strong style="font-size:14px;">{{ $r->client_name ?: 'Anonymous' }}</strong>
              <span style="font-size:13px;color:#f59e0b;">
                {{ str_repeat('⭐', min(5, (int)($r->rating ?? 0))) }}
              </span>
            </div>
            
            <p style="font-size:13px;color:#5f6b7a;margin:0 0 8px;line-height:1.5;">
              {!! nl2br(e($r->review_text ?: 'No comment provided.')) !!}
            </p>

            <div style="display:flex;justify-content:space-between;align-items:center;">
              <span style="font-size:11px;color:#94a3b8;">{{ $r->created_at ? date('d M Y', strtotime($r->created_at)) : '' }}</span>
              
              <form method="POST" action="{{ route('admin.agents.toggle_review_approval') }}" style="margin:0;">
                @csrf
                <input type="hidden" name="review_id" value="{{ $r->id }}">
                <input type="hidden" name="is_approved" value="{{ $r->is_approved ? 0 : 1 }}">
                <button type="submit" style="
                  border:none;
                  padding:4px 10px;
                  border-radius:4px;
                  font-size:11px;
                  font-weight:600;
                  cursor:pointer;
                  transition:0.2s;
                  {{ $r->is_approved ? 'background:#dcfce7;color:#15803d;' : 'background:#fee2e2;color:#b91c1c;' }}
                " onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                  {{ $r->is_approved ? '✓ Approved' : '✗ Pending' }}
                </button>
              </form>
            </div>
          </div>
          @endforeach
        @endif
      </div>

      <div class="card" style="padding:20px;">
        <p class="section-title">📝 Admin Notes</p>
        <form method="POST" action="{{ route('admin.agents.save_notes') }}">
          @csrf
          <input type="hidden" name="id" value="{{ $agent->id }}">
          <textarea name="admin_notes" rows="5"
            placeholder="Internal notes about this agent (not visible to agent)..."
            style="width:100%;border:1px solid #d7e0ea;border-radius:8px;padding:10px;font-size:14px;font-family:inherit;resize:vertical;box-sizing:border-box;margin-bottom:10px;">{{ $agent->admin_notes }}</textarea>
          <button type="submit" class="btn btn-primary" style="font-size:13px;">💾 Save Notes</button>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection
