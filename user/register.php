<?php
session_start();
include('../includes/db.php');

if (isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['register'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $check = $conn->query("SELECT id FROM users WHERE email = '$email'");
        if ($check->num_rows > 0) {
            $error = "Email already registered!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-color: #f6f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .auth-container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 25px;
        }
        input {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        p {
            text-align: center;
            margin-top: 15px;
        }
        a {
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="auth-container">
    <h2>User Registration</h2>

    <?php if (isset($error)) echo "<p style='color:red; text-align:center;'>".htmlspecialchars($error)."</p>"; ?>

    <form method="post">
        <input type="text" name="name" placeholder="Name" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="password" name="confirm_password" placeholder="Confirm Password" required>

        <button type="submit" name="register">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login Here</a></p>
</div>
</body>
</html>
