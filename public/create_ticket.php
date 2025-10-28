<?php
session_start();
require_once __DIR__ . '/../helpers/session.php';

requireLogin();

// Ensure tickets array exists
if (!isset($_SESSION['tickets'])) {
    $_SESSION['tickets'] = [];
}

// Only add ticket if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = $_POST['status'] ?? '';

    // Validation
    if ($title === '') {
        $errors[] = "Title is required.";
    }
    if (!in_array($status, ['open', 'in_progress', 'closed'])) {
        $errors[] = "Invalid status selected.";
    }

    if (empty($errors)) {
        $_SESSION['tickets'][] = [
            'title' => $title,
            'description' => $description,
            'status' => $status
        ];

        // Redirect to avoid duplicate submissions
        header('Location: dashboard.php');
        exit();
    } else {
        // Save errors in session to display in dashboard
        $_SESSION['ticket_errors'] = $errors;
        header('Location: dashboard.php');
        exit();
    }
} else {
    // If accessed directly, redirect to dashboard
    header('Location: dashboard.php');
    exit();
}
