<?php
// Database connection
include('../connection.php');

// Handle deletion
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM category WHERE id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Category deleted successfully!');</script>";
}

// Handle edit form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $categoryId = $_POST['id'];
    $categoryName = $_POST['categoryName'];
    $categoryImage = $_FILES['categoryImage'];
    $uploadFile = '';

    // Process the uploaded file if an image is provided
    if ($categoryImage['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($categoryImage['name']);
        move_uploaded_file($categoryImage['tmp_name'], $uploadFile);
    } else {
        // If no new image, keep the existing one
        $existingCategory = $conn->query("SELECT image FROM category WHERE id = $categoryId")->fetch_assoc();
        $uploadFile = $existingCategory['image'];
    }

    // Update category in the database
    $stmt = $conn->prepare("UPDATE category SET category_name = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssi", $categoryName, $uploadFile, $categoryId);
    
    if ($stmt->execute()) {
        echo "<script>alert('Category updated successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch categories from the database
$sql = "SELECT id, category_name, image FROM category";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="content">
            <?php include 'includes/header.php'; ?>
            <h2 class="text-center mt-5">Categories</h2>
            <div class="container mt-5">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['category_name']) . "</td>";
                                echo "<td><img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['category_name']) . "' style='width: 100px; height: auto;'></td>";
                                echo "<td>
                                        <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>Edit</button>
                                        <a href='?action=delete&id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Delete</a>
                                      </td>";
                                echo "</tr>";
                                
                                // Edit Modal
                                echo "
                                <div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editModalLabel'>Edit Category</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <form method='POST' enctype='multipart/form-data'>
                                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                    <div class='mb-3'>
                                                        <label for='categoryName' class='form-label'>Category Name</label>
                                                        <input type='text' class='form-control' id='categoryName' name='categoryName' value='" . htmlspecialchars($row['category_name']) . "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='categoryImage' class='form-label'>Category Image</label>
                                                        <input type='file' class='form-control' id='categoryImage' name='categoryImage' accept='image/*'>
                                                        <img src='" . htmlspecialchars($row['image']) . "' alt='Current Image' style='width: 100px; height: auto; margin-top: 10px;'>
                                                    </div>
                                                    <button type='submit' name='edit' class='btn btn-primary'>Update Category</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No categories found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
