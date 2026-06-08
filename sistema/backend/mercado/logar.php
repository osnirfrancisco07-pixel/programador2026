<?php
include '../conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = "SELECT * FROM mercado WHERE email='$email' AND senha='$senha'";
$resultado = mysqli_query($conexao, $sql);
$mercado = mysqli_fetch_assoc($resultado);

if ($mercado) {
    session_start();
    $_SESSION['mercado_id'] = $mercado['id'];
    $_SESSION['mercado_nome'] = $mercado['nome'];
    $_SESSION['mercado_email'] = $mercado['email'];
    header('Location:../../mercado_produtos.php');
    exit;
}

header('Location:../../mercado_login.php?erro=1');
exit;
?>
