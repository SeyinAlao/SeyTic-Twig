<?php
$mode = $_GET['mode'] ?? 'login';

echo $twig->render('auth.twig', [
  'mode' => $mode,
  'errors' => $errors ?? [],
  'error' => $generalError ?? null,
  'old' => $_POST ?? []
]);
