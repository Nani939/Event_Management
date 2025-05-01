<?php
session_start();
include('../includes/db.php');

if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit();
}

if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $check = $conn->query("SELECT id FROM admin WHERE username = '$username'");
        if ($check->num_rows > 0) {
            $error = "Username already exists!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                header('Location: login.php');
                exit();
            } else {
                $error = "Registration failed: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 350px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #007bff; /* Blue heading like user pages */
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>

</head>
<body>
<div class="form-container">
    <h2>Register New Admin</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit" name="register">Register</button>
    </form>
    <p><a href="login.php">Already have an account? Login here</a></p>
</div>
</body>
</html>
