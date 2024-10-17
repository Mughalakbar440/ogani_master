<?php
session_start();
include 'connection.php'; // Include your database connection

function getProductById($productId)
{
    global $mysqli; // Use the global connection variable

    $stmt = $mysqli->prepare("SELECT name, price, image FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = intval($_POST['product_id']);

    // Retrieve product details from the database
    $product = getProductById($productId);

    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][$productId] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
            'image' => $product['image']
        ];
    }

    // Redirect to cart page
    header('Location: cartdetail.php');
    exit();
}
?>