<?php
include '../conexao.php';

$id = $_GET['id'] ?? 0;
mysqli_query($conexao, "DELETE FROM produto_receita WHERE receita_id='$id'");
mysqli_query($conexao, "DELETE FROM receita WHERE id='$id'");

header('Location:../../receita.php');
exit;
?>
