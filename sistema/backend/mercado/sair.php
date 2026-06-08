<?php
session_start();
unset($_SESSION['mercado_id']);
unset($_SESSION['mercado_nome']);
unset($_SESSION['mercado_email']);
header('Location:../../mercado_login.php');
exit;
?>
