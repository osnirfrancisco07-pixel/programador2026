<?php
include '../conexao.php';
include '../funcoes.php';

$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$foto = salvar_upload('foto', 'receitas');

$sql = "INSERT INTO receita(nome, foto, descricao) VALUES ('$nome','$foto','$descricao')";
mysqli_query($conexao, $sql);

header('Location:../../receita.php');
exit;
?>
