<?php
include '../conexao.php';
include '../funcoes.php';

$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$fotoAtual = $_POST['foto_atual'] ?? '';
$foto = salvar_upload('foto', 'receitas', $fotoAtual);

$sql = "UPDATE receita SET nome='$nome', foto='$foto', descricao='$descricao' WHERE id='$id'";
mysqli_query($conexao, $sql);

header('Location:../../receita.php');
exit;
?>
