<?php
session_start();
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
    $sql = "SELECT * FROM login_db WHERE email = ?";

    // Prepare and execute the statement
    if ($stmt = $con->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("s", $enteredEmail);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the result set
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // User found, verify password
                $user = $result->fetch_assoc();
                $storedPasswordHash = $user['password_hash'];

                if (password_verify($enteredPassword, $storedPasswordHash)) {
                    // Passwords match, login successful
                    $_SESSION['user_email'] = $enteredEmail;

                    // Return success response
                    echo json_encode(array("success" => true));
                    exit;
                } else {
                    // Passwords do not match, login failed
                    // Return error message
                    echo json_encode(array("success" => false, "message" => "Invalid credentials. Please try again."));
                    exit;
                }
            } else {
                // User not found
                // Return error message
                echo json_encode(array("success" => false, "message" => "User not found. Please check your email."));
                exit;
            }
        } else {
            // Error executing the statement
            // Return error message
            echo json_encode(array("success" => false, "message" => "Error executing the SQL statement: " . $stmt->error));
            exit;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error preparing the statement
        // Return error message
        echo json_encode(array("success" => false, "message" => "Error preparing the SQL statement: " . $con->error));
        exit;
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
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <div class="app-name">LockVerify</div>
        <form id="login-form" action="login.php" method="post">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission
                var formData = $(this).serialize(); // Serialize the form data

                // Send the form data using AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    success: function(response) {
                        // If login successful, redirect to OTP page
                        if (response.success) {
                            window.location.href = "otp.php";
                        } else {
                            // Display error message
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Display error message
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
</body>
</html>
