<?php
session_start();
require("connection.php"); // Include your database connection

// Ensure the admin is logged in
if (!isset($_SESSION['Admin'])) {
    die("Admin not logged in.");
}

// Fetch the message details
$message_id = isset($_GET['message_id']) ? intval($_GET['message_id']) : die("Message ID not set.");
$stmt = $conn->prepare("SELECT * FROM contact_msg_reply WHERE id = ?");
$stmt->bind_param("i", $message_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Message not found.");
}

$message = $result->fetch_assoc();

// Handle reply submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply_message'])) {
    $reply = htmlspecialchars(trim($_POST['reply_message']));
    $user_id = $message['sender_id']; // Assuming sender_id is the user who sent the message

    // Insert the reply into the database
    $stmt = $conn->prepare("INSERT INTO contact_msg_reply (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $_SESSION['Admin']['id'], $user_id, $reply);
    
    if ($stmt->execute()) {
        echo "<script>alert('Reply sent successfully!'); window.location.href = 'messages.php?receiver_id=$user_id';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Reply</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Reply to User Message</h1>
        <div class="card">
            <div class="card-body">
                <h5><strong>User Message:</strong></h5>
                <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                <form method="POST">
                    <div class="form-group">
                        <label for="reply_message">Your Reply:</label>
                        <textarea class="form-control" id="reply_message" name="reply_message" required placeholder="Type your reply here"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Send Reply</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
