<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../helpers/session.php';

// Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simple login demo (replace with DB query later)
    if ($email === 'test@mail.com' && $password === '1234') {
        $_SESSION['ticketapp_session'] = ['name' => 'Test User', 'email' => $email];
        header('Location: /dashboard.php');
        exit();
    }

    echo $twig->render('login.twig', ['error' => 'Invalid credentials.']);
    exit();
}

echo $twig->render('login.twig');
