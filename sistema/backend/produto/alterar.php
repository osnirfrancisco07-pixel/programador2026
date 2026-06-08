<?php
session_start();
include '../conexao.php';
include '../funcoes.php';

$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$preco = moeda_para_banco($_POST['preco'] ?? '0');
$disponibilidade = $_POST['disponibilidade'] ?? 'ativo';
$imagemAtual = $_POST['imagem_atual'] ?? '';
$imagem = salvar_upload('imagem', 'produtos', $imagemAtual);
$mercado = $_SESSION['mercado_id'] ?? ($_POST['mercado'] ?? '');
$receitas = $_POST['receitas'] ?? [];

$sql = "UPDATE produto SET nome='$nome', preco='$preco', disponibilidade='$disponibilidade', imagem='$imagem', mercado_id='$mercado' WHERE id='$id'";
mysqli_query($conexao, $sql);

mysqli_query($conexao, "DELETE FROM produto_receita WHERE produto_id='$id'");
foreach ($receitas as $receitaId) {
    mysqli_query($conexao, "INSERT INTO produto_receita(produto_id, receita_id) VALUES ('$id','$receitaId')");
}

$destino = isset($_SESSION['mercado_id']) ? '../../mercado_produtos.php' : '../../produto.php';
header('Location:' . $destino);
exit;
?>
