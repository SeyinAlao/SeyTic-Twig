<?php

session_start();

function isLoggedIn() {
    return isset($_SESSION['ticketapp_session']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /login.php");
        exit;
    }
}
