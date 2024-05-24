<?php
session_start();

// Server connection details
$servername = "localhost";
$username = "nikhnara";
$password = "pyre breaches warpaths inclined";
$db_name = "nikhnara_db";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $con = mysqli_connect($servername, $username, $password, $db_name);

    // Check connection
    if (mysqli_connect_errno()) {
        echo "<p style='color: red;'>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
        exit();
    }

    $username = $_POST["username"];
    // Hash the password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $aadhar = $_POST["aadhar"];

    // Perform database authentication
    $query = "SELECT * FROM admin WHERE username = '$username' AND aadhar_card_number = '$aadhar'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($_POST["password"], $row["password"])) {
        // Authentication successful, store aadhar card number in session
        $_SESSION["aadhar"] = $aadhar;
        header("Location: admin_home_page.php"); // Redirect to admin home page
        exit(); // Ensure no further output is sent
    } else {
        echo "<p style='color: red;'>Invalid credentials. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://ichef.bbci.co.uk/news/976/cpsprodpb/40E3/production/_106311661_expander_index-03.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-color: #f5f5f5; /* Fallback color */
        }

        .navbar {
            background-color: #FF9933; /* Green background */
        }

        .navbar-text {
            color: #FFFFFF; 
            font-size: 28px;
            font-weight: bold;
        }
        .navbar-nav .nav-link:hover {
    color: #138808; /* Green hover color */
}

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .form-group label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div class="mx-auto navbar-text">Welcome to Indian Elections Admin Page</div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">Admin Login</div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="aadhar">Aadhar Card Number</label>
                                <input type="text" class="form-control" id="aadhar" name="aadhar" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
