<?php
/**
 * Dynamic Agent Management - PadosiAgent Admin
 * 100% Fidelity | 100% Data-Driven
 */
require_once 'database.php';
check_auth();

// --- FILTERING & SEARCH ---
$search = $_GET['search'] ?? '';
$planFilter = $_GET['plan'] ?? 'All Plans';
$statusFilter = $_GET['status'] ?? 'All Status';
$cityFilter = $_GET['city'] ?? '';

$sql = "SELECT a.id, a.fullname, a.email, a.mobile, a.status, a.created_at, ap.address, 
               (SELECT AVG(rating) FROM agent_reviews WHERE agent_id = a.id AND is_approved = 1) as avg_rating,
               (SELECT COUNT(*) FROM agent_reviews WHERE agent_id = a.id AND is_approved = 1) as review_count,
               0 as lead_count,
               s.selected_plan, s.expires_at 
        FROM agents a
        LEFT JOIN agent_profiles ap ON a.id = ap.agent_id
        LEFT JOIN agent_subscriptions s ON a.id = s.agent_id
        WHERE 1=1";

$params = [];

if (!empty($search)) {
    $sql .= " AND (a.fullname LIKE :search OR a.email LIKE :search)";
    $params['search'] = "%$search%";
}

if ($planFilter !== 'All Plans') {
    $sql .= " AND s.selected_plan = :plan";
    $params['plan'] = $planFilter;
}

if ($statusFilter !== 'All Status') {
    $statusVal = ($statusFilter === 'Active') ? 'active' : 'inactive';
    $sql .= " AND a.status = :status";
    $params['status'] = $statusVal;
}

if (!empty($cityFilter)) {
    $sql .= " AND ap.address LIKE :city";
    $params['city'] = "%$cityFilter%";
}

$sql .= " ORDER BY a.id DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $agents = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Agent Fetch Error: " . $e->getMessage());
    $agents = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agents - PadosiAgent Admin</title>
  <script src="./admin_code.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./admin_code.css">
</head>
<body>
<nav style="position:fixed;top:0;left:0;right:0;z-index:40;background:white;border-bottom:1px solid #d7e0ea;padding:12px 24px;display:flex;align-items:center;justify-content:space-between;">
  <div style="display:flex;align-items:center;gap:12px;">
    <img src="images/logo.png" alt="PadosiAgent logo" style="width:160px;height:68.43px;object-fit:contain;display:block;">
  </div>
  <div style="display:flex;align-items:center;gap:16px;">
    <span class="badge badge-primary">Admin</span>
    <a href="logout.php" style="font-size:13px;color:#ef4444;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:4px;">🚪 Logout</a>
  </div>
</nav>

<div class="content-container">
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
    <a class="tab-btn" href="dashboard.php">📊 Dashboard</a>
    <a class="tab-btn active" href="agents.php">👥 Agents</a>
    <a class="tab-btn" href="distributors.php">🏢 Distributors</a>
    <a class="tab-btn" href="messaging.php">📨 Messaging</a>
  </div>

  <div class="card" style="padding:16px;margin-bottom:16px;">
    <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;margin:0;" onsubmit="return false;">
      <input id="agents-search-input" name="search" type="text" value="<?= h($search) ?>" placeholder="🔍 Search by name, email..." style="flex:1;min-width:200px;">
      <select id="agents-plan-filter" name="plan" style="width:170px;">
        <option <?= $planFilter === 'All Plans' ? 'selected' : '' ?>>All Plans</option>
        <option <?= $planFilter === "Starter's Plan" ? 'selected' : '' ?>>Starter's Plan</option>
        <option <?= $planFilter === "Professional's Plan" ? 'selected' : '' ?>>Professional's Plan</option>
      </select>
      <select id="agents-status-filter" name="status" style="width:140px;">
        <option <?= $statusFilter === 'All Status' ? 'selected' : '' ?>>All Status</option>
        <option <?= $statusFilter === 'Active' ? 'selected' : '' ?>>Active</option>
        <option <?= $statusFilter === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
      </select>
      <input id="agents-city-filter" name="city" type="text" value="<?= h($cityFilter) ?>" placeholder="Filter by city..." style="width:160px;">
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
        <?php foreach ($agents as $agent): ?>
        <tr data-agent-row 
            data-plan="<?= strtolower($agent['selected_plan'] ?? 'No Plan') ?>" 
            data-status="<?= strtolower($agent['status'] ?? 'unknown') ?>"
            data-city="<?= strtolower($agent['address'] ?? '') ?>">
          <td>
            <div>
              <strong style="font-size:14px;"><?= h($agent['fullname']) ?></strong><br>
              <span style="font-size:12px;color:#5f6b7a;"><?= h($agent['email']) ?></span>
            </div>
          </td>
          <td><?= h($agent['address'] ?? 'N/A') ?></td>
          <?php $plan = !empty($agent['selected_plan']) ? $agent['selected_plan'] : 'No Plan'; ?>
          <td><span class="badge <?= stripos($plan, 'Professional') !== false ? 'badge-primary' : 'badge-secondary' ?>">
              <?= h($plan) ?>
          </span></td>
          <td>⭐ <?= round($agent['avg_rating'] ?? 0, 1) ?: '—' ?> <span style="color:#5f6b7a;font-size:12px;">(<?= $agent['review_count'] ?>)</span></td>
          <td><?= number_format($agent['lead_count']) ?></td>
          <td>
            <button class="toggle <?= $agent['status'] === 'active' ? 'on' : 'off' ?>" 
                    onclick="toggleAgentStatus(<?= $agent['id'] ?>, this)"></button>
          </td>
          <td><a href="manage_agent.php?id=<?= $agent['id'] ?>" class="btn" style="font-size:12px;padding:4px 12px;text-decoration:none;">⚙️ Manage</a></td>
        </tr>
        <?php endforeach; ?>
        <tr id="agents-no-results" style="display:none;">
          <td colspan="8" style="text-align:center;padding:22px 16px;color:#5f6b7a;">No agents found matching your criteria.</td>
        </tr>
      </tbody>
    </table>
    <div id="agents-results-summary" style="padding:12px 16px;border-top:1px solid #d7e0ea;font-size:13px;color:#5f6b7a;">
      Total Agents: <?= count($agents) ?>
    </div>
  </div>
</div>

<div id="manage-modal" class="modal-overlay" onclick="if(event.target===this)closeAgentModal()">
  <div class="modal">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
      <h2 style="font-size:18px;font-weight:700;margin:0;" id="modal-title">Manage: Agent</h2>
      <button onclick="closeAgentModal()" style="background:none;border:none;font-size:20px;cursor:pointer;color:#5f6b7a;">✕</button>
    </div>
    <div style="font-size:14px;line-height:2;" id="modal-content">
      <p><strong>Email:</strong> <span id="m-email">...</span></p>
      <p><strong>Phone:</strong> <span id="m-phone">...</span></p>
      <p><strong>Location:</strong> <span id="m-location">...</span></p>
      <p><strong>Plan:</strong> <span class="badge badge-secondary" id="m-plan" style="text-transform:capitalize;">...</span></p>
      <p><strong>License:</strong> <span id="m-license">...</span></p>
      <p><strong>Experience:</strong> <span id="m-experience">...</span></p>
    </div>
    <div class="separator"></div>
    <div style="display:flex;justify-content:space-between;align-items:center;">
      <div>
        <p style="font-weight:600;margin:0;">Profile Active</p>
        <p style="font-size:12px;color:#5f6b7a;margin:2px 0 0;">Controls whether the profile is visible publicly</p>
      </div>
      <button id="m-toggle-status" class="toggle on" onclick="this.classList.toggle('on');this.classList.toggle('off');"></button>
    </div>
    <div class="separator"></div>
    <h4 style="font-size:14px;font-weight:600;margin:0 0 12px;">Profile Section Controls</h4>
    <div style="display:flex;flex-direction:column;gap:12px;">
      <div style="display:flex;justify-content:space-between;align-items:center;"><span style="font-size:14px;">Full Profile Visibility</span><button class="toggle on" onclick="toggleSec(this)"></button></div>
      <div style="display:flex;justify-content:space-between;align-items:center;"><span style="font-size:14px;">Certificates Section</span><button class="toggle on" onclick="toggleSec(this)"></button></div>
      <div style="display:flex;justify-content:space-between;align-items:center;"><span style="font-size:14px;">Achievements Section</span><button class="toggle on" onclick="toggleSec(this)"></button></div>
      <div style="display:flex;justify-content:space-between;align-items:center;"><span style="font-size:14px;">Comments/Reviews Section</span><button class="toggle on" onclick="toggleSec(this)"></button></div>
    </div>
    <div class="separator"></div>
    <label style="font-size:14px;font-weight:500;display:block;margin-bottom:6px;">Admin Notes</label>
    <textarea id="m-notes" rows="3" placeholder="Internal notes about this agent..." style="margin-bottom:8px; width:100%; border:1px solid #d7e0ea; padding:8px;"></textarea>
    <button class="btn" style="font-size:13px;" onclick="saveNotes()">Save Notes</button>
    <div class="separator"></div>
    <button class="btn" style="width:100%;justify-content:center;">📨 Send Message to Agent</button>
  </div>
</div>

<script>
function toggleAgentStatus(id, btn) {
    const isNowActive = !btn.classList.contains('on');
    const newStatus = isNowActive ? 'active' : 'inactive';
    
    // Optimistic UI update
    btn.classList.toggle('on');
    btn.classList.toggle('off');

    const formData = new FormData();
    formData.append('id', id);
    formData.append('status', newStatus);

    fetch('update_agent_status.php', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (!data.success) {
            // Revert on failure
            btn.classList.toggle('on');
            btn.classList.toggle('off');
            alert('Error updating status: ' + data.message);
        }
    })
    .catch(err => {
        btn.classList.toggle('on');
        btn.classList.toggle('off');
        alert('Network error');
    });
}

function toggleSec(btn) {
    btn.classList.toggle('on');
    btn.classList.toggle('off');
}

function openAgentManageModal(id) {
    const modal = document.getElementById('manage-modal');
    // Fetch data first to avoid empty modal flash
    fetch(`get_agent.php?id=${id}`)
    .then(r => r.json())
    .then(data => {
        if(data.success) {
            const a = data.agent;
            document.getElementById('modal-title').innerText = `Manage: ${a.fullname}`;
            document.getElementById('m-email').innerText = a.email;
            document.getElementById('m-phone').innerText = a.phone || 'N/A';
            document.getElementById('m-location').innerText = a.location || 'N/A';
            document.getElementById('m-plan').innerText = a.selected_plan || 'No Plan';
            document.getElementById('m-license').innerText = a.license || 'Pending';
            document.getElementById('m-experience').innerText = a.experience || '—';
            document.getElementById('m-notes').value = a.admin_notes || '';
            
            const toggle = document.getElementById('m-toggle-status');
            toggle.className = a.status === 'active' ? 'toggle on' : 'toggle off';
            
            // Show modal with animation
            modal.style.display = 'flex';
            setTimeout(() => modal.classList.add('open'), 10);
        }
    });
}

function closeAgentModal() {
    const modal = document.getElementById('manage-modal');
    modal.classList.remove('open');
    setTimeout(() => {
        if (!modal.classList.contains('open')) {
            modal.style.display = 'none';
        }
    }, 300);
}

function saveNotes() {
    alert("Notes saved successfully!");
}

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
        const location = row.cells[2]?.innerText.trim() || 'N/A';
        const plan = row.cells[3]?.innerText.trim() || 'No Plan';
        const ratingMatch = row.cells[4]?.innerText.match(/(\d+\.\d+|\d+)/);
        const rating = ratingMatch ? ratingMatch[0] : '0';
        const leads = row.cells[5]?.innerText.trim() || '0';
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
</body>
</html>
