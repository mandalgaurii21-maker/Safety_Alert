<?php

session_start();

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header("Location: ../user/login.php");
        exit();
    }
}

function isAdmin()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function requireAdmin()
{
    if (!isLoggedIn() || !isAdmin()) {
        header("Location: ../user/login.php");
        exit();
    }
}

function isPolice()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'police';
}

function requirePolice()
{
    if (!isLoggedIn() || !isPolice()) {
        header("Location: ../user/login.php");
        exit();
    }
}
?>