<?php
session_start();
include('../includes/db.php');

if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Username not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
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
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register Here</a></p>
</div>
</body>
</html>
