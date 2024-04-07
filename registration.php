<?php
$conn = mysqli_connect("localhost", "root", "southACT41#8$", "2fa_db");

session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Handle registration
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone_number'];
        $pass = $_POST['password'];

        // Validate the inputs (you may want to add more robust validation)
        if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber)) {
            $error_message = "Please fill in all fields.";
        } else {
            // Registration successful
            

            // Create a database connection
            //$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Escape user inputs to prevent SQL injection
            $firstName = $conn->real_escape_string($firstName);
            $lastName = $conn->real_escape_string($lastName);
            $email = $conn->real_escape_string($email);
            $phoneNumber = $conn->real_escape_string($phoneNumber);
            $pass = password_hash($conn->real_escape_string($pass),PASSWORD_BCRYPT);

            // Insert user data into the database
            $sql = "INSERT INTO registration (FirstName, LastName, PhoneNumber, Email, password) 
                    VALUES ('$firstName', '$lastName', '$phoneNumber','$email','$pass')";

            if ($conn->query($sql) === TRUE) {
                // User data inserted successfully

                // Redirect to login page after registration
                header("Location: login.php");
                exit();
                
                // Send OTP
                require 'send_otp.php';

                // Redirect to OTP verification page
                $_SESSION['user_email'] = $email;
                header("Location: otp_verification.php");
                exit(); 
            } else {
                // Error in SQL query
                $error_message = "Error: " . $conn->error;
            }

            // Close the database connection
            $conn->close();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        /* Your existing CSS styles */
        .registration-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            margin: 20px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: black; /* Blue color */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #e07d00 ; /* Darker shade on hover */
        }
    </style>
</head>
<div>
<body>
    <div class="registration-container">
        <h1>Registration</h1>
        <form method="post" action="">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" required>

            <button type="submit" name="register">Register</button>
        </form>

        <?php
        if (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>
    </div>
</body>
</div>
</html>
