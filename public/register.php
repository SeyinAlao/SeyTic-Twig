<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../helpers/session.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save to DB later — for now just login immediately
    $_SESSION['ticketapp_session'] = ['name' => $_POST['name'], 'email' => $_POST['email']];
    header('Location: /dashboard.php');
    exit();
}

echo $twig->render('register.twig');
