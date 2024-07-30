<?php
include 'headerwithmenu.php'; // Adjust the path accordingly

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Use your actual database password
$dbname = "green_legacy"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch members data including description
$members = [];
$sql = "SELECT id, name, role, image_url, description FROM members";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $members[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Header -->
    <?php include 'headerwithmenu.php'; ?>
    <style>
        .about-section, .our-story-section, .our-vision-section, .our-mission-section, .members-section {
            padding: 50px;
            text-align: center;
        }
        .about-section {
            background-color: #eae7dc;
            margin-top: 40px;
        }
        .our-story-section, .our-vision-section, .our-mission-section {
            background-color: #fdf4e3;
        }
        .members-section {
            background-color: #d8c3a5;
        }
        .about-section h1, .our-story-section h2, .our-vision-section h2, .our-mission-section h2, .members-section h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .about-content, .our-story-content, .our-vision-content, .our-mission-content {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 20px 0;
        }
        .about-main-image {
            max-width: 420px; /* Adjust the width as needed */
            height: auto;
        }
        .about-text, .story-text, .vision-text, .mission-text {
            width: 60%;
            text-align: left;
        }
        .about-text p, .story-text p, .vision-text p, .mission-text p {
            margin: 10px 0;
            line-height: 1.6;
        }
        .about-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }
        .stat {
            text-align: center;
        }
        .stat h2 {
            font-size: 2em;
            margin: 10px 0;
        }
        .members-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px; /* Adjust space between cards */
        }
        .member img {
            border-radius: 50%; /* Make the images circular */
            width: 180px; /* Adjust width */
            height: 180px; /* Adjust height */
            object-fit: cover; /* Ensure the image fits well */
            margin-top: 20px; /* Longer margin at the top */
            margin-bottom: 5px;
        }
        .members-row {
            display: flex;
            justify-content: space-between; /* Space out the member cards */
            margin: 20px 0; /* Adjust spacing between rows */
            width: 100%; /* Full width for row */
        }
        .member {
            background: #f4e5ce;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 20px;
            width: 48%; /* Adjust the width of the card */
            box-sizing: border-box;
            margin-top: 20px; /* Adjust margin top for separation */
        }
        .member-left {
            margin-right: auto; /* Align to the left */
        }
        .member-right {
            margin-left: auto; /* Align to the right */
        }
        .member h3 {
            margin-top: 15px; /* Space between image and name */
        }
        .member p.role {
            font-weight: bold; /* Optional: Make the role text bold */
            margin-top: 10px; /* Space between name and role */
        }
        .member p.description {
            margin-top: 10px; /* Space between role and description */
        }
        .story-image img, .vision-image img, .mission-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        /* Added styles to make images smaller */
        .story-image img, .vision-image img, .mission-image img {
            max-width: 450px;
            height: auto;
        }
        .our-story-section, .our-vision-section, .our-mission-section {
            display: flex;
            flex-direction: column;
            align-items: left; /* Aligns the entire content block to the left */
            padding: 50px;
            text-align: left; /* Align text to the left */
        }
        .our-story-section h2, .our-vision-section h2, .our-mission-section h2 {
            margin: 0;
            padding-bottom: 10px; /* Adds space between the title and the text */
        }
        .our-story-content, .our-vision-content, .our-mission-content {
            text-align: right; /* Aligns the text content to the left for readability */
        }
    </style>
</head>
<body>
    <div class="about-section">
        <div class="about-content">
            <div class="about-text">
                <h1>From vision to real life</h1>
                <p>We ignite students' environmental passions and turn them into action. Whether it's reforesting a local park or starting a campus green project, we empower students to make their eco-friendly visions flourish and inspire lasting change.</p>
            </div>
            <div class="about-images">
                <img src="../assets/images/conteparytree.jpg" alt="From sketch to real life" class="about-main-image">
            </div>
        </div>
        <div class="about-stats">
            <div class="stat">
                <h2>10+</h2>
                <p>Years</p>
            </div>
            <div class="stat">
                <h2>300+</h2>
                <p>Joined</p>
            </div>
            <div class="stat">
                <h2>5+</h2>
                <p>Awards</p>
            </div>
            <div class="stat">
                <h2>120+</h2>
                <p>Projects</p>
            </div>
        </div>
    </div>
    <div class="our-story-section">
        <h2>Our Story</h2>
        <div class="our-story-content">
            <div class="story-text">
                <p>Green Legacy was founded with the belief that it's not too late to restore our natural world. By harnessing innovative technology and fostering community engagement, we aim to create a legacy of green that will endure for generations to come. Our app is a beacon of hope, designed to track tree planting efforts, highlight conservation achievements, and inspire action.</p>
            </div>
            <div class="story-image">
                <img src="../assets/images/degradedland.jpg" alt="Our Story">
            </div>
        </div>
    </div>
    <div class="our-vision-section">
        <h2>Our Vision</h2>
        <div class="our-vision-content">
            <div class="vision-text">
                <p>To inspire a global movement towards forest restoration and sustainable coexistence, ensuring that future generations inherit a thriving, green planet. We envision a world where deforestation is reversed, ecosystems are revitalized, and humanity lives in harmony with nature, leaving a powerful legacy of environmental stewardship and resilience.</p>
            </div>
            <div class="vision-image">
                <img src="../assets/images/vision.jpg" alt="Our Vision">
            </div>
        </div>
    </div>
    <div class="our-mission-section">
        <h2>Our Mission</h2>
        <div class="our-mission-content">
            <div class="mission-text">
                <p>Our mission is simple yet profound: to reverse the tide of deforestation and cultivate a future where forests thrive, not just survive. We aim to achieve this by mobilizing students and communities in tree planting and conservation activities. Through innovative technology and active engagement our goal is to restore vital ecosystems and create a lasting green legacy for future generations.</p>
            </div>
            <div class="mission-image">
                <img src="../assets/images/forestrystudents.jpg" alt="Our Mission">
            </div>
        </div>
    </div>
    <div class="members-section">
        <h2>Our Team</h2>
        <div class="members-container">
            <?php if (!empty($members)): ?>
                <?php 
                // Separate Krystel and Jannie
                $group1 = array_filter($members, function($member) {
                    return $member['name'] == 'Krystel' || $member['name'] == 'Jannie';
                });
                $group2 = array_filter($members, function($member) {
                    return $member['name'] != 'Krystel' && $member['name'] != 'Jannie';
                });
                ?>
                <div class="members-row">
                    <?php foreach($group1 as $member): ?>
                        <div class="member <?php echo $member['name'] == 'Krystel' ? 'member-left' : 'member-right'; ?>">
                            <img src="<?php echo $member['image_url']; ?>" alt="<?php echo $member['name']; ?>">
                            <h3><?php echo $member['name']; ?></h3>
                            <p class="role"><?php echo $member['role']; ?></p>
                            <p class="description"><?php echo $member['description']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="members-row">
                    <?php foreach($group2 as $member): ?>
                        <div class="member">
                            <img src="<?php echo $member['image_url']; ?>" alt="<?php echo $member['name']; ?>">
                            <h3><?php echo $member['name']; ?></h3>
                            <p class="role"><?php echo $member['role']; ?></p>
                            <p class="description"><?php echo $member['description']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No team members found.</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'footer.php'; // Adjust the path accordingly ?>
</body>
</html>
