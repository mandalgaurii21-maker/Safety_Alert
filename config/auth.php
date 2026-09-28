<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

function requireRole($role)
{
    requireLogin();

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header("Location: ../index.php");
        exit();
    }
}
?>