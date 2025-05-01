<?php
session_start();
include('../includes/db.php');

if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            header('Location: ../index.php');
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Email not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
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
    <h2>User Login</h2>

    <?php if (isset($error)) echo "<p style='color:red; text-align:center;'>".htmlspecialchars($error)."</p>"; ?>

    <form method="post" action="">
        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register Here</a></p>
</div>
</body>
</html>
