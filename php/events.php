<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Legacy - Events</title>
    <link rel="stylesheet" href="../css/events.css"> <!-- Link to CSS file -->
    <script defer src="js/events.js"></script> <!-- Link to JS file -->
    <style>
        /* General reset and styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin-top: 60px; /* Adjust for fixed header */
        }

        .hero {
            position: relative;
            text-align: center;
            color: white;
            margin-top: 80px; /* Adjust for fixed header */
            margin-bottom: 20px;
        }

        .hero img {
            width: 100%;
            height: 500px;
            max-height: 300px;
            object-fit: cover;
            filter: brightness(70%);
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border-radius: 8px;
        }

        .hero-text h1 {
            font-size: 2.5rem;
            margin: 0;
        }

        /* Main Content */
        .content {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .event-card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .event-card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .event-title {
            font-size: 1.8rem;
            color: #354e51;
            margin-bottom: 10px;
        }

        .event-details {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .event-description {
            margin: 10px 0;
            line-height: 1.4;
        }

        .event-registration {
            display: inline-block;
            background: #97a59e;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .event-registration:hover {
            background: #62726a;
        }

    </style>
</head>
<body>
    <?php include 'headerwithmenu.php'; ?>
    
    <!-- Hero Section -->
    <div class="hero">
        <img src="../assets/images/Upcoming2Events.png" alt="Forest Image">
        <div class="hero-text">
            <h1>Upcoming Events</h1>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="content">

        <?php
        // Database connection parameters
        $host = 'localhost';
        $db = 'green_legacy';
        $user = 'root';
        $pass = '';

        // Create a new PDO instance
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Could not connect to the database: " . $e->getMessage());
        }

        // Fetch events from the database
        $query = $pdo->query("SELECT * FROM events ORDER BY date ASC, time ASC");
        $events = $query->fetchAll(PDO::FETCH_ASSOC);

        // Display events
        foreach ($events as $event) {
            echo '<div class="event-card">';
            echo '<h3 class="event-title">' . htmlspecialchars($event['title']) . '</h3>';
            echo '<p class="event-details">Date: ' . htmlspecialchars($event['date']) . ' | Time: ' . htmlspecialchars($event['time']) . '</p>';
            echo '<p class="event-details">Location: ' . htmlspecialchars($event['location']) . '</p>';
            echo '<p class="event-description">' . htmlspecialchars($event['description']) . '</p>';
            echo '<a href="#" class="event-registration">You are Welcome!</a>';
            echo '</div>';
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
