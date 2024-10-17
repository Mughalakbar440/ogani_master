<?php
include('../connection.php');

// Check if the database connection is established
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX request for updating status
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
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $new_status, $user_id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
    exit;
}

// Fetch data from regis_tab
$sql = "SELECT * FROM regis_tab";
$user_data = $conn->query($sql);

// Check for query execution errors
if ($user_data === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <style>
        .content {
            padding: 20px;
        }

        .status-cell {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="content">
        <?php include 'includes/header.php'; ?>

        <div class="container mt-5">
            <h2 class="text-center mb-4">User Data</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Father's Name</th>
                            <th scope="col">Village</th>
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($user_data && $user_data->num_rows > 0) {
                            $counter = 1;
                            while ($row = $user_data->fetch_assoc()) {
                                $status = htmlspecialchars($row['status']);
                                $buttonText = ($status === 'active') ? 'Block' : 'Activate';
                                $newStatus = ($status === 'active') ? 'blocked' : 'active';

                                echo "<tr>
                                    <th scope='row'>{$counter}</th>
                                    <td>" . htmlspecialchars($row['First_name']) . "</td>
                                    <td>" . htmlspecialchars($row['Last_name']) . "</td>
                                    <td>" . htmlspecialchars($row['Fathers_name']) . "</td>
                                    <td>" . htmlspecialchars($row['Village/Town']) . "</td>
                                    <td>" . htmlspecialchars($row['Address']) . "</td>
                                    <td class='status-cell'>" . htmlspecialchars($status) . "</td>
                                    <td>
                                        <button class='btn btn-warning status-toggle' data-id='" . htmlspecialchars($row['id']) . "' data-status='" . $newStatus . "'>" . $buttonText . "</button>
                                    </td>
                                    <td>
                                        <a href='user_detail.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-info'>Details</a>
                                    </td>
                                </tr>";
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='9'>No records found or error in query execution</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.status-toggle').on('click', function () {
                var button = $(this);
                var userId = button.data('id');
                var newStatus = button.data('status');

                $.ajax({
                    url: '', // This URL points to the current file
                    type: 'POST',
                    data: {
                        user_id: userId,
                        new_status: newStatus
                    },
                    success: function (response) {
                        console.log(response); // Log response for debugging
                        if (response === 'success') {
                            var updatedText = (newStatus === 'active') ? 'Block' : 'Activate';
                            var updatedStatus = (newStatus === 'active') ? 'blocked' : 'active';
                            button.text(updatedText);
                            button.data('status', updatedStatus);
                            button.closest('tr').find('.status-cell').text(updatedStatus);
                        } else {
                            alert('Error updating status: ' + response);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error: ' + textStatus, errorThrown);
                        alert('Request failed: ' + textStatus);
                    }
                });
            });
        });
    </script>

</body>

</html>