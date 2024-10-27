<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_id = intval($_POST['index'] ?? 0); // Get member ID safely


    // Database connection
    include("includes/config.php");

    // Prepare the delete query
    $stmt = $db->prepare("DELETE FROM members WHERE id = ?");
    $stmt->bind_param("i", $member_id);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Member deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting member: ' . $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();
    $db->close();
    exit();
} else {
    // Redirect if not a POST request
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit();
}
?>
