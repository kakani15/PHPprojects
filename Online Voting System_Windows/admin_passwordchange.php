<?php
session_start();

// Server connection details
$servername = "localhost";
$username = "nikhnara";
$password = "pyre breaches warpaths inclined";
$db_name = "nikhnara_db";

// Check if user is logged in
if (!isset($_SESSION['aadhar'])) {
    // If not logged in, redirect to login page
    header("Location: admin.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $con = mysqli_connect($servername, $username, $password, $db_name);

    // Check connection
    if (mysqli_connect_errno()) {
        echo "<p style='color: red;'>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
        exit();
    }

    // Get input data
    $currentPassword = $_POST["current_password"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Get Aadhar number from session
    $aadhar = $_SESSION["aadhar"];

    // Fetch current password from database
    $query = "SELECT password FROM election_commission_employees WHERE aadhar_card_number = '$aadhar'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // Verify current password
    if ($row && password_verify($currentPassword, $row["password"])) {
        // Check if new password matches confirm password
        if ($newPassword === $confirmPassword) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update password in the database
            $updateQuery = "UPDATE election_commission_employees SET password = '$hashedPassword' WHERE aadhar_card_number = '$aadhar'";
            if (mysqli_query($con, $updateQuery)) {
                echo "<p style='color: green;'>Password updated successfully.</p>";
            } else {
                echo "<p style='color: red;'>Error updating password: " . mysqli_error($con) . "</p>";
            }
        } else {
            echo "<p style='color: red;'>New password and confirm password do not match.</p>";
        }
    } else {
        echo "<p style='color: red;'>Incorrect current password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://www.shutterstock.com/shutterstock/videos/1096271163/thumb/11.jpg?ip=x480');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #f9f9f9; /* Light grey background */
            font-family: 'Roboto', sans-serif; /* Professional font family */
            padding-top: 50px;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Change Password</button>
            <?php if(isset($message)) { echo $message; } ?>
            <a href="admin_home_page.php" class="back-link">Back to Admin Home</a>
        </form>
    </div>
</body>
</html>
