<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Safety Alert System</title>

    <link rel="stylesheet" href="/safety_alert/assets/css/style.css">
</head>

<body>

<nav class="navbar">

    <div class="logo">
        🛡 Safety Alert
    </div>

    <div class="nav-links">

        <a href="/safety_alert/index.php">Home</a>

        <?php if (isset($_SESSION['user_id'])): ?>

            <a href="/safety_alert/user/dashboard.php">Dashboard</a>

            <a href="/safety_alert/emergency/contacts.php">
                Emergency Contacts
            </a>

            <a href="/safety_alert/incidents/report.php">
                Report
            </a>

            <a href="/safety_alert/user/profile.php">
                Profile
            </a>

            <?php if ($_SESSION['role'] === 'police'): ?>
                <a href="/safety_alert/police/dashboard.php">Police</a>
            <?php endif; ?>

            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="/safety_alert/admin/dashboard.php">Admin</a>
            <?php endif; ?>

            <a href="/safety_alert/user/logout.php">Logout</a>

        <?php else: ?>

            <a href="/safety_alert/user/login.php">Login</a>

            <a href="/safety_alert/user/register.php">Register</a>

        <?php endif; ?>

    </div>

</nav>

<main class="container">