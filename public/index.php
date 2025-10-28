<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Twig Setup
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

// Data passed to the landing page (for features loop)
$features = [
    ['icon' => 'ticket', 'title' => 'Track Issues', 'description' => 'Keep track of support issues.'],
    ['icon' => 'users', 'title' => 'Collaborate', 'description' => 'Work together smoothly.'],
    ['icon' => 'clock', 'title' => 'Save Time', 'description' => 'Manage tickets efficiently.'],
    ['icon' => 'check-circle', 'title' => 'Resolve Faster', 'description' => 'Deliver solutions quicker.'],
];

echo $twig->render('landing.twig', ['features' => $features]);
