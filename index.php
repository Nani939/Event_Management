<?php include('includes/db.php'); include('includes/header.php'); ?>
<main>
<h2>Upcoming Events</h2>
<div class="events">
<?php
$sql = "SELECT * FROM events ORDER BY date ASC LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='event'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<div class='event-meta'><span>" . htmlspecialchars($row['location']) . "</span><br>
        <span>" . htmlspecialchars($row['date']) . "</span></div>";
        echo "<a href='event_details.php?id=" . $row['id'] . "'>View Details</a>";
        echo "</div>";
    }
} else {
    echo "<p>No events available.</p>";
}
?>
</div>
</main>
<?php include('includes/footer.php'); ?>