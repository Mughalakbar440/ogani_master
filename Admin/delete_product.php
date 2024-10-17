<?php
require('..\connection.php'); // Ensure the path is correct

// Check if the ID is set in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Successfully deleted
        header("Location: view_product.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error; // Display error
    }

    $stmt->close();
} else {
    echo "No ID specified."; // Handle case where ID isn't provided
}

$conn->close();
?>
