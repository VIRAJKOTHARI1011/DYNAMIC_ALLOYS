<?php
// delete.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brandedge";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];

    // Delete record
    $sql = "DELETE FROM contact_form WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
        header("Location: admin.php"); // Redirect back to admin page
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
