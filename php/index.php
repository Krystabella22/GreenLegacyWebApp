<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Legacy</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Poppins, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .hero {
            background: url('../assets/images/hero.png') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 100px 20px;
            margin-top: 85px;
        }

        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #354e41;
            color: white;
            padding: 15px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .steps {
            background: url('../assets/images/steps4.png') no-repeat center center/cover;
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .steps .step {
            display: inline-block;
            width: 25%;
            margin: 15px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #000;
        }

        .explore, .achievements, .faq {
            padding: 60px 20px;
            text-align: center;
        }

        .explore .cards {
            display: flex;
            justify-content: center;
            gap: 50px;
        }

        .explore .card {
            flex: 1;
            max-width: 300px;
            height: 400px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .explore .card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .explore .btn {
            background-color: #354e41;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: auto;
        }

        .achievements {
            background: url('../assets/images/achievements.jpg') no-repeat center center/cover;
            color: white;
        }

        .achievements .stat {
            display: inline-block;
            width: 25%;
            margin: 15px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #000;
        }

        .faq .faq-item {
            display: inline-block;
            width: 25%;
            margin: 15px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include 'headerwithmenu.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>We Keep the Forest Going.</h1>
            <p>Join us in restoring our planet by planting trees and fostering communities.</p>
            <a href="..\php\login.php" class="btn">Get Involved</a>
        </div>
    </section>

    <section class="steps">
        <h2>3 Easy Steps To Get Involved</h2>
        <div class="step">
            <h3>1. Sign up</h3>
            <p>Create an account and join our community.</p>
        </div>
        <div class="step">
            <h3>2. Learn more about trees or Log a tree Planting Activity</h3>
            <p>Choose how you want to contribute.</p>
        </div>
        <div class="step">
            <h3>3. Track and share</h3>
            <p>Follow the progress and share your impact.</p>
        </div>
    </section>

    <section class="explore">
        <h2>Explore, Learn, and Share</h2>
        <div class="cards">
            <div class="card">
                <img src="../assets/images/treesforfuture.png" alt="Trees for the Future">
                <h3>Trees for the Future</h3>
                <p>Plant trees and restore ecosystems.</p>
                <a href="..\php\reading-room.php" class="btn">Learn</a>
            </div>
            <div class="card">
                <img src="../assets/images/treeeducation.jpg" alt="Learn more about trees">
                <h3>Learn more about Trees</h3>
                <p>Support forest conservation.</p>
                <a href="..\php\reading-room.php" class="btn">Learn</a>
            </div>
            <div class="card">
                <img src="../assets/images/treeplanting.jpg" alt="Log Tree Planting Activity">
                <h3>Log Tree Planting Activity</h3>
                <p>Help restore our planet's lungs.</p>
                <a href="..\php\log-activity.php" class="btn">Log Activity</a>
            </div>
        </div>
    </section>

    <section class="achievements">
        <h2>Achievements</h2>
        <div class="stats">
            <div class="stat">
                <h3>120+</h3>
                <p>Projects Completed</p>
            </div>
            <div class="stat">
                <h3>5+</h3>
                <p>Awards</p>
            </div>
            <div class="stat">
                <h3>300+</h3>
                <p>Joined</p>
            </div>
        </div>
    </section>

    <section class="faq">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-item">
            <h3>How can I donate?</h3>
            <p>You can donate through our website or mobile app using various payment methods.</p>
        </div>
        <div class="faq-item">
            <h3>How does the platform work?</h3>
            <p>Our platform connects you with various tree-planting projects worldwide.</p>
        </div>
        <div class="faq-item">
            <h3>Do you have an app?</h3>
            <p>Yes, our app is available on both Android and iOS.</p>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Add any JavaScript interactivity here if needed
        });
    </script>
</body>
</html>
