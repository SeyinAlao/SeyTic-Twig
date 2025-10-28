<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../helpers/session.php';

requireLogin();

// Ensure tickets array exists
if (!isset($_SESSION['tickets'])) {
    $_SESSION['tickets'] = [];
}

// Calculate stats
$tickets = $_SESSION['tickets'];
$total = count($tickets);
$open = count(array_filter($tickets, fn($t) => $t['status'] === 'open'));
$inProgress = count(array_filter($tickets, fn($t) => $t['status'] === 'in_progress'));
$closed = count(array_filter($tickets, fn($t) => $t['status'] === 'closed'));

// Twig setup
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

// Pass specific user properties to Twig to avoid Array to string conversion
$user = $_SESSION['ticketapp_session']; // e.g., ['name' => 'Seyin', 'email' => 'seyin@example.com']

echo $twig->render('dashboard.twig', [
    'user_name' => $user['name'] ?? 'User', // Use name or default
    'stats' => [
        'total' => $total,
        'open' => $open,
        'in_progress' => $inProgress,
        'closed' => $closed
    ]
]);


