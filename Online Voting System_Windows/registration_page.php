<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://geeksflame.com/wp-content/uploads/2019/03/How-to-search-name-on-voter-list-800x450.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding-top: 50px;
            margin-left: 30%; /* Adjust this value to move the registration block to the left */
            border-radius: 10px;
            
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 30px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-register {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-register:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>User Registration</h3>
        </div>
        <div class="card-body">
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="aadhar">Aadhar Card Number:</label>
                    <input type="text" class="form-control" id="aadhar" name="aadhar" required>
                </div>
                <div class="form-group">
                    <label for="voter_id">Voter ID:</label>
                    <input type="text" class="form-control" id="voter_id" name="voter_id" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-register btn-block">Register</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
