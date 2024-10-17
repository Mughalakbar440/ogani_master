<?php
require("connection.php"); // Include your database connection
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['User'])) {
    die("User not logged in.");
}

$current_user_id = $_SESSION['User']['id']; // Now safely access the user ID

// Set receiver_id from POST or GET request
$receiver_id = isset($_POST['Admin_id']) ? htmlspecialchars(trim($_POST['receiver_id'])) : (isset($_GET['receiver_id']) ? htmlspecialchars(trim($_GET['receiver_id'])) : die("Receiver ID not set."));

// Fetch messages for the current conversation
$stmt = $conn->prepare("SELECT * FROM contact_msg_reply WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY created_at");
$stmt->bind_param("iiii", $current_user_id, $receiver_id, $receiver_id, $current_user_id);
$stmt->execute();
$result = $stmt->get_result();

// Handle message sending
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $message = htmlspecialchars(trim($_POST['message']));

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_msg_reply (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("iis", $current_user_id, $receiver_id, $message);

    if ($stmt->execute()) {
        // Redirect to refresh messages after sending
        header("Location: messages.php?receiver_id=$receiver_id");
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <style>
        .msg_history {
            max-height: 400px;
            overflow-y: auto;
        }
        .incoming_msg_img {
            display: inline-block;
            width: 40px;
        }
        .incoming_msg, .outgoing_msg {
            margin: 10px 0;
        }
        .time_date {
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center">Messaging with User ID: <?php echo htmlspecialchars($receiver_id); ?></h3>
        <div class="messaging">
            <div class="mesgs">
                <div class="msg_history">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php if ($row['sender_id'] == $current_user_id): ?>
                            <div class="outgoing_msg">
                                <div class="sent_msg">
                                    <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                                    <span class="time_date"><?php echo htmlspecialchars($row['created_at']); ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="incoming_msg">
                                <div class="incoming_msg_img">
                                    <img src="https://ptetutorials.com/images/user-profile.png" alt="user">
                                </div>
                                <div class="received_msg">
                                    <div class="received_withd_msg">
                                        <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                                        <span class="time_date"><?php echo htmlspecialchars($row['created_at']); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <div class="type_msg">
                    <form method="POST" action="messages.php">
                        <input type="hidden" name="receiver_id" value="<?php echo htmlspecialchars($receiver_id); ?>">
                        <input type="text" name="message" placeholder="Type a message" required class="form-control" />
                        <button type="submit" class="btn btn-primary mt-2">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
