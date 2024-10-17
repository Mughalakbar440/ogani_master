<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require('..\connection.php'); // Ensure the path is correct
    
    // Check if the ID is set in the query string
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Sanitize the ID
    
        // Fetch the product details
        $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $product = $result->fetch_assoc();
        } else {
            die("Product not found.");
        }
        $stmt->close();
    } else {
        die("No ID specified.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all required fields are set
        if (isset($_POST['name'], $_POST['review'], $_POST['price'], $_POST['description'], $_POST['quantity'], $_POST['offer'], $_POST['note'])) {

            // Collect and sanitize form data
            $name = $conn->real_escape_string($_POST['name']);
            $review = $conn->real_escape_string($_POST['review']);
            $price = $conn->real_escape_string($_POST['price']);
            $description = $conn->real_escape_string($_POST['description']);
            $quantity = $conn->real_escape_string($_POST['quantity']);
            $offer = $conn->real_escape_string($_POST['offer']);
            $note = $conn->real_escape_string($_POST['note']);

            // Handle file upload if a new image is uploaded
            $image = $product['image']; // Default to existing image
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $image = $_FILES['image']['name'];
                $imageTmp = $_FILES['image']['tmp_name'];
                $uploadDir = 'uploads/';

                // Move uploaded file to the server directory
                move_uploaded_file($imageTmp, $uploadDir . $image);
            }

            // Prepare the SQL statement
            $stmt = $conn->prepare("UPDATE product SET name = ?, review = ?, price = ?, description = ?, quantity = ?, offer = ?, note = ?, image = ? WHERE id = ?");
            $stmt->bind_param("ssssssssi", $name, $review, $price, $description, $quantity, $offer, $note, $image, $id);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "<script>alert('Item updated successfully'); window.location.href='view_product.php';</script>";
            } else {
                echo "Error updating record: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Please fill in all required fields.";
        }
    }

    $conn->close();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Edit Product</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    </head>

    <body>
        <div class="content">
            <?php include 'includes/header.php'; ?>

            <div class="container mt-5">

                <h2>Edit Product</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?php echo htmlspecialchars($product['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Review</label>
                        <input type="text" class="form-control" id="review" name="review"
                            value="<?php echo htmlspecialchars($product['review']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price"
                            value="<?php echo htmlspecialchars($product['price']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"
                            required><?php echo htmlspecialchars($product['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                            value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="offer" class="form-label">Offer</label>
                        <input type="text" class="form-control" id="offer" name="offer"
                            value="<?php echo htmlspecialchars($product['offer']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note"
                            required><?php echo htmlspecialchars($product['note']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <small>Current image: <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>"
                                alt="Current Image" style="width: 100px;"></small>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="view_product.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
            <?php include 'includes/footer.php'; ?>

        </div>
    </body>

    </html>

</body>

</html>