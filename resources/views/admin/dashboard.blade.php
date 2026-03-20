@extends('admin.layout')
@section('title', 'Dashboard - PadosiAgent Admin')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
  <div>
    <h1 style="font-size:28px;font-weight:800;margin:0;">Admin Panel</h1>
    <p style="color:#5f6b7a;font-size:14px;margin:4px 0 0;">Manage agents, distributors, and platform settings</p>
  </div>
  <button onclick="window.location.reload()" class="btn">🔄 Refresh</button>
</div>

<div class="tab-strip">
  <a class="tab-btn active" href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a class="tab-btn" href="{{ route('admin.agents') }}">👥 Agents</a>
  <a class="tab-btn" href="#">🏢 Distributors</a>
  <a class="tab-btn" href="#">📨 Messaging</a>
</div>

<div>
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:8px;">
    <select id="dashboardPeriodFilter" onchange="window.location.href='?period='+this.value" style="width:160px;padding:6px 10px;font-size:13px;border:1px solid #d7e0ea;border-radius:8px;">
      <option value="12" {{ $periodMonths == 12 ? 'selected' : '' }}>Last 12 Months</option>
      <option value="6" {{ $periodMonths == 6 ? 'selected' : '' }}>Last 6 Months</option>
      <option value="3" {{ $periodMonths == 3 ? 'selected' : '' }}>Last 3 Months</option>
    </select>
    <button id="exportCsvBtn" class="btn">📥 Export CSV</button>
  </div>

  <!-- ROW 1 -->
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:16px;">
    <div class="card kpi-card">
      <div class="kpi-icon">👥</div>
      <div style="margin-top:12px;">
        <div class="kpi-value">{{ number_format($totalAgents) }}</div>
        <div class="kpi-label">Total Agents</div>
      </div>
    </div>
    <div class="card kpi-card">
      <div class="kpi-icon" style="background:rgba(22,163,74,0.1);">✅</div>
      <div style="margin-top:12px;">
        <div class="kpi-value">{{ number_format($activeCount) }}</div>
        <div class="kpi-label">Active</div>
        <div style="font-size:10px;color:#5f6b7a;">{{ $activePercent }}%</div>
      </div>
    </div>
    <div class="card kpi-card">
      <div style="display:flex;justify-content:space-between;align-items:start;">
        <div class="kpi-icon" style="background:rgba(37,99,235,0.1);">➕</div>
        <span class="badge {{ $growthPercent >= 0 ? 'badge-green' : 'badge-destructive' }}" style="font-size:10px;">
          {{ $growthPercent >= 0 ? '↑' : '↓' }} {{ abs($growthPercent) }}%
        </span>
      </div>
      <div style="margin-top:12px;">
        <div class="kpi-value">{{ number_format($newThisMonth) }}</div>
        <div class="kpi-label">New This Month</div>
      </div>
    </div>
    <div class="card kpi-card">
      <div class="kpi-icon">🏢</div>
      <div style="margin-top:12px;">
        <div class="kpi-value">{{ number_format($distributors) }}</div>
        <div class="kpi-label">Distributors</div>
      </div>
    </div>
  </div>

  <!-- ROW 2 -->
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:16px;">
    <div class="card kpi-card">
      <div class="kpi-icon" style="background:rgba(16,185,129,0.1);">🛡️</div>
      <div style="margin-top:12px;">
        <div class="kpi-value">{{ $retentionRate }}%</div>
        <div class="kpi-label">Retention Rate</div>
        <div style="font-size:10px;color:#5f6b7a;">{{ $activeCount }}/{{ $totalAgents }}</div>
      </div>
    </div>
    <div class="card kpi-card">
      <div class="kpi-icon" style="background:rgba(99,102,241,0.1);">📈</div>
      <div style="margin-top:12px;">
        <div class="kpi-value">{{ $upgradeRate }}%</div>
        <div class="kpi-label">Upgrade Rate</div>
        <div style="font-size:10px;color:#5f6b7a;">Starter → Professional</div>
      </div>
    </div>
    <div class="card kpi-card">
      <div class="kpi-icon" style="background:rgba(245,158,11,0.1);">👁️</div>
      <div style="margin-top:12px;">
        <div class="kpi-value">{{ number_format($pageViews) }}</div>
        <div class="kpi-label">Total Page Views</div>
      </div>
    </div>
    <div class="card kpi-card">
      <div class="kpi-icon" style="background:rgba(244,63,94,0.1);">📊</div>
      <div style="margin-top:12px;">
        <div class="kpi-value">{{ number_format($totalLeads) }}</div>
        <div class="kpi-label">Total Leads</div>
      </div>
    </div>
  </div>

  <!-- RENEWAL CARD -->
  <div class="card" style="border-color:#ead7a3;background:#fffdf4;padding:20px;margin-bottom:24px;">
    <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px;">
      <span>🔄</span>
      <strong style="font-size:14px;">Renewal Dues</strong>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;text-align:center;">
      <div>
        <div style="font-size:24px;font-weight:800;">{{ $renewalStats['expired'] ?? 0 }}</div>
        <span class="badge badge-destructive" style="margin-top:4px;">Expired</span>
      </div>
      <div>
        <div style="font-size:24px;font-weight:800;">{{ $renewalStats['next_30'] ?? 0 }}</div>
        <span class="badge badge-amber" style="margin-top:4px;">≤ 30 Days</span>
      </div>
      <div>
        <div style="font-size:24px;font-weight:800;">{{ $renewalStats['next_60'] ?? 0 }}</div>
        <span class="badge badge-secondary" style="margin-top:4px;">31-60 Days</span>
      </div>
      <div>
        <div style="font-size:24px;font-weight:800;">{{ $renewalStats['next_90'] ?? 0 }}</div>
        <span class="badge" style="border:1px solid #d7e0ea;margin-top:4px;">61-90 Days</span>
      </div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:24px;">
    <div class="card" style="padding:20px;">
      <h3 style="font-size:15px;font-weight:600;margin:0 0 16px;display:flex;align-items:center;gap:8px;">📈 MoM Registration Growth</h3>
      <div class="chart-container"><canvas id="momChart"></canvas></div>
    </div>
    <div class="card" style="padding:20px;">
      <h3 style="font-size:15px;font-weight:600;margin:0 0 16px;display:flex;align-items:center;gap:8px;">🥧 Plan Distribution</h3>
      <div class="chart-container"><canvas id="pieChart"></canvas></div>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
    <div class="card" style="padding:20px;">
      <h3 style="font-size:15px;font-weight:600;margin:0 0 16px;display:flex;align-items:center;gap:8px;">📍 Top Cities</h3>
      <div class="chart-container"><canvas id="citiesChart"></canvas></div>
    </div>
    <div class="card" style="padding:20px;">
      <h3 style="font-size:15px;font-weight:600;margin:0 0 16px;display:flex;align-items:center;gap:8px;">⚡ Penetration &amp; Engagement</h3>
      <div style="margin-bottom:16px;">
        <div style="display:flex;justify-content:space-between;font-size:14px;margin-bottom:6px;">
          <span>Starter Plan</span><span style="font-weight:600;">{{ $starterCount }} ({{ $totalSubs > 0 ? round(($starterCount/$totalSubs)*100) : 0 }}%)</span>
        </div>
        <div style="height:8px;background:#edf3f8;border-radius:99px;overflow:hidden;">
          <div style="height:100%;width:{{ $totalSubs > 0 ? ($starterCount/$totalSubs)*100 : 0 }}%;background:#1d7d5d;border-radius:99px;"></div>
        </div>
      </div>
      <div style="margin-bottom:20px;">
        <div style="display:flex;justify-content:space-between;font-size:14px;margin-bottom:6px;">
          <span>Professional Plan</span><span style="font-weight:600;">{{ $profCount }} ({{ $upgradeRate }}%)</span>
        </div>
        <div style="height:8px;background:#edf3f8;border-radius:99px;overflow:hidden;">
          <div style="height:100%;width:{{ $upgradeRate }}%;background:#2258a5;border-radius:99px;"></div>
        </div>
      </div>
      <div class="separator"></div>
      <div style="font-size:14px;">
        <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
          <span style="color:#5f6b7a;">Avg Rating</span><span style="font-weight:600;">4.2 ⭐</span>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
          <span style="color:#5f6b7a;">Total Reviews</span><span style="font-weight:600;">156</span>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
          <span style="color:#5f6b7a;">Total Leads</span><span style="font-weight:600;">{{ number_format($totalLeads) }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;">
          <span style="color:#5f6b7a;">Total Page Views</span><span style="font-weight:600;">{{ number_format($pageViews) }}</span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const chartData = {
      mom: @json($momData ?? []),
      plans: @json($planBreakdown ?? []),
      cities: @json($cityData ?? [])
    };
    initializeCharts(chartData);
  });
</script>
@endsection
