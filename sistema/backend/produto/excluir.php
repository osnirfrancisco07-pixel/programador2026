<?php
session_start();
include '../conexao.php';

$id = $_GET['id'] ?? 0;

if (isset($_SESSION['mercado_id'])) {
    $mercadoId = $_SESSION['mercado_id'];
    mysqli_query($conexao, "DELETE FROM produto_receita WHERE produto_id IN (SELECT id FROM produto WHERE id='$id' AND mercado_id='$mercadoId')");
    mysqli_query($conexao, "DELETE FROM produto WHERE id='$id' AND mercado_id='$mercadoId'");
    header('Location:../../mercado_produtos.php');
    exit;
}

mysqli_query($conexao, "DELETE FROM produto_receita WHERE produto_id='$id'");
mysqli_query($conexao, "DELETE FROM produto WHERE id='$id'");

header('Location:../../produto.php');
exit;
?>
