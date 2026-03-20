<?php
/**
 * get_agent.php - AJAX endpoint for fetching agent details
 */
require_once 'database.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? 0;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'Invalid Agent ID']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT a.*, 
               ap.address, ap.license_number, ap.experience_years, ap.office_address,
               s.selected_plan, s.expires_at,
               (SELECT AVG(rating) FROM agent_reviews WHERE agent_id = a.id AND is_approved = 1) as avg_rating
        FROM agents a
        LEFT JOIN agent_profiles ap ON a.id = ap.agent_id
        LEFT JOIN agent_subscriptions s ON a.id = s.agent_id
        WHERE a.id = ?
    ");
    $stmt->execute([$id]);
    $agent = $stmt->fetch();

    if ($agent) {
        // Map fields for frontend convenience
        $agent['phone'] = $agent['mobile'] ?? 'N/A';
        $agent['location'] = $agent['address'] ?? 'N/A';
        $agent['license'] = $agent['license_number'] ?? 'Pending';
        $agent['experience'] = $agent['experience_years'] ?? '—';
        
        echo json_encode(['success' => true, 'agent' => $agent]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Agent not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
