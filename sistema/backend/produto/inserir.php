<?php
session_start();
include '../conexao.php';
include '../funcoes.php';

$nome = $_POST['nome'] ?? '';
$preco = moeda_para_banco($_POST['preco'] ?? '0');
$disponibilidade = $_POST['disponibilidade'] ?? 'ativo';
$imagem = salvar_upload('imagem', 'produtos');
$mercado = $_SESSION['mercado_id'] ?? ($_POST['mercado'] ?? '');
$receitas = $_POST['receitas'] ?? [];

$sql = "INSERT INTO produto(nome, preco, disponibilidade, imagem, mercado_id) VALUES ('$nome','$preco','$disponibilidade','$imagem','$mercado')";
mysqli_query($conexao, $sql);
$produtoId = mysqli_insert_id($conexao);

foreach ($receitas as $receitaId) {
    mysqli_query($conexao, "INSERT INTO produto_receita(produto_id, receita_id) VALUES ('$produtoId','$receitaId')");
}

$destino = isset($_SESSION['mercado_id']) ? '../../mercado_produtos.php' : '../../produto.php';
header('Location:' . $destino);
exit;
?>
