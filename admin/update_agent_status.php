<?php
/**
 * update_agent_status.php - AJAX endpoint for updating agent status
 */
require_once 'database.php';

header('Content-Type: application/json');

// Only allow POST requests for updates
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$id = $_POST['id'] ?? 0;
$status = $_POST['status'] ?? ''; // 'active' or 'inactive'

if (!$id || !in_array($status, ['active', 'inactive'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE agents SET status = ? WHERE id = ?");
    $success = $stmt->execute([$status, $id]);

    if ($success) {
        echo json_encode(['success' => true, 'id' => $id, 'status' => $status]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update database']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
