<?php
include ('../connection.php');

// Check if the database connection is established
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Fetch user data based on the ID
    $stmt = $conn->prepare("SELECT * FROM regis_tab WHERE id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $error = "User not found.";
    }

    $stmt->close();
} else {
    $error = "No user ID provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="content">

        <?php include 'includes/header.php'; ?>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <h2>User Details</h2>
                    <div class="d-flex justify-content-center">

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php elseif (isset($user)): ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Field</th>
                                        <th scope="col">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">First Name:</th>
                                        <td><?php echo htmlspecialchars($user['First_name']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Last Name:</th>
                                        <td><?php echo htmlspecialchars($user['Last_name']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Father's Name:</th>
                                        <td><?php echo htmlspecialchars($user['Fathers_name']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Village:</th>
                                        <td><?php echo htmlspecialchars($user['Village/Town']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address:</th>
                                        <td><?php echo htmlspecialchars($user['Address']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gender:</th>
                                        <td><?php echo htmlspecialchars($user['Gender']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">State:</th>
                                        <td><?php echo htmlspecialchars($user['State']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">City:</th>
                                        <td><?php echo htmlspecialchars($user['City']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pincode:</th>
                                        <td><?php echo htmlspecialchars($user['Pincode']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile:</th>
                                        <td><?php echo htmlspecialchars($user['Mobile']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email:</th>
                                        <td><?php echo htmlspecialchars($user['Email']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Password:</th>
                                        <td><?php echo htmlspecialchars($user['Password']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status:</th>
                                        <td><?php echo htmlspecialchars($user['status']); ?></td>
                                    </tr>
                                </tbody>

                            </table>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="user_data.php" class="btn btn-primary">Back to User Details</a>
                    </div>
                </div>
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>