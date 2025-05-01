<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: login.php');
include('../includes/db.php');

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM events WHERE id=$id");
$event = $result->fetch_assoc();

if (isset($_POST['edit'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $date = $_POST['date'];
    $location = $conn->real_escape_string($_POST['location']);

    $sql = "UPDATE events SET title='$title', description='$description', date='$date', location='$location' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Event</title></head>
<body>
<h2>Edit Event</h2>
<form method="post">
    <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required><br>
    <textarea name="description" required><?= htmlspecialchars($event['description']) ?></textarea><br>
    <input type="date" name="date" value="<?= $event['date'] ?>" required><br>
    <input type="text" name="location" value="<?= htmlspecialchars($event['location']) ?>" required><br>
    <button type="submit" name="edit">Save Changes</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>