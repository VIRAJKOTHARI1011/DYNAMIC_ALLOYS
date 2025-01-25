<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
echo '<h2>Dashboard</h2>';
echo '<p>This is the dashboard content.</p>';
?>
