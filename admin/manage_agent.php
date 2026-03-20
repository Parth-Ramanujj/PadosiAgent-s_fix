<?php
/**
 * manage_agent.php - Full Agent Profile Management Page
 * PadosiAgent Admin
 */
require_once 'database.php';
check_auth();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id) {
    header('Location: agents.php');
    exit;
}

$successMsg = '';
$errorMsg   = '';

// ── Handle POST actions ──────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Save admin notes (INSERT or UPDATE safely)
    if ($action === 'save_notes') {
        $notes = trim($_POST['admin_notes'] ?? '');
        try {
            // Check if admin_notes column exists before saving
            $apColCheck = $pdo->query("SHOW COLUMNS FROM agent_profiles LIKE 'admin_notes'")->fetch();
            if ($apColCheck) {
                $stmt = $pdo->prepare("
                    INSERT INTO agent_profiles (agent_id, admin_notes)
                    VALUES (?, ?)
                    ON DUPLICATE KEY UPDATE admin_notes = VALUES(admin_notes)
                ");
                $stmt->execute([$id, $notes]);
                $successMsg = 'Admin notes saved successfully.';
            } else {
                $successMsg = 'Note: admin_notes column does not exist in DB yet. Notes not saved.';
            }
        } catch (PDOException $e) {
            $errorMsg = 'Failed to save notes: ' . $e->getMessage();
        }
    }

    // Toggle active / inactive
    if ($action === 'toggle_status') {
        $newStatus = $_POST['status'] ?? 'inactive';
        $newStatus = in_array($newStatus, ['active', 'inactive']) ? $newStatus : 'inactive';
        try {
            $pdo->prepare("UPDATE agents SET status = ? WHERE id = ?")->execute([$newStatus, $id]);
            $successMsg = 'Agent status updated to ' . ucfirst($newStatus) . '.';
        } catch (PDOException $e) {
            $errorMsg = 'Failed to update status.';
        }
    }

    // Change subscription plan
    if ($action === 'update_plan') {
        $newPlan = $_POST['selected_plan'] ?? '';
        try {
            $check = $pdo->prepare("SELECT id FROM agent_subscriptions WHERE agent_id = ?");
            $check->execute([$id]);

            if ($check->fetch()) {
                // Row exists — just update plan
                $pdo->prepare("UPDATE agent_subscriptions SET selected_plan = ? WHERE agent_id = ?")
                    ->execute([$newPlan, $id]);
            } else {
                // Detect all columns and provide safe defaults for any NOT NULL fields
                $subCols = $pdo->query("SHOW COLUMNS FROM agent_subscriptions")->fetchAll(PDO::FETCH_ASSOC);

                $insertCols = ['agent_id', 'selected_plan'];
                $insertVals = [$id, $newPlan];

                // Known safe defaults for extra required columns
                $defaults = [
                    'registration_amount' => 0,
                    'amount'              => 0,
                    'price'               => 0,
                    'fee'                 => 0,
                    'plan_amount'         => 0,
                    'status'              => 'active',
                    'is_active'           => 1,
                    'payment_status'      => 'pending',
                    'transaction_id'      => '',
                ];

                foreach ($subCols as $col) {
                    $name = $col['Field'];
                    if (in_array($name, ['id','agent_id','selected_plan','created_at','updated_at'])) continue;
                    if ($col['Null'] === 'YES' || $col['Extra'] === 'auto_increment') continue;
                    if ($col['Default'] !== null) continue; // DB has a default, skip
                    // Provide our own default
                    $insertCols[] = $name;
                    $insertVals[] = $defaults[$name] ?? 0;
                }

                $colList      = implode(', ', $insertCols);
                $placeholders = implode(', ', array_fill(0, count($insertVals), '?'));
                $pdo->prepare("INSERT INTO agent_subscriptions ($colList) VALUES ($placeholders)")
                    ->execute($insertVals);
            }
            $successMsg = 'Plan updated successfully.';
        } catch (PDOException $e) {
            $errorMsg = 'Failed to update plan: ' . $e->getMessage();
        }
    }

    // Toggle Review Approval
    if ($action === 'toggle_review_approval') {
        $reviewId = (int)($_POST['review_id'] ?? 0);
        $newApproval = (int)($_POST['is_approved'] ?? 0);
        try {
            $pdo->prepare("UPDATE agent_reviews SET is_approved = ? WHERE id = ?")->execute([$newApproval, $reviewId]);
            $successMsg = 'Review ' . ($newApproval ? 'approved' : 'rejected') . ' successfully.';
        } catch (PDOException $e) {
            $errorMsg = 'Failed to update review status.';
        }
    }

    // PRG – redirect to same page to avoid re-POST on refresh
    $redirectMsg = urlencode($successMsg ?: $errorMsg);
    $type = $successMsg ? 'ok' : 'err';
    header("Location: manage_agent.php?id=$id&msg=$type&text=$redirectMsg");
    exit;
}

// Carry flash messages from redirect
if (!empty($_GET['text'])) {
    if (($_GET['msg'] ?? '') === 'ok') {
        $successMsg = htmlspecialchars(urldecode($_GET['text']));
    } else {
        $errorMsg = htmlspecialchars(urldecode($_GET['text']));
    }
}

// ── Fetch agent data ────────────────────────────────────────────────────────
try {
    // Auto-detect actual columns in agent_profiles to avoid "Column not found" errors
    $apCols = $pdo->query("SHOW COLUMNS FROM agent_profiles")->fetchAll(PDO::FETCH_COLUMN);

    // Build SELECT list for agent_profiles columns that actually exist
    $apSelect = '';
    $apMap = [
        'address'          => 'address',
        'license_number'   => 'license_number',
        'license'          => 'license_number',
        'experience_years' => 'experience_years',
        'experience'       => 'experience_years',
        'office_address'   => 'office_address',
        'bio'              => 'bio',
        'admin_notes'      => 'admin_notes',
        'notes'            => 'admin_notes'
    ];
    $includedKeys = [];
    foreach ($apMap as $dbCol => $viewKey) {
        if (in_array($dbCol, $apCols) && !in_array($viewKey, $includedKeys)) {
            $apSelect .= ", ap.$dbCol AS $viewKey";
            $includedKeys[] = $viewKey;
        }
    }

    $stmt = $pdo->prepare("
        SELECT
            a.id, a.fullname, a.email, a.mobile, a.status, a.created_at, a.experience_range
            $apSelect,
            s.selected_plan,
            s.expires_at,
            (SELECT AVG(rating) FROM agent_reviews WHERE agent_id = a.id AND is_approved = 1) AS avg_rating,
            (SELECT COUNT(*)   FROM agent_reviews WHERE agent_id = a.id AND is_approved = 1) AS review_count,
            (SELECT COUNT(*)   FROM agent_reviews WHERE agent_id = a.id AND is_approved = 0) AS pending_reviews
        FROM agents a
        LEFT JOIN agent_profiles ap ON a.id = ap.agent_id
        LEFT JOIN agent_subscriptions s ON a.id = s.agent_id
        WHERE a.id = ?
    ");
    $stmt->execute([$id]);
    $agent = $stmt->fetch();

    if (!$agent) {
        header('Location: agents.php');
        exit;
    }

    $revStmt = $pdo->prepare("
        SELECT r.id, u.fullname AS client_name, r.rating, r.review AS review_text, r.is_approved, r.created_at
        FROM agent_reviews r
        LEFT JOIN users u ON r.user_id = u.id
        WHERE r.agent_id = ?
        ORDER BY r.created_at DESC
        LIMIT 10
    ");
    $revStmt->execute([$id]);
    $reviews = $revStmt->fetchAll();

} catch (PDOException $e) {
    error_log("manage_agent.php Error: " . $e->getMessage());
    die("<p style='color:red;font-family:sans-serif;padding:40px'>DB Error: " . htmlspecialchars($e->getMessage()) . "<br><a href='agents.php'>← Back</a></p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage: <?= h($agent['fullname']) ?> — PadosiAgent Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./admin_code.css">
  <style>
    .manage-grid{display:grid;grid-template-columns:340px 1fr;gap:24px}
    .info-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #edf3f8;font-size:14px}
    .info-row:last-child{border-bottom:none}
    .info-label{color:#5f6b7a;font-weight:500}
    .info-value{font-weight:600;text-align:right}
    .section-title{font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#5f6b7a;margin:0 0 14px}
    .avatar-circle{width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#1d7d5d,#2258a5);display:flex;align-items:center;justify-content:center;font-size:26px;font-weight:800;color:#fff;flex-shrink:0}
    .stat-box{background:#f8fafc;border:1px solid #edf3f8;border-radius:10px;padding:14px 18px;text-align:center;flex:1;min-width:100px}
    .stat-box .num{font-size:22px;font-weight:800}
    .stat-box .lbl{font-size:11px;color:#5f6b7a;margin-top:2px}
    .review-card{background:#f8fafc;border:1px solid #edf3f8;border-radius:10px;padding:14px;margin-bottom:10px}
    .plan-btn{padding:8px 18px;border-radius:8px;font-size:13px;font-weight:600;border:2px solid #d7e0ea;background:#fff;color:#5f6b7a;cursor:pointer;transition:all .15s}
    .plan-btn.selected{border-color:#1d7d5d;background:#e6f4f0;color:#1d7d5d}
    .plan-btn:hover:not(.selected){border-color:#aab8c8}
    .alert-success{background:#e6f4f0;border:1px solid #1d7d5d;color:#1a5c45;padding:10px 16px;border-radius:8px;font-size:14px;margin-bottom:16px}
    .alert-error{background:#fef2f2;border:1px solid #ef4444;color:#b91c1c;padding:10px 16px;border-radius:8px;font-size:14px;margin-bottom:16px}
    .expired-text{color:#ef4444}
    @media(max-width:900px){.manage-grid{grid-template-columns:1fr}}
  </style>
</head>
<body>

<!-- NAV -->
<nav style="position:fixed;top:0;left:0;right:0;z-index:40;background:#fff;border-bottom:1px solid #d7e0ea;padding:12px 24px;display:flex;align-items:center;justify-content:space-between;">
  <div>
    <img src="images/logo.png" alt="PadosiAgent" style="width:160px;height:68px;object-fit:contain;">
  </div>
  <div style="display:flex;align-items:center;gap:16px;">
    <span class="badge badge-primary">Admin</span>
    <a href="logout.php" style="font-size:13px;color:#ef4444;text-decoration:none;font-weight:600;">🚪 Logout</a>
  </div>
</nav>

<div class="content-container">

  <!-- BREADCRUMB -->
  <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:13px;color:#5f6b7a;">
    <a href="agents.php" style="color:#1d7d5d;text-decoration:none;font-weight:600;">👥 Agents</a>
    <span>›</span>
    <span style="font-weight:600;color:#1e293b;"><?= h($agent['fullname']) ?></span>
  </div>

  <!-- FLASH ALERTS -->
  <?php if ($successMsg): ?>
  <div class="alert-success">✅ <?= h($successMsg) ?></div>
  <?php endif; ?>
  <?php if ($errorMsg): ?>
  <div class="alert-error">❌ <?= h($errorMsg) ?></div>
  <?php endif; ?>

  <!-- HEADER -->
  <div style="display:flex;align-items:center;gap:16px;margin-bottom:24px;flex-wrap:wrap;">
    <div class="avatar-circle"><?= strtoupper(substr($agent['fullname'], 0, 1)) ?></div>
    <div style="flex:1;">
      <h1 style="font-size:24px;font-weight:800;margin:0;"><?= h($agent['fullname']) ?></h1>
      <p style="color:#5f6b7a;font-size:14px;margin:4px 0 0;"><?= h($agent['email']) ?> &nbsp;·&nbsp; <?= h($agent['mobile'] ?? 'No phone') ?></p>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
      <span class="badge <?= $agent['status'] === 'active' ? 'badge-green' : 'badge-destructive' ?>" style="font-size:13px;padding:6px 14px;">
        <?= $agent['status'] === 'active' ? '🟢 Active' : '🔴 Inactive' ?>
      </span>
      <form method="POST" action="manage_agent.php?id=<?= $id ?>" style="margin:0;">
        <input type="hidden" name="action" value="toggle_status">
        <input type="hidden" name="status" value="<?= $agent['status'] === 'active' ? 'inactive' : 'active' ?>">
        <button type="submit" class="btn" style="font-size:13px;">
          <?= $agent['status'] === 'active' ? '⏸ Deactivate' : '▶ Activate' ?>
        </button>
      </form>
      <a href="agents.php" class="btn" style="font-size:13px;background:#f1f5f9;color:#1e293b;border:1px solid #d7e0ea;text-decoration:none;">← Back</a>
    </div>
  </div>

  <!-- STATS ROW -->
  <div style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap;">
    <div class="stat-box">
      <div class="num">⭐ <?= $agent['avg_rating'] ? round($agent['avg_rating'], 1) : '—' ?></div>
      <div class="lbl">Avg Rating</div>
    </div>
    <div class="stat-box">
      <div class="num"><?= (int)$agent['review_count'] ?></div>
      <div class="lbl">Approved Reviews</div>
    </div>
    <div class="stat-box">
      <div class="num"><?= (int)$agent['pending_reviews'] ?></div>
      <div class="lbl">Pending Reviews</div>
    </div>
    <div class="stat-box">
      <div class="num"><?php 
        $exp = !empty($agent['experience_range']) ? $agent['experience_range'] : ($agent['experience_years'] ?? '—');
        echo h($exp) . (is_numeric($exp) ? ' yrs' : '');
      ?></div>
      <div class="lbl">Experience</div>
    </div>
    <div class="stat-box">
      <div class="num"><?= $agent['selected_plan'] ? '✅' : '❌' ?></div>
      <div class="lbl"><?= h($agent['selected_plan'] ?? 'No Plan') ?></div>
    </div>
  </div>

  <!-- MAIN GRID -->
  <div class="manage-grid">

    <!-- LEFT: Info + Subscription -->
    <div>

      <div class="card" style="padding:20px;margin-bottom:16px;">
        <p class="section-title">📋 Agent Information</p>
        <div class="info-row"><span class="info-label">Full Name</span><span class="info-value"><?= h($agent['fullname']) ?></span></div>
        <div class="info-row"><span class="info-label">Email</span><span class="info-value"><?= h($agent['email']) ?></span></div>
        <div class="info-row"><span class="info-label">Phone</span><span class="info-value"><?= h($agent['mobile'] ?? 'N/A') ?></span></div>
        <div class="info-row"><span class="info-label">Location</span><span class="info-value"><?= h($agent['address'] ?? 'N/A') ?></span></div>
        <div class="info-row"><span class="info-label">License No.</span><span class="info-value"><?= h($agent['license_number'] ?? 'Pending') ?></span></div>
        <div class="info-row"><span class="info-label">Experience</span><span class="info-value"><?php 
          $exp = !empty($agent['experience_range']) ? $agent['experience_range'] : ($agent['experience_years'] ?? '—');
          echo h($exp) . (is_numeric($exp) ? ' years' : '');
        ?></span></div>
        <div class="info-row"><span class="info-label">Registered On</span><span class="info-value"><?= date('d M Y', strtotime($agent['created_at'])) ?></span></div>
        <div class="info-row">
          <span class="info-label">Status</span>
          <span class="badge <?= $agent['status'] === 'active' ? 'badge-green' : 'badge-destructive' ?>"><?= ucfirst($agent['status']) ?></span>
        </div>
      </div>

      <div class="card" style="padding:20px;margin-bottom:16px;">
        <p class="section-title">💳 Subscription</p>
        <div class="info-row">
          <span class="info-label">Current Plan</span>
          <span class="badge <?= stripos($agent['selected_plan'] ?? '', 'Professional') !== false ? 'badge-primary' : 'badge-secondary' ?>">
            <?= h($agent['selected_plan'] ?? 'No Plan') ?>
          </span>
        </div>
        <div class="info-row">
          <span class="info-label">Expires At</span>
          <?php
            $expired = !empty($agent['expires_at']) && strtotime($agent['expires_at']) < time();
            $expText = !empty($agent['expires_at']) ? date('d M Y', strtotime($agent['expires_at'])) : 'N/A';
          ?>
          <span class="info-value <?= $expired ? 'expired-text' : '' ?>"><?= h($expText) ?></span>
        </div>

        <form method="POST" action="manage_agent.php?id=<?= $id ?>" style="margin-top:14px;">
          <input type="hidden" name="action" value="update_plan">
          <p style="font-size:13px;font-weight:600;margin:0 0 10px;">Change Plan:</p>
          <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <button type="submit" name="selected_plan" value="Starter's Plan"
              class="plan-btn <?= ($agent['selected_plan'] ?? '') === "Starter's Plan" ? 'selected' : '' ?>">
              Starter's
            </button>
            <button type="submit" name="selected_plan" value="Professional's Plan"
              class="plan-btn <?= ($agent['selected_plan'] ?? '') === "Professional's Plan" ? 'selected' : '' ?>">
              Professional's
            </button>
            <button type="submit" name="selected_plan" value=""
              class="plan-btn <?= empty($agent['selected_plan']) ? 'selected' : '' ?>">
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
        <?php foreach (['Full Profile Visibility','Certificates Section','Achievements Section','Comments / Reviews Section'] as $lbl): ?>
        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#f8fafc;border-radius:8px;border:1px solid #edf3f8;margin-bottom:10px;">
          <span style="font-size:14px;font-weight:500;"><?= $lbl ?></span>
          <button type="button" class="toggle on" onclick="this.classList.toggle('on');this.classList.toggle('off');"></button>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="card" style="padding:20px;margin-bottom:16px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;">
            <p class="section-title" style="margin:0;">⭐ Recent Reviews</p>
            <div style="font-size:12px;color:#5f6b7a;">
                <span style="color:#22c55e;">●</span> <?= (int)$agent['review_count'] ?> Approved &nbsp;
                <span style="color:#f59e0b;">●</span> <?= (int)$agent['pending_reviews'] ?> Pending
            </div>
        </div>
        <?php if (empty($reviews)): ?>
          <p style="font-size:14px;color:#5f6b7a;margin:0;">No reviews yet.</p>
        <?php else: ?>
          <?php foreach ($reviews as $r): ?>
          <div class="review-card" style="position:relative;margin-bottom:12px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
            <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
              <strong style="font-size:14px;"><?= h($r['client_name'] ?: 'Anonymous') ?></strong>
              <span style="font-size:13px;color:#f59e0b;">
                <?= str_repeat('⭐', min(5, (int)($r['rating'] ?? 0))) ?>
              </span>
            </div>
            
            <p style="font-size:13px;color:#5f6b7a;margin:0 0 8px;line-height:1.5;">
              <?= nl2br(h($r['review_text'] ?: 'No comment provided.')) ?>
            </p>

            <div style="display:flex;justify-content:space-between;align-items:center;">
              <span style="font-size:11px;color:#94a3b8;"><?= isset($r['created_at']) ? date('d M Y', strtotime($r['created_at'])) : '' ?></span>
              
              <form method="POST" action="manage_agent.php?id=<?= $id ?>" style="margin:0;">
                <input type="hidden" name="action" value="toggle_review_approval">
                <input type="hidden" name="review_id" value="<?= $r['id'] ?>">
                <input type="hidden" name="is_approved" value="<?= ($r['is_approved'] ?? 0) ? 0 : 1 ?>">
                <button type="submit" style="
                  border:none;
                  padding:4px 10px;
                  border-radius:4px;
                  font-size:11px;
                  font-weight:600;
                  cursor:pointer;
                  transition:0.2s;
                  <?= ($r['is_approved'] ?? 0) ? 'background:#dcfce7;color:#15803d;' : 'background:#fee2e2;color:#b91c1c;' ?>
                " onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                  <?= ($r['is_approved'] ?? 0) ? '✓ Approved' : '✗ Pending' ?>
                </button>
              </form>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <div class="card" style="padding:20px;">
        <p class="section-title">📝 Admin Notes</p>
        <form method="POST" action="manage_agent.php?id=<?= $id ?>">
          <input type="hidden" name="action" value="save_notes">
          <textarea name="admin_notes" rows="5"
            placeholder="Internal notes about this agent (not visible to agent)..."
            style="width:100%;border:1px solid #d7e0ea;border-radius:8px;padding:10px;font-size:14px;font-family:inherit;resize:vertical;box-sizing:border-box;margin-bottom:10px;"><?= h($agent['admin_notes'] ?? '') ?></textarea>
          <button type="submit" class="btn btn-primary" style="font-size:13px;">💾 Save Notes</button>
        </form>
      </div>

    </div>
  </div>

</div>
</body>
</html>
