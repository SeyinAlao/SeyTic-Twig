<?php
session_start();

if (!isset($_SESSION['auth_token'])) {
 
  header('Location: /auth.php?mode=login');
  exit;
}
