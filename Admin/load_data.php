<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
<style type="text/css">
.table-responsive {
    overflow-x: auto;
    max-width: 100%; /* Ensures responsiveness */
}

.table {
    width: 100%;
    table-layout: fixed; /* Prevents uneven column sizes */
    word-wrap: break-word; /* Wraps text within cells */
    white-space: nowrap; /* Prevents unnecessary wrapping for long texts */
}

th, td {
    text-align: left;
    padding: 8px; /* Adjust padding as needed */
    min-width: 100px; /* Sets a minimum width for columns */
}
td {
    overflow: hidden;
    text-overflow: ellipsis;
    word-wrap: break-word; /* Wraps text within table cells */
    white-space: normal; 
}

</style>
<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$frontend_conn = new mysqli("localhost", "root", "", "brandedge");
if ($frontend_conn->connect_error) {
    die("Connection to frontend database failed: " . $frontend_conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT * FROM brandedgedata ORDER BY _id DESC";
$result = $frontend_conn->query($sql);

if (!$result) {
    die("Query failed: " . $frontend_conn->error);
}
?>

<div id="data-content" class="container mt-4">
    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Brand Name</th>
                        <th style="width:30%">Message</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['_id']) ?></td>
                        <td><?= htmlspecialchars($row['fullname']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['subject']) ?></td>
                        <td><?= htmlspecialchars($row['message']) ?></td>
                        <td><?= htmlspecialchars($row['Date']) ?></td>
                        <td><?= htmlspecialchars($row['Time']) ?></td>
                        <td>
                            <button onclick="sendEmail('<?= htmlspecialchars($row['email']) ?>')" class="btn btn-sm btn-primary">Email</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            No data found in the database.
        </div>
    <?php endif; ?>
</div>


<?php
// Close the database connection
$frontend_conn->close();
?>

<script>
function sendEmail(email) {
    alert('Send email to: ' + email);
    // Implement AJAX or backend email logic here
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
