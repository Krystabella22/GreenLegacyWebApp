<?php
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "green_legacy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message
$error_message = '';

// Register user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $student_id = $conn->real_escape_string($_POST['student_id']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        $error_message = "This email is already registered. Please use a different email.";
    } else {
        $sql = "INSERT INTO users (student_id, username, email, password) VALUES ('$student_id', '$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            header('Location: login.php'); // Redirect to login page after registration
            exit();
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Login user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Store user information in session
            $_SESSION['id'] = $row['id']; // Set user ID in session
            $_SESSION['username'] = $row['username'];
            $_SESSION['avatar'] = '../assets/images/avatar2.jpg'; // Default avatar
            header('Location: ../php/index.php'); // Redirect to index.php after successful login
            exit();
        } else {
            $error_message = "Incorrect username or password.";
        }
    } else {
        $error_message = "Incorrect username or password.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Importing Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
        
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #cddad4;
            padding-top: 20px; /* Space for fixed header */
        }
        .container {
            display: flex;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 80%; /* Adjust as needed */
            max-width: 1000px; /* Adjust as needed */
            z-index: 1; /* Ensure the container is not covering the body */
        }

        .form-container {
            width: 50%;
            padding: 30px;
            background: #fdf4e3;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .side-picture {
            width: 50%;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .side-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            color: #354e51;
            font-size: 26px;
            font-weight: 600;
        }

        .input-box {
            margin-bottom: 15px;
        }

        .input-field {
            width: 100%;
            height: 60px;
            font-size: 17px;
            padding: 0 25px;
            border-radius: 30px;
            border: none;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            outline: none;
            transition: .3s;
        }

        .input-field:focus {
            width: 105%;
        }

        ::placeholder {
            font-weight: 300;
            color: #666666;
        }

        .forgot {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            color: #555;
        }

        .forgot a {
            color: #555;
            text-decoration: none;
        }

        .forgot a:hover {
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            height: 60px;
            background: #354e51;
            border: none;
            border-radius: 30px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: .3s;
        }

        .submit-btn:hover {
            background: #000;
            transform: scale(1.05, 1);
        }

        .register-form {
            display: none;
        }

        .btn-box {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .btn {
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: #354e51;
            padding: 10px 20px;
            transition: .3s;
        }

        .btn-1 {
            color: #354e51;
            border-bottom: 2px solid #354e51;
        }

        .btn-2 {
            color: #555;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.getElementById('login');
            const registerBtn = document.getElementById('register');
            const loginForm = document.querySelector('.login-form');
            const registerForm = document.querySelector('.register-form');

            loginBtn.addEventListener('click', function() {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                loginBtn.classList.add('btn-1');
                loginBtn.classList.remove('btn-2');
                registerBtn.classList.add('btn-2');
                registerBtn.classList.remove('btn-1');
            });

            registerBtn.addEventListener('click', function() {
                registerForm.style.display = 'block';
                loginForm.style.display = 'none';
                registerBtn.classList.add('btn-1');
                registerBtn.classList.remove('btn-2');
                loginBtn.classList.add('btn-2');
                loginBtn.classList.remove('btn-1');
            });
        });
    </script>
</head>
<body>
    <?php include 'headerwithmenu.php'; ?>
    <div class="container">
        <div class="form-container">
            <div class="btn-box">
                <button id="login" class="btn btn-1">Login</button>
                <button id="register" class="btn btn-2">Register</button>
            </div>

            <!-- Login Form -->
            <div class="login-form">
                <h2 class="form-title">Login</h2>
                <form action="login.php" method="post">
                    <div class="input-box">
                        <input type="text" name="username" placeholder="Username" required class="input-field">
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Password" required class="input-field">
                    </div>
                    <div class="forgot">
                        <a href="#">Forgot password?</a>
                    </div>
                    <button type="submit" name="login" class="submit-btn">Login</button>
                </form>
                <?php if (!empty($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </div>

            <!-- Register Form -->
            <div class="register-form">
                <h2 class="form-title">Register</h2>
                <form action="login.php" method="post">
                    <div class="input-box">
                        <input type="text" name="student_id" placeholder="Student ID" required class="input-field">
                    </div>
                    <div class="input-box">
                        <input type="text" name="username" placeholder="Username" required class="input-field">
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Email" required class="input-field">
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Password" required class="input-field">
                    </div>
                    <button type="submit" name="register" class="submit-btn">Register</button>
                </form>
                <?php if (!empty($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="side-picture">
            <img src="../assets/images/rainforest.png" alt="Side Picture">
        </div>
    </div>
</body>
</html>
