<?php
session_start();

if (!isset($_SESSION["email"]) or !isset($_SESSION["senha"])) {
    session_destroy();
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location:login.php');
    exit;
}
?>
