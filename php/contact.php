<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $reason = htmlspecialchars($_POST['reason']);
    $comments = htmlspecialchars($_POST['comments']);

    $to = "your-email@example.com"; // Replace with your email address
    $subject = "New Contact Us Message";
    $message = "First Name: $firstName\nLast Name: $lastName\nEmail: $email\nReason: $reason\nComments: $comments";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        $responseMessage = "Thank you for contacting us. We will get back to you shortly.";
    } else {
        $responseMessage = "Sorry, there was an error sending your message. Please try again later.";
    }
} else {
    $responseMessage = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('../assets/images/contact.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #354e41;
            height: 100%;
            display: flex;
            flex-direction: column;
            padding-top: 80px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .container {
            background: rgba(205, 218, 212, 0.8);
            border-radius: 8px;
            padding: 20px;
            max-width: 800px;
            width: 90%;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
            overflow-y: auto;
            flex: 1 0 auto;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-header h1 {
            font-size: 2.5em;
            color: #354e41;
        }

        .contact-header p {
            color: #354e41;
        }

        .form-section h2 {
            color: #354e41;
        }

        .form-section label {
            display: block;
            margin-bottom: 5px;
            color: #354e41;
        }

        .form-section input,
        .form-section select,
        .form-section textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #444;
            background: rgba(255, 255, 255, 0.1);
            color: #222;
            border-radius: 4px;
        }

        .form-section input:focus,
        .form-section select:focus,
        .form-section textarea:focus {
            border-color: #ffcc00;
            outline: none;
        }

        .form-section button {
            width: 100%;
            padding: 15px;
            background-color: #354e41;
            border: none;
            border-radius: 4px;
            color: #000000;
            font-size: 1.2em;
            cursor: pointer;
        }

        .form-section button:hover {
            background-color: #ffcc00;
        }

        .map-section {
            background: rgba(205, 218, 212, 0.8);
            color: #354e41;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-top: 20px;
        }

        .map-section p {
            font-size: 1.2em;
            margin: 0;
        } 
    </style>
</head>
<body>
    <?php include 'headerwithmenu.php'; ?>
    <div class="overlay"></div>
    <div class="container">
        <div class="contact-header">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you! Please fill out the form below and we will get in touch with you shortly.</p>
        </div>
        <div class="form-section">
            <h2>Get In Touch</h2>
            <?php if ($responseMessage): ?>
                <p><?php echo $responseMessage; ?></p>
            <?php endif; ?>
            <form action="contact.php" method="post">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="First Name" required>

                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Email Address" required>

                <label for="reason">Reason for contacting</label>
                <select id="reason" name="reason" required>
                    <option value="">Select a reason</option>
                    <option value="support">Support</option>
                    <option value="sales">Sales</option>
                    <option value="feedback">Feedback</option>
                </select>

                <label for="comments">Comments</label>
                <textarea id="comments" name="comments" rows="4" placeholder="Your comments"></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="map-section">
            <p><strong>Call:</strong> 0775555444</p>
            <p><strong>Visit:</strong> Nyari, Red Hill Dr, Westlands, KE 00800-00100</p>
        </div>
    </div>
</body>
</html>

