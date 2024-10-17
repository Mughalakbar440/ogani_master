<?php

session_start();

include('connection.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$F_name = isset($_POST['Fname']) ? mysqli_real_escape_string($conn, $_POST['Fname']) : '';
$L_name = isset($_POST['Lname']) ? mysqli_real_escape_string($conn, $_POST['Lname']) : '';
$Father_name = isset($_POST['Fathername']) ? mysqli_real_escape_string($conn, $_POST['Fathername']) : '';
$VillageandTown = isset($_POST['Village']) ? mysqli_real_escape_string($conn, $_POST['Village']) : '';
$Address = isset($_POST['Address']) ? mysqli_real_escape_string($conn, $_POST['Address']) : '';
$Gender = isset($_POST['Gender']) ? mysqli_real_escape_string($conn, $_POST['Gender']) : '';
$State = isset($_POST['State']) ? mysqli_real_escape_string($conn, $_POST['State']) : '';
$City = isset($_POST['City']) ? mysqli_real_escape_string($conn, $_POST['City']) : '';
$Pincode = isset($_POST['Pincode']) ? mysqli_real_escape_string($conn, $_POST['Pincode']) : '';
$Mobile = isset($_POST['Mobile']) ? mysqli_real_escape_string($conn, $_POST['Mobile']) : '';
$Email = isset($_POST['Email']) ? mysqli_real_escape_string($conn, $_POST['Email']) : '';
$Password = isset($_POST['Password']) ? mysqli_real_escape_string($conn, $_POST['Password']) : '';

if ($F_name && $L_name && $Father_name && $VillageandTown && $Address && $Gender && $State && $City && $Pincode && $Mobile && $Email && $Password) {
    $sql = "INSERT INTO `regis_tab`(`First_name`, `Last_name`, `Fathers_name`, `Village/Town`, `Address`, `Gender`, `State`, `City`, `Pincode`, `Mobile`, `Email`, `Password`) 
            VALUES ('$F_name','$L_name','$Father_name','$VillageandTown','$Address','$Gender','$State','$City','$Pincode','$Mobile','$Email','$Password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Redirect to index page upon successful submission
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Please fill all the required fields.";
}

mysqli_close($conn);
?>
