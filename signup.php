<?php

include('dbconfig.php');
//create connection
$conn=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//CHECK CONNECTION
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());

}

$username = mysqli_real_escape_string($conn, $_POST['fname']);
$number=mysqli_real_escape_string($conn,$_POST['number']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$password=mysqli_real_escape_string($conn,$_POST['password']);



if(empty($username) || empty($number) || empty($email) || empty($password)) {
    echo"Please fill required fields";
    exit;
}

$sql_check="SELECT * from users where username='$username'
    or email='$email' limit 1";

$result_check=mysqli_query($conn,$sql_check);

if(mysqli_num_rows($result_check)>0) {
    echo"username or email already exists";
    exit;
}

$sql=" INSERT INTO users (username,number,email,password) VALUES ('$username','$number','$email','$password')";

if (mysqli_query($conn, $sql)) {
    echo "Registration sucess : ";
    header("Location: signin.php");
exit(); 

}
else {
    echo "Error :". mysqli_error($conn);
}

mysqli_close($conn);

?>