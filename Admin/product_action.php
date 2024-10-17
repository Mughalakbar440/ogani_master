<?php
include('../connection.php');

// Check if the database connection is established
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$product = null;
$error = null;
$success = null;

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Fetch product data based on the ID
    $stmt = $conn->prepare("SELECT id, image, name, review, price, description, quantity, offer, note FROM product WHERE id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $error = "Product not found.";
    }

    $stmt->close();
} else {
    $error = "No product ID provided.";
}

// Handle form submission to update product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $name = $_POST['name'];
        $review = $_POST['review'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $quantity = intval($_POST['quantity']);
        $offer = $_POST['offer'];
        $note = $_POST['note'];

        // Update product data in the database
        $update_stmt = $conn->prepare("UPDATE product SET name = ?, review = ?, price = ?, description = ?, quantity = ?, offer = ?, note = ? WHERE id = ?");
        $update_stmt->bind_param('ssdsdssi', $name, $review, $price, $description, $quantity, $offer, $note, $id);

        if ($update_stmt->execute()) {
            $success = "Product updated successfully!";
        } else {
            $error = "Failed to update product.";
        }

        $update_stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content {
            padding: 20px;
        }

        .table img {
            max-width: 100px;
            height: auto;
        }

        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
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
            <h1 class="mb-4">Update Product</h1>
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php elseif (isset($success)): ?>
                        <div id="success-message" class="alert alert-success fade-out">
                            <?php echo htmlspecialchars($success); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($product)): ?>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?php echo htmlspecialchars($product['name']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="review">Review</label>
                                <input type="text" class="form-control" id="review" name="review" 
                                       value="<?php echo htmlspecialchars($product['review']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" 
                                       value="<?php echo htmlspecialchars($product['price']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" 
                                       value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="offer">Offer</label>
                                <input type="text" class="form-control" id="offer" name="offer" 
                                       value="<?php echo htmlspecialchars($product['offer']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" id="note" name="note" 
                                       value="<?php echo htmlspecialchars($product['note']); ?>" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update Product</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <a href="view_product.php" class="btn btn-primary">Back to Product List</a>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hide success message after 2 seconds
            if ($('#success-message').length) {
                setTimeout(function() {
                    $('#success-message').addClass('hide');
                }, 2000);
            }
        });
    </script>
</body>

</html>
