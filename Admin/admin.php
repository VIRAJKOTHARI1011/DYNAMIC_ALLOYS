<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brandedge";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch data
$sql = "SELECT * FROM brandedgedata";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Contact Form Submissions</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Brand Name</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['fullname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['subject']}</td>
                        <td>{$row['message']}</td>
                        <td>
                            <form action='email.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='email' value='{$row['email']}'>
                                <button type='submit'>Email</button>
                            </form>
                            <form action='delete.php' method='POST' style='display:inline;'> 
                                <button type='submit'>Delete</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
