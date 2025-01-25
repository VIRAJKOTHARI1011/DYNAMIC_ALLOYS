<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            transition: all 0.3s;
        }
        .sidebar a {
            text-decoration: none;
            font-size: 16px;
            color: #fff;
            display: block;
            padding: 10px 20px;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }
        .main-content {
            margin-left: 260px; /* Adjust to match sidebar width */
            padding: 20px;
            transition: all 0.3s;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .nav-link {
            color: #fff;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #ddd;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
        img {
            margin-left: 50px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
            .sidebar a {
                display: inline-block;
                text-align: center;
                padding: 10px;
            }
            img {
                display: block;
                margin: 0 auto 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="/BRANDEDGE/Admin/RMS TRANSPARENT.png" alt="Logo" height="100px" width="100px">
        <a href="#" class="active" id="dashboard-tab" onclick="loadContent('dashboard')">Dashboard</a>
        <a href="#" id="data-tab" onclick="loadContent('data')">Data</a>
        <a href="#" id="blogs-tab" onclick="loadContent('blogs')">Blogs</a>
        <a href="logout.php" class="mt-auto">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">RMS Dashboard</a>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Dynamic Content Area -->
        <div id="content-area" class="container mt-4">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
            <p class="lead">This is your personalized dashboard. Use the sidebar to navigate between pages.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> RMS Dashboard. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function loadContent(tab) {
            // Update active state on sidebar
            document.querySelectorAll('.sidebar a').forEach((link) => {
                link.classList.remove('active');
            });
            document.getElementById(`${tab}-tab`).classList.add('active');

            // AJAX request to load content
            $.ajax({
                url: `load_${tab}.php`,
                method: 'GET',
                success: function(response) {
                    $('#content-area').html(response);
                },
                error: function() {
                    $('#content-area').html('<p class="text-danger">Failed to load content. Please try again later.</p>');
                }
            });
        }
    </script>
</body>
</html>
