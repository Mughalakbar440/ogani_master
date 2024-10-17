<?php
include('../connection.php');


// Check if the database connection is established
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error = null;
$success = null;

// Handle visibility updates
if (isset($_POST['update_visibility'])) {
    $visibility = $_POST['visibility'];
    foreach ($visibility as $id => $value) {
        $stmt = $conn->prepare("UPDATE product SET visible = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ii", $value, $id);
            $stmt->execute();
            $stmt->close();
        } else {
            $error = "Failed to prepare the SQL statement.";
        }
    }
    $success = "Visibility updated successfully!";
}

// Fetch data from the products table
$sql = "SELECT id, image, name, review, price, description, quantity, offer, note, visible FROM product";
$result = $conn->query($sql);

// Check for query execution errors
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .table img {
            max-width: 100px;
        }

        .fade-out {
            transition: opacity 1s ease-out;
            opacity: 1;
        }

        .fade-out.hide {
            opacity: 0;
        }
    </style>
</head>

<body>
    <div class="content">
        <?php include 'includes/header.php'; ?>

        <div class="container mt-5">
            <h1>Product List</h1>
            <button type="button" id="select-all" class="btn btn-secondary">Select All</button>
            <button type="button" id="deselect-all" class="btn btn-secondary">Deselect All</button>

            <form method="POST">
                <div class="table-responsive" style="margin-top:10px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Review</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Offer</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $checked = $row["visible"] ? "checked" : "";
                                    echo "<tr>";
                                    echo "<td><input type='checkbox' name='visibility[" . htmlspecialchars($row["id"]) . "]' value='1' $checked></td>";
                                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                    echo "<td><img src='uploads/" . htmlspecialchars($row["image"]) . "' alt='Product Image'></td>";
                                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["review"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["offer"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["note"]) . "</td>";
                                    echo "<td>
                                            <a href='edit_product.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-info btn-sm'>Edit</a>
                                            <a href='delete_product.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='11'>No products found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" name="update_visibility" class="btn btn-primary">Update Visibility</button>
                <a class="btn btn-primary" href="add_product.php">Add Product</a>
            </form>

            <!-- Success Message -->
            <?php if (isset($success)): ?>
                <div id="success-message" class="alert alert-success fade-out mt-3">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php include 'includes/footer.php'; ?>
    </div>

    <script>
        $(document).ready(function () {
            $('#select-all').click(function () {
                $('input[name^="visibility"]').prop('checked', true);
            });

            $('#deselect-all').click(function () {
                $('input[name^="visibility"]').prop('checked', false);
            });

            // Hide success message after 2 seconds
            if ($('#success-message').length) {
                setTimeout(function () {
                    $('#success-message').addClass('hide');
                }, 2000);
            }
        });
    </script>
</body>

</html>