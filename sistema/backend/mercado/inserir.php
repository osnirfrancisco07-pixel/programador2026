<?php
include '../conexao.php';
include '../funcoes.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$cnpj = $_POST['cnpj'] ?? '';
$senha = $_POST['senha'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$foto = salvar_upload('foto', 'mercados');
$mapa = $_POST['mapa'] ?? '';

$sql = "INSERT INTO mercado (nome,email,cnpj,senha,endereco,telefone,foto,mapa) VALUES ('$nome','$email','$cnpj','$senha','$endereco','$telefone','$foto','$mapa')";
mysqli_query($conexao, $sql);

header('Location:../../mercado.php');
exit;
?>
