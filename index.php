<?php
session_start();

// Set session timeout to 15 seconds
ini_set('session.gc_maxlifetime', 15);
session_set_cookie_params(15);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check admin password
    $adminPassword = $_POST["adminPassword"];
    // Check admin password
    if ($adminPassword == "admin123") {
        // Admin login successful, set session variable
        $_SESSION['adminLoggedIn'] = true;
    } else {
        // Invalid password, show error message
        $loginError = "Invalid password";
    }
}

// Check if admin is logged in
$adminLoggedIn = isset($_SESSION['adminLoggedIn']) && $_SESSION['adminLoggedIn'];

// Check if session is expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 15)) {
    // Unset session variables
    session_unset();
    // Destroy the session
    session_destroy();
}

// Update last activity time stamp
$_SESSION['LAST_ACTIVITY'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to Server Troubleshoot</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        text-align: center;
    }
    .container {
        margin-top: 50px;
    }
    h1 {
        font-size: 1.6em; /* 1.6 times the default size */
        font-weight: bold;
        color: black;
    }
    .buttons-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin-top: 20px;
    }
    .button {
        margin: 10px;
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }
    #status-button {
        background-color: #007bff;
        color: white;
    }
    #restart-button {
        background-color: #28a745;
        color: white;
    }
    #reboot-button {
        background-color: #dc3545;
        color: white;
    }
    #notification-button {
        background-color: #ffc107;
        color: black;
    }
    .error {
        color: red;
    }
    .home-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 10px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 50%;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Welcome to Server Troubleshoot</h1>
    <div class="buttons-container">
        <a href="server_status.php"><button id="status-button" class="button">Status</button></a>
        <a href="restart.php"><button id="restart-button" class="button">Restart Server</button></a>
        <a href="hard_reboot.php"><button id="reboot-button" class="button">Hard Reboot</button></a>
        <a href="#"><button id="notification-button" class="button">Click to Email Notification (Incase of Servers Down)</button></a>
        <a href="index.php" class="home-icon">&#127968;</a>
    </div>
</div>
</body>
</html>
