<?php
include './backend/conexao.php';
include './backend/validacao.php';

$destino = './backend/produto/inserir.php';
$produtos = null;
$receitasSelecionadas = [];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $dados = mysqli_query($conexao, "SELECT * FROM produto WHERE id='$id'");
    $produtos = mysqli_fetch_assoc($dados);
    $destino = './backend/produto/alterar.php';
    $vinculos = mysqli_query($conexao, "SELECT receita_id FROM produto_receita WHERE produto_id='$id'");
    while ($vinculo = mysqli_fetch_assoc($vinculos)) {
        $receitasSelecionadas[] = $vinculo['receita_id'];
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produtos - Ecolote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css">
</head>
<body>
<?php include './modulos/menu_superior.php'; ?>
<div id="escurecer" class="escurecer" onclick="abrirmenu()"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-dark p-0">
            <?php include './modulos/menu_lateral.php'; ?>
        </div>
        <div class="col-md-5">
            <form action="<?= $destino ?>" method="post" enctype="multipart/form-data" class="p-3">
                <h3><i class="fa-solid fa-circle-plus"></i> Cadastro</h3>
                <input value="<?= $produtos['id'] ?? '' ?>" type="hidden" name="id">
                <input value="<?= $produtos['imagem'] ?? '' ?>" type="hidden" name="imagem_atual">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input value="<?= $produtos['nome'] ?? '' ?>" type="text" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Preco</label>
                    <input value="<?= $produtos['preco'] ?? '' ?>" type="text" name="preco" class="form-control mascara-preco">
                </div>
                <div class="mb-3">
                    <label class="form-label">Disponibilidade</label>
                    <select class="form-select" name="disponibilidade">
                        <option value="ativo" <?= (($produtos['disponibilidade'] ?? '') == 'ativo') ? 'selected' : '' ?>>Ativo</option>
                        <option value="inativo" <?= (($produtos['disponibilidade'] ?? '') == 'inativo') ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagem</label>
                    <input type="file" name="imagem" class="form-control" accept="image/*">
                    <?php if (!empty($produtos['imagem'])) { ?>
                        <img src="<?= $produtos['imagem'] ?>" class="img-preview mt-2" alt="Produto">
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mercado</label>
                    <select name="mercado" class="form-select">
                        <?php
                        $busca = mysqli_query($conexao, "SELECT * FROM mercado ORDER BY nome");
                        $mercadoSelecionado = $produtos['mercado_id'] ?? '';
                        while ($mercado = mysqli_fetch_assoc($busca)) {
                            $selected = ($mercadoSelecionado == $mercado['id']) ? 'selected' : '';
                            ?>
                            <option value="<?= $mercado['id'] ?>" <?= $selected ?>><?= $mercado['nome'] ?></option>
                        <?php } ?>
                    </select>
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
                <button type="reset" class="btn btn-secondary">Limpar</button>
            </form>
        </div>
        <div class="col-md-5">
            <br>
            <h3><i class="fa-solid fa-address-book"></i> Listagem</h3>
            <table class="table" id="tabela">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Preco</th>
                    <th>Disponibilidade</th>
                    <th>Mercado</th>
                    <th>Opcoes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $dados = mysqli_query($conexao, "SELECT produto.*, mercado.nome AS mercado_nome FROM produto INNER JOIN mercado ON mercado.id=produto.mercado_id ORDER BY produto.nome");
                while ($coluna = mysqli_fetch_assoc($dados)) {
                    ?>
                    <tr>
                        <th><?= $coluna['id'] ?></th>
                        <td><?= $coluna['nome'] ?></td>
                        <td>R$ <?= number_format($coluna['preco'], 2, ',', '.') ?></td>
                        <td><?= $coluna['disponibilidade'] ?></td>
                        <td><?= $coluna['mercado_nome'] ?></td>
                        <td>
                            <a href="./produto.php?id=<?= $coluna['id'] ?>"><i class="fa-solid fa-pen-to-square" style="color: rgb(1, 92, 164);"></i></a>
                            <a href="./backend/produto/excluir.php?id=<?= $coluna['id'] ?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fa-solid fa-trash" style="color: rgb(255, 0, 0);"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function abrirmenu(){
    document.getElementById('sidebar').classList.toggle('show');
    document.getElementById('escurecer').classList.toggle('show');
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="./assets/script.js"></script>
</body>
</html>
