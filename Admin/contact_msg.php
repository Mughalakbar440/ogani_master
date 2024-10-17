<?php
require("../connection.php"); // Include your database connection file

$result = null; // Initialize the variable
$result = $conn->query("SELECT id, name, email, message, DATE(created_at) AS date, TIME(created_at) AS time 
FROM contact_msg 
ORDER BY id, created_at DESC;
");

if (!$result) {
    die("Query Failed: " . $conn->error); // Display the error message
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include 'includes/header.php'; ?>
            <!-- Navbar End -->

            <div class="container mt-5">
                <h2 class="mb-4">Messages</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th> <!-- Updated -->
                            <th>Time</th> <!-- Updated -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo nl2br($row['message']); ?></td>
                                    <td><?php echo $row['date']; ?></td> <!-- Updated -->
                                    <td><?php echo $row['time']; ?></td> <!-- Updated -->
                                    <td>
                                        <!-- Reply Button -->
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#replyModal-<?php echo $row['id']; ?>">Reply</button>
                                        ...
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No messages found</td> <!-- Updated column span -->
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Footer Start -->
            <?php include 'includes/footer.php'; ?>
            <!-- Footer End -->
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$conn->close(); // Close the database connection
?>