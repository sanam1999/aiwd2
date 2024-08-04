<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $_SESSION['login'] = false;
    $_SESSION['user'] = "";
    $_SESSION['userid'] = "";
    $_SESSION['success'] = "See you soon " . $_SESSION['user'];
    header('Location: login.php ');
}
?>