<?php
session_start();

if (!isset($_SESSION['mercado_id'])) {
    session_destroy();
    header('Location:../../mercado_login.php');
    exit;
}
?>
