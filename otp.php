<?php
session_start();
include("connection.php");
if(isset($_POST['submit'])){
    $otp = $_POST['otp'];
    $otpString = implode('', $otp);
    if ($_SESSION['User']['otp'] == $otpString) {

        echo "success";

    }else{
        echo "your otp is not get successfully ";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa; /* Light grey background */
            height: 100vh; /* Full height of the viewport */
            display: flex;
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
            margin: 0; /* Remove default margin */
        }

        .bgWhite {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            border-radius: 10px; /* Rounded corners */
            padding: 30px; /* Padding for better spacing */
            width: 100%; /* Full width for responsiveness */
            max-width: 400px; /* Max width for larger screens */
        }

        .title {
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .customBtn {
            border-radius: 5px; /* Slightly rounded button */
            padding: 10px 20px; /* Increased padding */
        }

        form {
            display: flex; /* Use flexbox to align inputs */
            justify-content: space-between; /* Space between inputs */
            flex-wrap: wrap; /* Allow inputs to wrap */
        }

        form input {
            width: 50px;
            height: 50px;
            text-align: center;
            margin: 5px; /* Space between inputs */
            font-size: 24px; /* Larger text for better visibility */
            border: 1px solid #ced4da; /* Border color */
            border-radius: 5px; /* Rounded corners */
        }

        form input:focus {
            border-color: #007bff; /* Change border color on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add a focus effect */
        }

        .otp:nth-child(2) {
            margin-top: 10px; /* Shift the second input down */
        }

        hr {
            border-top: 1px solid #dee2e6; /* Lighter line for the divider */
        }
    </style>
</head>

<body>
    <div class="bgWhite">
        <div class="title">
            Verify OTP
        </div>

        <form action="" class="mt-4" method="post">
            <input class="otp" type="text" name="otp[]" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1>
            <input class="otp" type="text" name="otp[]" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1>
            <input class="otp" type="text" name="otp[]" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1>
            <input class="otp" type="text" name="otp[]" oninput='digitValidate(this)' onkeyup='tabChange(4)' maxlength=1>
            <input class="otp" type="text" name="otp[]" oninput='digitValidate(this)' onkeyup='tabChange(5)' maxlength=1>
            <input class="otp" type="text" name="otp[]" oninput='digitValidate(this)' onkeyup='tabChange(6)' maxlength=1>
            <hr class="mt-4">
            <button class='btn btn-primary btn-block customBtn' type="submit" name="submit">Verify</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        let digitValidate = function(ele) {
            console.log(ele.value);
            ele.value = ele.value.replace(/[^0-9]/g, '');
        }

        let tabChange = function(val) {
            let ele = document.querySelectorAll('input');
            if (ele[val - 1].value != '') {
                if (val < 6) {
                    ele[val].focus(); // Move to the next input
                }
            } else if (ele[val - 1].value == '' && val > 1) {
                ele[val - 2].focus(); // Move back to the previous input
            }
        }
    </script>
</body>

</html>
