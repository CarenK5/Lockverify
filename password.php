<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password Recovery</title>
    <style>
        /* CSS styles for the form container */
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* CSS styles for form elements */
        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: black;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: orange;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .success-message {
            color: orange;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Forget Password Recovery</h2>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Submit">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Process forget password recovery
            $email = $_POST["email"];

            // Here you can implement the logic to send a password reset link to the user's email
            // For demonstration purpose, let's assume the recovery email is sent successfully
            $recovery_email_sent = true;

            if ($recovery_email_sent) {
                echo '<p class="success-message">Password reset link has been sent to your email.</p>';
            } else {
                echo '<p class="error-message">Failed to send recovery email. Please try again later.</p>';
            }
        }
        // Redirect to OTP verification page
                    header("Location: otp.php");
                    exit;
        ?>
    </div>
</body>
</html>
