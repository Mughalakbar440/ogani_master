<?php
include ('../connection.php');

// Check if the database connection is established
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $new_status = $_POST['new_status'];

    // Validate input
    if (empty($user_id) || empty($new_status)) {
        echo 'error';
        exit;
    }

    // Update user status in the database
    $sql = "UPDATE regis_tab SET status = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('si', $new_status, $user_id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $con->close();
    exit;
}
?>
