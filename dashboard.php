<?php
session_start();

// Check if the user is authenticated (you may need to implement a proper authentication check)
/*if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LockVerify</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('lock.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;

        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px; /* Added margin */
        }

        .menu-icon {
            font-size: 24px;
            cursor: pointer;
            float: left;
            margin-left: 10px;
        }

        h1 {
            margin: 0;
        }

        .menu-container {
            display: none;
            position: fixed;
            top: 60px;
            right: 10px;
            background-color: #333;
            color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .menu-container a {
            display: block;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
        }

        .menu-container a:hover {
            background-color: #555;
        }

        .otp-container {
            text-align: center;
        }

        .otp-form {
            display: inline-block;
            margin-top: 20px; /* Adjusted margin */
        }

        .otp-input {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 150px;
            font-size: 16px;
        }

        .otp-button {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .otp-button:hover {
            background-color: orange;
        }
    </style>
</head>
<body>
    <header>
        <span class="menu-icon" onclick="toggleMenu()">&#9776;</span>
        <h1>LockVerify</h1>
    </header>

    <div class="menu-container" id="menuContainer">
        <a href="#">Profile</a>
        <a href="#">Security Settings</a>
        <a href="#">Recent Activity</a>
        <a href="#">Change Password</a>
        <a href="#">Help and Support</a>
        <a href="#">Log Out</a>
    </div>


    <script>
        function toggleMenu() {
            var menuContainer = document.getElementById("menuContainer");
            menuContainer.style.display = (menuContainer.style.display === "block") ? "none" : "block";
        }
    </script>
</body>
</html>


