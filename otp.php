<?php
session_start();

// Check if the user is authenticated (you may need to implement a proper authentication check)
/*if ($otp_verified) {
    // Redirect to dashboard.php
    header("Location: dashboard.php");
    
}else {
    // Redirect back to login page if OTP verification fails
    header("Location: login.php");
    
}*/

// Retrieve the saved OTP (replace with your OTP storage method)
$storedOtp = isset($_SESSION['otp']) ? $_SESSION['otp'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['verify_otp'])) {
        // Handle OTP verification
        $enteredOtp = $_POST['otp'];

        if ($enteredOtp == $storedOtp) {
            // OTP verification successful
            echo "OTP verification successful! Redirect to the dashboard or perform additional actions.";
            // Clear the stored OTP after successful verification (optional)
            unset($_SESSION['otp']);
        } else {
            // OTP verification failed
            $error_message = "Invalid OTP. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        /* Your existing CSS styles */
        .otp-container {
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
            background-color: orange; /* Darker shade on hover */
        }
        
    </style>
</head>
<body>
    <div class="otp-container">
        <h1>OTP Verification</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="otp">Enter OTP:</label>
            <input type="text" name="otp" required>

            <button type="submit" name="verify_otp">Verify OTP</button>
        </form>

        <?php
        if (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>
    </div>
</body>
</html>
