<?php

session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] === false) {
    $_SESSION['error'] = "You must be logged in";
    header('Location: ../product/login.php');
    exit;
}
?>