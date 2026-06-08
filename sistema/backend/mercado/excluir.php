<?php
include '../conexao.php';

$id = $_GET['id'] ?? 0;

mysqli_query($conexao, "DELETE FROM produto_receita WHERE produto_id IN (SELECT id FROM produto WHERE mercado_id='$id')");
mysqli_query($conexao, "DELETE FROM produto WHERE mercado_id='$id'");
mysqli_query($conexao, "DELETE FROM mercado WHERE id='$id'");

header('Location:../../mercado.php');
exit;
?>
