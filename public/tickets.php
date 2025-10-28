<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../helpers/session.php';
requireLogin();

if (!isset($_SESSION['tickets'])) {
    $_SESSION['tickets'] = [];
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['edit']) && !isset($_GET['delete'])) {
    $title = trim($_POST['title']);
    $status = trim($_POST['status']);
    $description = trim($_POST['description']);

    if ($title === '' || !in_array($status, ['open', 'in_progress', 'closed'])) {
        echo $twig->render('tickets.twig', [
            'error' => 'Please provide a title and valid status.'
        ]);
        exit();
    }

    $_SESSION['tickets'][] = [
        'id' => uniqid(),
        'title' => $title,
        'status' => $status,
        'description' => $description,
        'created_at' => date('Y-m-d H:i:s')
    ];

    header('Location: tickets.php?success=created');
    exit();
}

if (!isset($_GET['edit']) && !isset($_GET['delete'])) {
    echo $twig->render('tickets_list.twig', [
        'tickets' => $_SESSION['tickets'],
        'success' => $_GET['success'] ?? null
    ]);
    exit();
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $ticket = null;
    foreach ($_SESSION['tickets'] as $t) {
        if ($t['id'] === $id) $ticket = $t;
    }

    if (!$ticket) {
        header('Location: tickets.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_SESSION['tickets'] as &$t) {
            if ($t['id'] === $id) {
                $t['title'] = trim($_POST['title']);
                $t['status'] = trim($_POST['status']);
                $t['description'] = trim($_POST['description']);
            }
        }
        header('Location: tickets.php?success=updated');
        exit();
    }

    echo $twig->render('edit_ticket.twig', ['ticket' => $ticket]);
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $_SESSION['tickets'] = array_filter($_SESSION['tickets'], fn($t) => $t['id'] !== $id);

    header('Location: tickets.php?success=deleted');
    exit();
}
