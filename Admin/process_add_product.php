<?php

require('..\connection.php');

// Check if the form was submitted
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
        $category_id= $_POST['category'];

        // Handle file upload
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image = $_FILES['image']['name'];
            $imageTmp = $_FILES['image']['tmp_name'];
            $uploadDir = 'uploads/';

            // Ensure the uploads directory exists and has the right permissions
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
            }

            // Move uploaded file to the server directory
            move_uploaded_file($imageTmp, $uploadDir . $image);
        }

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO product (image, name, review, price, description, quantity, offer, note,category_id) 
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssssssi", $image, $name, $review, $price, $description, $quantity, $offer, $note,$category_id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Redirect with JavaScript alert
            echo "<script>alert('Item set successfully'); window.location.href='view_product.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>