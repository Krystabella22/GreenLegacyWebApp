<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        /* Importing Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        /* General styling */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f0f4f1; /* Light background color for better contrast */
            color: #333;
        }

        .content {
            flex: 1; /* This makes sure the content takes up the remaining space */
        }

        /* Footer styling */
        .footer {
            background-color: #eae7dc;
            color: black;
            padding: 30px 0;
            text-align: center;
            box-shadow: 0 -1px 4px rgba(0, 0, 0, 0.1);
        }

        .footer .container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
            text-align: left;
            margin-right: 0;
        }

        .footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer ul li {
            margin-bottom: 10px;
        }

        .footer ul li h5 {
            margin-bottom: 20px;
            font-size: 1.2em;
        }

        .footer ul li a {
            color: black;
            text-decoration: none;
        }

        .footer ul li a:hover {
            text-decoration: underline;
        }

        .footer .BTN a {
            margin: 0 10px;
            color: black;
            font-size: 1.5rem;
        }

        .footer .BTN a:hover {
            color: #f0f4f1; /* Lighten color on hover */
        }

        @media (max-width: 768px) {
            .footer .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
    <!-- FontAwesome for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="content">
        <!-- Your page content goes here -->
    </div>
    <footer class="footer">
        <div class="container">
            <div class="col">
                <ul>
                    <li><h5>Green Legacy</h5></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="blogs.php">Blogs</a></li>
                    <li><a href="videos.php">Videos</a></li>
                    <li><a href="activity.php">Activity</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li style="margin-top: 20px;">FOLLOW US</li>
                    <li class="BTN">
                        <a href="https://twitter.com/StrathU?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/strathmore_sesc/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://ke.linkedin.com/school/strathmore-university/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li><h5>Join Us</h5></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li><h5>Support</h5></li>
                    <li><a href="faqs.php">FAQs</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div style="margin-top: 20px;">Green Legacy &copy; 2024</div>
    </footer>

    <script>
        // JavaScript for any footer-related functionality can go here
        document.addEventListener("DOMContentLoaded", function() {
            console.log("Footer loaded successfully.");
        });
    </script>
</body>
</html>
