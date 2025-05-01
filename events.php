<?php include('includes/db.php'); include('includes/header.php'); ?>
<main>
<h2>All Events</h2>
<div class="events">
<?php
$sql = "SELECT * FROM events ORDER BY date ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='event'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<div class='event-meta'>";
        echo "<span>Location: " . htmlspecialchars($row['location']) . "</span><br>";
        echo "<span>DATE: " . htmlspecialchars($row['date']) . "</span>";
        echo "</div>";
        echo "<a href='event_details.php?id=" . $row['id'] . "'>View Details</a>";
        echo "</div>";
    }
} else {
    echo "No events found.";
}

?>
</div>
</main>
<?php include('includes/footer.php'); ?>