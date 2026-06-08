<?php
include '../conexao.php';
include '../funcoes.php';

$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$cnpj = $_POST['cnpj'] ?? '';
$senha = $_POST['senha'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$fotoAtual = $_POST['foto_atual'] ?? '';
$foto = salvar_upload('foto', 'mercados', $fotoAtual);
$mapa = $_POST['mapa'] ?? '';

$sql = "UPDATE mercado SET nome='$nome', email='$email', cnpj='$cnpj', senha='$senha', endereco='$endereco', telefone='$telefone', foto='$foto', mapa='$mapa' WHERE id='$id'";
mysqli_query($conexao, $sql);

header('Location:../../mercado.php');
exit;
?>
