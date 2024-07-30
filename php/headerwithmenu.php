<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header with Menu</title>
    <style>
        /* Importing Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        /* ====== GENERAL STYLES ====== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 80px 15px;
            padding-top: 1px;
            padding-left: 0;
            background-color: #fff; 
        }

        /* ====== HEADER STYLES ====== */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #354e51;
            color: #fff;
            padding: 22px 42px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            left: 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-logo-nav {
            display: flex;
            align-items: center;
            flex-grow: 1;
            justify-content: space-between;
        }

        .menu-icon {
            font-size: 24px;
            cursor: pointer;
            margin-right: 20px;
        }

        .logo {
            font-size: 24px;
            color: white;
            font-weight: 600;
            margin-right: 40px;
        }

        /* ====== NAVIGATION STYLES ====== */
        nav {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
        }

        .nav-item {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            position: relative;
            padding: 10px 0;
            margin: 0 20px;
        }

        .nav-item i {
            margin-right: 5px;
            font-size: 20px;
        }

        .nav-item::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: #f4f4f4;
            transition: width 0.3s;
        }

        .nav-item:hover::after, .nav-item.active::after {
            width: 100%;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .nav-btn {
            background: #97a59e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .nav-btn:hover {
            background: #62726a;
        }

        /* Avatar Styles */
        .avatar-container {
            position: relative;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f4f4f4;
            border: 2px solid #f4f4f4;
            cursor: pointer;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #354e51;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            width: 200px;
            background-color: #fff;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1001;
        }

        .profile-dropdown a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }

        .profile-dropdown a:hover {
            background-color: #f4f4f4;
        }

        /* ====== SIDEBAR STYLES ====== */
        .sidebar {
            position: fixed;
            left: -250px;
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            z-index: 1000;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333333;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="menu-logo-nav">
                <div class="menu-icon" id="menu-icon">&#9776;</div>
                <div class="logo">Green Legacy</div>
                <nav>
                    <a href="../php/index.php" class="nav-item">Home</a>
                    <a href="../php/log-activity.php" class="nav-item">Activity</a>
                    <a href="../php/events.php" class="nav-item">Events</a>
                </nav>
            </div>
            <div class="nav-buttons">
                <button class="nav-btn" id="plantTreeBtn">Plant a Tree</button>
                <?php if (isset($_SESSION['id'])): ?>
                    <button class="nav-btn" id="logoutBtn">Log Out</button>
                    <div class="avatar-container">
                        <div class="avatar" id="avatar">
                            <img src="../assets/images/avatar2.jpg" alt="Avatar">
                        </div>
                        <div class="profile-dropdown" id="profileDropdown">
                            <a href="../php/profile.php">Profile</a>
                            <a href="../php/settings.php">Settings</a>
                            <a href="../php/logout.php">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <button class="nav-btn" id="loginBtn">Log In</button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <nav id="sidebar" class="sidebar">
        <ul>
            <li><a href="../php/profile.php"><i class="icon-history"></i> Profile</a></li>
            <li><a href="../php/log-activity.php"><i class="icon-playlist"></i> Log Activity</a></li>
            <li><a href="../php/media-center.php"><i class="icon-my-videos"></i> Videos</a></li>
            <li><a href="../php/reading-room.php"><i class="icon-settings"></i> Articles</a></li>
            <li><a href="../php/about.php"><i class="icon-logout"></i> About Us</a></li>
            <li><a href="../php/contact.php"><i class="icon-logout"></i> Contact Us</a></li>
        </ul>
    </nav>
    <div id="overlay" class="overlay"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuIcon = document.getElementById('menu-icon');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const avatar = document.getElementById('avatar');
            const profileDropdown = document.getElementById('profileDropdown');
            const logoutBtn = document.getElementById('logoutBtn');
            const loginBtn = document.getElementById('loginBtn');
            const plantTreeBtn = document.getElementById('plantTreeBtn');

            menuIcon.addEventListener('click', function() {
                sidebar.style.left = sidebar.style.left === '0px' ? '-250px' : '0px';
                overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
            });

            overlay.addEventListener('click', function() {
                sidebar.style.left = '-250px';
                overlay.style.display = 'none';
            });

            if (avatar) {
                avatar.addEventListener('click', function() {
                    profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
                });
            }

            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (confirm('Are you sure you want to log out?')) {
                        window.location.href = '../php/logout.php';
                    }
                });
            }

            if (loginBtn) {
                loginBtn.addEventListener('click', function() {
                    window.location.href = '../php/login.php';
                });
            }

            plantTreeBtn.addEventListener('click', function() {
                window.location.href = '../php/log-activity.php';
            });
        });
    </script>
</body>
</html>
