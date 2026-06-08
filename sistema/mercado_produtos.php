<?php
include './backend/conexao.php';
include './backend/mercado/validacao.php';

$mercadoId = $_SESSION['mercado_id'];
$destino = './backend/produto/inserir.php';
$produto = null;
$receitasSelecionadas = [];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $dados = mysqli_query($conexao, "SELECT * FROM produto WHERE id='$id' AND mercado_id='$mercadoId'");
    $produto = mysqli_fetch_assoc($dados);
    if ($produto) {
        $destino = './backend/produto/alterar.php';
        $vinculos = mysqli_query($conexao, "SELECT receita_id FROM produto_receita WHERE produto_id='$id'");
        while ($vinculo = mysqli_fetch_assoc($vinculos)) {
            $receitasSelecionadas[] = $vinculo['receita_id'];
        }
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meus produtos - Ecolote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css">
</head>
<body>
<nav class="navbar navbar-expand-lg corbarra">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="./mercado_produtos.php">Painel do mercado</a>
        <div class="ms-auto text-white me-3"><?= $_SESSION['mercado_nome'] ?></div>
        <a href="./backend/mercado/sair.php" class="btn btn-outline-light btn-sm">Sair</a>
    </div>
</nav>
<div class="container-fluid py-4">
    <div class="row g-4">
        <div class="col-lg-5">
            <form action="<?= $destino ?>" method="post" enctype="multipart/form-data" class="admin-card p-3">
                <h3><i class="fa-solid fa-box"></i> Produto</h3>
                <input value="<?= $produto['id'] ?? '' ?>" type="hidden" name="id">
                <input value="<?= $produto['imagem'] ?? '' ?>" type="hidden" name="imagem_atual">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input value="<?= $produto['nome'] ?? '' ?>" type="text" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Preco</label>
                    <input value="<?= $produto['preco'] ?? '' ?>" type="text" name="preco" class="form-control mascara-preco" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Disponibilidade</label>
                    <select class="form-select" name="disponibilidade">
                        <option value="ativo" <?= (($produto['disponibilidade'] ?? '') == 'ativo') ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo" <?= (($produto['disponibilidade'] ?? '') == 'inativo') ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagem</label>
                    <input type="file" name="imagem" class="form-control" accept="image/*">
                    <?php if (!empty($produto['imagem'])) { ?>
                        <img src="<?= $produto['imagem'] ?>" class="img-preview mt-2" alt="Produto">
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Receitas vinculadas</label>
                    <select name="receitas[]" class="form-select" multiple size="5">
                        <?php
                        $receitas = mysqli_query($conexao, "SELECT * FROM receita ORDER BY nome");
                        while ($receita = mysqli_fetch_assoc($receitas)) {
                            $selected = in_array($receita['id'], $receitasSelecionadas) ? 'selected' : '';
                            ?>
                            <option value="<?= $receita['id'] ?>" <?= $selected ?>><?= $receita['nome'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="./mercado_produtos.php" class="btn btn-secondary">Limpar</a>
            </form>
        </div>
        <div class="col-lg-7">
            <div class="admin-card p-3">
                <h3><i class="fa-solid fa-list"></i> Meus produtos</h3>
                <table class="table" id="tabela">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Preco</th>
                        <th>Status</th>
                        <th>Opcoes</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dados = mysqli_query($conexao, "SELECT * FROM produto WHERE mercado_id='$mercadoId' ORDER BY nome");
                    while ($coluna = mysqli_fetch_assoc($dados)) {
                        ?>
                        <tr>
                            <th><?= $coluna['id'] ?></th>
                            <td><?= $coluna['nome'] ?></td>
                            <td>R$ <?= number_format($coluna['preco'], 2, ',', '.') ?></td>
                            <td><?= $coluna['disponibilidade'] ?></td>
                            <td>
                                <a href="./mercado_produtos.php?id=<?= $coluna['id'] ?>"><i class="fa-solid fa-pen-to-square" style="color: rgb(1, 92, 164);"></i></a>
                                <a href="./backend/produto/excluir.php?id=<?= $coluna['id'] ?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fa-solid fa-trash" style="color: rgb(255, 0, 0);"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="./assets/script.js"></script>
</body>
</html>
