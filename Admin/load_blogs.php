<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
echo '<h2>Blogs</h2>';
echo '<p>This is the blogs content.</p>';
?>
