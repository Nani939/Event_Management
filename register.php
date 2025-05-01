<?php
include('includes/db.php');
include('includes/header.php');

$event_id = intval($_GET['event_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    $sql = "INSERT INTO registrations (event_id, name, email, phone) VALUES ('$event_id', '$name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you for registering!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>
<main>
<h2>Register for Event</h2>
<form method="post">
    <label for='name'>Name</label>
    <input type="text" name="name" id="name" required>

    <label for='email'>Email</label>
    <input type="email" name="email" id="email" required>

    <label for='phone'>Phone</label>
    <input type="text" name="phone" id="phone" required>

    <button type="submit">Register</button>
</form>
</main>
<?php include('includes/footer.php'); ?>