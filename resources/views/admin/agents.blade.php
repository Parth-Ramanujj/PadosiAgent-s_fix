@extends('admin.layout')
@section('title', 'Agents - PadosiAgent Admin')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
  <div>
    <h1 style="font-size:28px;font-weight:800;margin:0;">Agents</h1>
    <p style="color:#5f6b7a;font-size:14px;margin:4px 0 0;">Manage plans, status, and visibility for registered agents.</p>
  </div>
  <div style="display:flex;gap:12px;">
    <button id="exportAgentsCsvBtn" class="btn" style="background:#f1f5f9;color:#1e293b;border:1px solid #d7e0ea;" onclick="exportAgentsToCSV()">📥 Export CSV</button>
    <button onclick="window.location.reload()" class="btn">🔄 Refresh</button>
  </div>
</div>

<div class="tab-strip">
  <a class="tab-btn" href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a class="tab-btn active" href="{{ route('admin.agents') }}">👥 Agents</a>
  <a class="tab-btn" href="#">🏢 Distributors</a>
  <a class="tab-btn" href="#">📨 Messaging</a>
</div>

<div class="card" style="padding:16px;margin-bottom:16px;">
  <form method="GET" action="{{ route('admin.agents') }}" style="display:flex;gap:12px;flex-wrap:wrap;margin:0;">
    <input id="agents-search-input" name="search" type="text" value="{{ $search }}" placeholder="🔍 Search by name, email..." style="flex:1;min-width:200px;">
    <select id="agents-plan-filter" name="plan" style="width:170px;">
      <option {{ $planFilter === 'All Plans' ? 'selected' : '' }}>All Plans</option>
      <option {{ $planFilter === "Starter's Plan" ? 'selected' : '' }}>Starter's Plan</option>
      <option {{ $planFilter === "Professional's Plan" ? 'selected' : '' }}>Professional's Plan</option>
    </select>
    <select id="agents-status-filter" name="status" style="width:140px;">
      <option {{ $statusFilter === 'All Status' ? 'selected' : '' }}>All Status</option>
      <option {{ $statusFilter === 'Active' ? 'selected' : '' }}>Active</option>
      <option {{ $statusFilter === 'Inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
    <input id="agents-city-filter" name="city" type="text" value="{{ $cityFilter }}" placeholder="Filter by city..." style="width:160px;">
    <button id="agents-search-button" type="submit" class="btn btn-primary" style="min-width:110px;">🔎 Search</button>
  </form>
</div>

<div class="card" style="overflow-x:auto;">
  <table>
    <thead>
      <tr>
        <th>Agent</th>
        <th>Location</th>
        <th>Plan</th>
        <th>Rating</th>
        <th>Leads</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="agents-table-body">
      @forelse ($agents as $agent)
      <tr data-agent-row 
          data-plan="{{ strtolower($agent->selected_plan ?? 'No Plan') }}" 
          data-status="{{ strtolower($agent->status ?? 'unknown') }}"
          data-city="{{ strtolower($agent->address ?? '') }}">
        <td>
            <div style="font-weight:600;">{{ $agent->display_name ?: $agent->fullname }}</div>
            @if($agent->display_name && $agent->display_name !== $agent->fullname)
                <div style="font-size:11px;color:#808d9e;">Reg: {{ $agent->fullname }}</div>
            @endif
            <div style="font-size:11px;color:#808d9e;">{{ $agent->email }}</div>
        </td>
        <td>{{ $agent->address ?? 'N/A' }}</td>
        @php $plan = !empty($agent->selected_plan) ? $agent->selected_plan : 'No Plan'; @endphp
        <td><span class="badge {{ stripos($plan, 'Professional') !== false ? 'badge-primary' : 'badge-secondary' }}">
            {{ $plan }}
        </span></td>
        <td>⭐ {{ round($agent->avg_rating ?? 0, 1) ?: '—' }} <span style="color:#5f6b7a;font-size:12px;">({{ $agent->review_count }})</span></td>
        <td>{{ number_format($agent->lead_count) }}</td>
        <td>
          <button class="toggle {{ $agent->status === 'active' ? 'on' : 'off' }}" 
                  onclick="toggleAgentStatus({{ $agent->id }}, this)"></button>
        </td>
        <td><a href="{{ route('admin.agents.manage', $agent->id) }}" class="btn" style="font-size:12px;padding:4px 12px;background:#f8fafc;color:#1e293b;border:1px solid #e2e8f0;cursor:pointer;text-decoration:none;">⚙️ Manage</a></td>
      </tr>
      @empty
      <tr id="agents-no-results">
        <td colspan="7" style="text-align:center;padding:22px 16px;color:#5f6b7a;">No agents found matching your criteria.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
  <div id="agents-results-summary" style="padding:12px 16px;border-top:1px solid #d7e0ea;font-size:13px;color:#5f6b7a;">
    Total Agents: {{ collect($agents)->count() }}
  </div>
</div>




<script>
function toggleAgentStatus(id, btn) {
    const isNowActive = !btn.classList.contains('on');
    const newStatus = isNowActive ? 'active' : 'inactive';
    
    // Optimistic update
    btn.classList.toggle('on');
    btn.classList.toggle('off');

    fetch("{{ route('admin.agents.toggle_status', [], false) }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ id: id, status: newStatus })
    })
    .then(r => r.json())
    .then(data => {
        if (!data.success) {
            btn.classList.toggle('on');
            btn.classList.toggle('off');
            alert('Error updating status: ' + (data.message || 'Server error'));
        }
    })
    .catch(err => {
        btn.classList.toggle('on');
        btn.classList.toggle('off');
        console.error('Fetch error:', err);
        alert('Action failed. Detail: ' + err.message);
    });
}

// Automatically refresh page on "Back" navigation to ensure data is fresh
window.onpageshow = function(event) {
    if (event.persisted) {
        window.location.reload();
    }
};



function exportAgentsToCSV() {
    const rows = Array.from(document.querySelectorAll('#agents-table-body tr[data-agent-row]'));
    if (rows.length === 0) {
        alert("No agent data to export.");
        return;
    }

    let csvContent = "Agent Name,Email,Location,Plan,Rating,Leads,Status\n";
    
    rows.forEach(row => {
        if (row.style.display === 'none') return;

        const name = row.querySelector('strong')?.innerText || '';
        const email = row.querySelector('span[style*="color"]')?.innerText || '';
        const location = row.cells[1]?.innerText.trim() || 'N/A';
        const plan = row.cells[2]?.innerText.trim() || 'No Plan';
        const ratingMatch = row.cells[3]?.innerText.match(/(\d+\.\d+|\d+)/);
        const rating = ratingMatch ? ratingMatch[0] : '0';
        const leads = row.cells[4]?.innerText.trim() || '0';
        const status = row.dataset.status || 'unknown';

        const csvRow = [
            `"${name.replace(/"/g, '""')}"`,
            `"${email.replace(/"/g, '""')}"`,
            `"${location.replace(/"/g, '""')}"`,
            `"${plan.replace(/"/g, '""')}"`,
            rating,
            leads,
            status
        ].join(',');
        
        csvContent += csvRow + "\n";
    });

    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = `agents_export_${new Date().toISOString().slice(0,10)}.csv`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
@endsection
