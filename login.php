<?php

require_once 'config.php';

// Database connection settings
$con = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);


// Check if the database connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Retrieve user information from the database based on email
    $enteredEmail = $_POST['email'];
    $enteredPassword = $_POST['password'];

    // Prepare the SQL statement (use prepared statements to prevent SQL injection)
    $sql = "SELECT * FROM registration WHERE Email = '".$enteredEmail."'";
    //result
    $res = mysqli_query($con,$sql);
    //get the user
    $user = mysqli_fetch_assoc($res);
   
    
    
    if(count($user)>0){
        
       
        if (password_verify($enteredPassword, $user['password'])) {
            session_start();
            // Passwords match, login successful
            $_SESSION['user_email'] = $user['Email'];

            // Generate and store OTP
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;

            // Redirect to OTP verification page
            header("Location: otp.php");
            
        }else{
            echo 'Kindly check your password or email.';
        }
}
}

// Close the database connection
mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
        }
        .container {
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

        .app-name {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            margin: 20px;
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
            background-color: black; /* Orange color */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #e07d00; /* Darker shade on hover */
        }
        .signup-link {
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="app-name">LockVerify</div>
       <form method="post" action="">
       <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="submit">Login</button>
    </form>
    
    <div class="signup-link">
            Don't have an account? <a href="registration.php">Sign Up</a>
        </div>
        <div>
            <a href="password.php" class="forgot-password">Forgot Password?</a>
        </div>
    </div>
</body>
</html>
