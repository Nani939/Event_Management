<?php
include('includes/db.php');
include('includes/header.php');

$id = intval($_GET['id']);
$sql = "SELECT * FROM events WHERE id = $id";
$result = $conn->query($sql);

echo "<main>";

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo "<div class='event-details-card'>";
    echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
    echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
    echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
    echo "<p><strong>Description:</strong><br>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
    echo "<a href='register.php?event_id=$id'>Register Now</a>";
    echo "</div>";
} else {
    echo "<p>Event not found.</p>";
}

echo "</main>";

include('includes/footer.php');
?>