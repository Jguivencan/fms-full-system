<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>DOCSS</title>
    <link rel="icon" href="images/toplogo.png">
</head>
<?php include('./header.php'); ?>
<?php
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=files");
?>
<body>
    <div class="index-container">
        <form id="login-form" action="" method="POST">
            <h1 style="font-weight:900;">Login</h1>
            <h3 style="margin-bottom: 5px;">Email</h3>
            <input type="text" class="holder" name="username" placeholder="Enter your email" required><br>
            <h3 style="margin-bottom: 5px;">Password</h3>
            <input type="password" class="holder" name="password" placeholder="Enter your password" id="myInput" required><br>
            <input type="checkbox" onclick="myFunction()" style="margin-top: 10px;">Show Password
            <br><button type="submit" class="button" style="margin-top: 10px;">Login</button><br>
            <h4 style="margin-top: 10px;">Don't have an account? Click here to <a href="sign-up.php" style="text-decoration;">Sign Up</a></h4>
        </form>
    </div>
</body>
</html>
<script src="script.js"></script>
<script src="login.js"></script>