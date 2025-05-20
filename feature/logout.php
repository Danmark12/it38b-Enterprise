<?php
session_start();
require 'config.php';
require 'functions.php';

if (isset($_SESSION['user_id'])) {
    log_event($conn, $_SESSION['user_id'], 'logout', $_SESSION['first_name'] . ' logged out.');
}

session_destroy();
header("Location: ../index.php");
exit;
?>
