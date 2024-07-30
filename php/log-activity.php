<?php
session_start();

// Check if user ID is set in the session
if (!isset($_SESSION['id'])) {
    die("User ID is not set in session. Please log in.");
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "green_legacy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $treeCount = intval($_POST['treeCount']);
    $location = $conn->real_escape_string($_POST['location']);
    $date = $conn->real_escape_string($_POST['date']);

    // Handle file upload
    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create directory if it doesn't exist
    }

    $proof = $_FILES['proof'];
    $proofName = basename($proof['name']);
    $proofDestination = $uploadDir . $proofName;

    if ($proof['error'] === UPLOAD_ERR_OK) {
        if (!move_uploaded_file($proof['tmp_name'], $proofDestination)) {
            echo "<script>alert('Error: Failed to move uploaded file.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Error: File upload error.');</script>";
        exit;
    }

    // Get user ID from session
    $userId = $_SESSION['id'];

    // Insert into database
    $sql = "INSERT INTO tree_planting_activities (id, tree_count, location, date, proof) VALUES ('$userId', '$treeCount', '$location', '$date', '$proofDestination')";
    if ($conn->query($sql) === TRUE) {
        // Update user's credit points
        $creditsEarned = $treeCount * 1000; // 1000 points per tree
        $sqlCreditUpdate = "UPDATE users SET credit_points = credit_points + $creditsEarned WHERE id = $userId";
        $conn->query($sqlCreditUpdate);

        echo "<script>alert('Activity logged successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Fetch leaderboard data
$sql = "SELECT username, avatar, credit_points FROM users ORDER BY credit_points DESC LIMIT 10";
$result = $conn->query($sql);

$leaderboard = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = $row;
    }
}

// Fetch total number of trees planted
$sqlTotalTrees = "SELECT SUM(tree_count) AS total_trees FROM tree_planting_activities";
$resultTotalTrees = $conn->query($sqlTotalTrees);
$rowTotalTrees = $resultTotalTrees->fetch_assoc();
$totalTrees = $rowTotalTrees['total_trees'] ?? '0';

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Activity | Green Legacy</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #020035 !important;
            margin: 0;
            padding-top: 100px; /* Space for fixed header */
        }

        #main {
            margin-left: 10px;
            padding: 80px;
            transition: margin-left .3s;
        }

        .content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .form-container, .tree-count-display {
            background-color: #444;
            color: #cddad4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 10px;
            flex-basis: 48%;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form label {
            margin: 10px 0 5px;
        }

        form input {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #222;
            color: #cddad4;
        }

        form button {
            padding: 10px;
            background-color: #354e51;
            color: #cddad4;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #000;
        }

        .tree-count-display h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #cddad4;
        }

        .tree-count-display div {
            font-size: 24px;
            text-align: center;
        }

        .tree-count-display img {
            display: block;
            margin: 20px auto;
            width: 190px;
            height: 190px;
        }

        @media (max-width: 768px) {
            .form-container, .tree-count-display {
                flex-basis: 100%;
            }
        }

        .leaderboard {
            width: 100%;
            background: #111;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.5);
            overflow: hidden;
            text-align: center;
            color: white;
            margin-top: 20px;
        }

        .leaderboard h1 {
            font-size: 24px;
            margin: 20px 0;
        }

        .leaderboard ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .leaderboard li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .leaderboard li:nth-child(odd) {
            background: #222;
        }

        .leaderboard li img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .leaderboard li .name {
            flex: 1;
            text-align: left;
        }

        .leaderboard li .score {
            font-weight: bold;
        }

        .highlight {
            background-color: #444 !important;
        }

        /* Loading Spinner */
        .spinner {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 4px solid #354e51;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            display: none; /* Initially hidden */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include 'headerwithmenu.php'; ?>

    <!-- Main Content -->
    <div id="main">
        <!-- Content -->
        <div class="content">
            <div class="form-container">
                <h2>Log Activity</h2>
                <form id="logActivityForm" action="" method="POST" enctype="multipart/form-data">
                    <label for="treeCount">Number of Trees Planted:</label>
                    <input type="number" id="treeCount" name="treeCount" required>

                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" required>

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>

                    <label for="proof">Upload Proof:</label>
                    <input type="file" id="proof" name="proof" accept="image/*" required>

                    <button type="submit">Submit</button>
                </form>
                <div id="formFeedback" role="alert"></div>
            </div>

            <div class="tree-count-display">
                <h3>Total Trees Planted</h3>
                <div><?= htmlspecialchars($totalTrees) ?></div>
                <img src="../assets/images/treecounticon.jpg" alt="Trees Image">
            </div>
        </div>

        <!-- Leaderboard -->
        <div class="leaderboard">
            <h1>Leaderboard</h1>
            <ul>
                <?php foreach ($leaderboard as $user): ?>
                    <li>
                        <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar">
                        <div class="name"><?= htmlspecialchars($user['username']) ?></div>
                        <div class="score"><?= htmlspecialchars($user['credit_points']) ?> points</div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Loading Spinner -->
    <div class="spinner" id="loadingSpinner"></div>

    <script>
        document.getElementById('logActivityForm').addEventListener('submit', function() {
            document.getElementById('loadingSpinner').style.display = 'block'; // Show spinner
        });

        // Hide the spinner when the page is fully loaded (you may need additional conditions here based on your needs)
        window.addEventListener('load', function() {
            document.getElementById('loadingSpinner').style.display = 'none'; // Hide spinner
        });
    </script>
</body>
</html>
