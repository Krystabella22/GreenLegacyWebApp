<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=green_legacy', 'username', 'password');

// Assume user ID is stored in session after login
session_start();
$userId = $_SESSION['user_id'];

// Fetch user data from the database
$query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$query->execute(['id' => $userId]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found.');
}

// Check if user profile picture exists, otherwise use default
$profilePicture = file_exists($user['profile_picture']) ? $user['profile_picture'] : 'assets/images/default-profile.jpg';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle profile update
    $location = $_POST['location'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];

    // Handle file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $uploadPath = 'uploads/profile_pictures/' . basename($fileName);

        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            // Update the profile picture in the database
            $updateQuery = $pdo->prepare("UPDATE users SET profile_picture = :profile_picture, location = :location, dob = :dob, email = :email WHERE id = :id");
            $updateQuery->execute([
                'profile_picture' => $uploadPath,
                'location' => $location,
                'dob' => $dob,
                'email' => $email,
                'id' => $userId
            ]);
        }
    } else {
        // Update other user details
        $updateQuery = $pdo->prepare("UPDATE users SET location = :location, dob = :dob, email = :email WHERE id = :id");
        $updateQuery->execute([
            'location' => $location,
            'dob' => $dob,
            'email' => $email,
            'id' => $userId
        ]);
    }

    // Refresh page to reflect changes
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Green Legacy</title>
    <?php include 'headerwithmenu.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .profile-container {
            display: flex;
            padding: 20px;
        }
        
        .profile-content {
            width: 80%;
        }

        .profile-header {
            display: flex;
            align-items: center;
        }

        .profile-picture img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }

        .profile-info .user-name {
            font-size: 24px;
            margin: 0;
        }

        .profile-info .user-details {
            margin: 5px 0;
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }

        .social-links .social-icon {
            color: #354e41;
            font-size: 24px;
        }

        .edit-btn {
            background-color: #354e41;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-profile-window {
            display: none; /* Hidden by default */
            position: absolute;
            top: 60px; /* Adjust position as needed */
            left: 0;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .edit-profile-window input[type="file"] {
            margin-bottom: 15px;
        }

        .notifications ul {
            list-style-type: none;
            padding: 0;
        }

        .notifications ul li {
            background-color: #f1f1f1;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .activity-timeline {
            margin-top: 20px;
        }

        .activity-timeline .timeline-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #f1f1f1;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .activity-timeline .timeline-icon {
            font-size: 24px;
            color: #354e41;
        }

        .calendar {
            margin: 20px;
        }

        .calendar iframe {
            width: 100%;
            height: 400px; /* Smaller height */
            border: none;
        }
    </style>
    <script>
        function toggleEditProfileWindow() {
            var window = document.getElementById('edit-profile-window');
            window.style.display = (window.style.display === 'none' || window.style.display === '') ? 'block' : 'none';
        }
    </script>
</head>
<body>

    <!-- Main profile container -->
    <div class="profile-container">

        <!-- Profile content -->
        <main class="profile-content">
            <!-- Profile header -->
            <div class="profile-header">
                <div class="profile-picture">
                    <img src="<?php echo $profilePicture; ?>" alt="User Profile Picture">
                </div>

                <div class="profile-info">
                    <h2 class="user-name"><?php echo htmlspecialchars($user['name']); ?></h2>
                    <p class="user-details">Joined: <?php echo htmlspecialchars($user['joined']); ?></p>
                    <p class="user-details">Location: <?php echo htmlspecialchars($user['location']); ?></p>
                    <p class="user-details">Date of Birth: <?php echo htmlspecialchars($user['dob']); ?></p>
                    <p class="user-details">Email: <?php echo htmlspecialchars($user['email']); ?></p>
                    <div class="social-links">
                        <a href="<?php echo htmlspecialchars($user['facebook']); ?>" class="social-icon"><ion-icon name="logo-facebook"></ion-icon></a>
                        <a href="<?php echo htmlspecialchars($user['twitter']); ?>" class="social-icon"><ion-icon name="logo-twitter"></ion-icon></a>
                        <a href="<?php echo htmlspecialchars($user['instagram']); ?>" class="social-icon"><ion-icon name="logo-instagram"></ion-icon></a>
                    </div>
                    <button class="edit-btn" onclick="toggleEditProfileWindow()">Edit Profile</button>
                </div>
            </div>

            <!-- Edit Profile Window -->
            <div id="edit-profile-window" class="edit-profile-window">
                <form id="edit-profile-form" action="" method="POST" enctype="multipart/form-data">
                    <label for="profile_picture">Change Profile Picture:</label>
                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*">

                    <label for="location">Location:</label>
                    <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($user['location']); ?>">

                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($user['dob']); ?>">

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>">

                    <button type="submit">Save Changes</button>
                    <button type="button" onclick="toggleEditProfileWindow()">Cancel</button>
                </form>
            </div>

            <!-- Notifications -->
            <div class="notifications">
                <h3>Notifications</h3>
                <ul>
                    <?php foreach ($user['notifications'] as $notification): ?>
                        <li><?php echo htmlspecialchars($notification); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Activity timeline -->
            <div class="activity-timeline">
                <h3>Activity Timeline</h3>
                <div class="timeline-item">
                    <div class="timeline-icon"><ion-icon name="leaf-outline"></ion-icon></div>
                    <div class="timeline-content">
                        <h4>Trees Planted</h4>
                        <p><?php echo htmlspecialchars($user['activity']['trees_planted']); ?></p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon"><ion-icon name="trophy-outline"></ion-icon></div>
                    <div class="timeline-content">
                        <h4>Challenges Completed</h4>
                        <p><?php echo htmlspecialchars($user['activity']['challenges_completed']); ?></p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon"><ion-icon name="ribbon-outline"></ion-icon></div>
                    <div class="timeline-content">
                        <h4>Reward Credits Earned</h4>
                        <p><?php echo htmlspecialchars($user['activity']['reward_credits']); ?></p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Calendar section -->
    <div class="calendar">
        <iframe src="https://calendar.google.com/calendar/embed?src=your_calendar_id&ctz=Your_Timezone" style="border: 0" frameborder="0" scrolling="no"></iframe>
    </div>

    <!-- Ionicons scripts -->
    <script src="https://cdn.jsdelivr.net/npm/ionicons@5.0.0/dist/ionicons/ionicons.min.js"></script>
</body>
</html>
