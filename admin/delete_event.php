<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: login.php');
include('../includes/db.php');

$id = intval($_GET['id']);
$conn->query("DELETE FROM events WHERE id=$id");

header('Location: dashboard.php');
exit();
?>