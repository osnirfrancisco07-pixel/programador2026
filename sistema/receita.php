<?php
include './backend/conexao.php';
include './backend/validacao.php';

$destino = './backend/receita/inserir.php';
$receita = null;

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $dados = mysqli_query($conexao, "SELECT * FROM receita WHERE id='$id'");
    $receita = mysqli_fetch_assoc($dados);
    $destino = './backend/receita/alterar.php';
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receitas - Ecolote</title>
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
                <h3><i class="fa-solid fa-utensils"></i> Receita</h3>
                <input value="<?= $receita['id'] ?? '' ?>" type="hidden" name="id">
                <input value="<?= $receita['foto'] ?? '' ?>" type="hidden" name="foto_atual">
                <div class="mb-3">
                    <label class="form-label">Nome da receita</label>
                    <input value="<?= $receita['nome'] ?? '' ?>" type="text" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <?php if (!empty($receita['foto'])) { ?>
                        <img src="<?= $receita['foto'] ?>" class="img-preview mt-2" alt="Foto da receita">
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descricao</label>
                    <textarea name="descricao" class="form-control" rows="6"><?= $receita['descricao'] ?? '' ?></textarea>
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
                    <th>Foto</th>
                    <th>Opcoes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $dados = mysqli_query($conexao, 'SELECT * FROM receita ORDER BY nome');
                while ($coluna = mysqli_fetch_assoc($dados)) {
                    ?>
                    <tr>
                        <th><?= $coluna['id'] ?></th>
                        <td><?= $coluna['nome'] ?></td>
                        <td>
                            <?php if (!empty($coluna['foto'])) { ?>
                                <img src="<?= $coluna['foto'] ?>" class="thumb-table" alt="Receita">
                            <?php } ?>
                        </td>
                        <td>
                            <a href="./receita.php?id=<?= $coluna['id'] ?>"><i class="fa-solid fa-pen-to-square" style="color: rgb(1, 92, 164);"></i></a>
                            <a href="./backend/receita/excluir.php?id=<?= $coluna['id'] ?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fa-solid fa-trash" style="color: rgb(255, 0, 0);"></i></a>
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
