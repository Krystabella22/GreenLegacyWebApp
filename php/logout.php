<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// If you want to destroy the session cookie, you need to set the cookie parameters and then delete it
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Destroy the session
session_destroy();

// Redirect to the homepage or login page
header('Location: ..\php\index.php'); // Adjust this URL if needed
exit();
?>
