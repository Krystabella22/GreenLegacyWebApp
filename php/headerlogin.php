<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Legacy | Login</title>
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
            font-family: Arial, sans-serif;
            margin: 80px 15px;
            padding-top: 1px;
            padding-left: 0;
            box-sizing: border-box; 
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
            overflow: hidden;
            left: 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 24px;
            color: white;
            font-weight: 600;
        }

        /* ====== NAVIGATION STYLES ====== */
        nav {
            display: flex;
            align-items: center;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
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
    </style>
</head>
<body>
    <!-- Header section -->
    <header class="header">
        <div class="header-content">
            <!-- Logo -->
            <div class="logo">Green Legacy</div>

            <!-- Navigation buttons -->
            <div class="nav-buttons">
                <button class="nav-btn" id="plantTreeBtn">Plant a Tree</button>
                <button class="nav-btn" id="loginBtn">Log in</button>
            </div>
        </div>
    </header>

    <!-- JavaScript for header functionality -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const buttonLinks = {
                plantTree: '/GreenLegacyWebApp/log-activity.html',
                login: '/GreenLegacyWebApp/php/login.php'
            };

            document.querySelector('#plantTreeBtn').addEventListener('click', function() {
                window.location.href = buttonLinks.plantTree;
            });

            document.querySelector('#loginBtn').addEventListener('click', function() {
                window.location.href = buttonLinks.login;
            });
        });
    </script>
</body>
</html>
