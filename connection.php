<?php
// Database credentials
$servername = "localhost"; // Or your database server address
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "ogani_master"; // Replace with your database name

// Display errors for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
function pre($p){
    echo"<pre>";
    print_r($p);
    echo"</pre>";
    exit;
}
?>
