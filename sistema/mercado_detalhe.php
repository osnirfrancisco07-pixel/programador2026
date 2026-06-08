<?php
include './backend/conexao.php';
include './backend/funcoes.php';

$id = $_GET['id'] ?? 0;
$dadosMercado = mysqli_query($conexao, "SELECT * FROM mercado WHERE id='$id'");
$mercado = mysqli_fetch_assoc($dadosMercado);

if (!$mercado) {
    echo "Mercado nao encontrado!";
    exit;
}

$produtos = mysqli_query($conexao, "SELECT * FROM produto WHERE mercado_id='$id' ORDER BY nome");
$fotoMercado = !empty($mercado['foto']) ? $mercado['foto'] : 'imagem/mercadinho2.png';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $mercado['nome'] ?> - Ecolote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<nav class="navbar navbar-expand-lg fundoazul">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Ecolote</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="./index.php#mercados">Mercados</a></li>
                <li class="nav-item"><a class="nav-link active" href="#produtos">Produtos</a></li>
            </ul>
            <a href="./mercado_login.php" class="btn btn-outline-light me-2">Login mercado</a>
            <a href="./login.php" class="btn btn-dark">Admin</a>
        </div>
    </div>
</nav>

<header class="mercado-banner" style="background-image: url('<?= $fotoMercado ?>');">
    <div class="container">
        <h1><?= $mercado['nome'] ?></h1>
        <p class="lead mb-0"><?= $mercado['endereco'] ?></p>
    </div>
</header>

<section class="info-band">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-3"><div class="info-pill"><i class="fa-solid fa-envelope"></i><br><?= $mercado['email'] ?></div></div>
            <div class="col-md-3"><div class="info-pill"><i class="fa-solid fa-phone"></i><br><?= $mercado['telefone'] ?></div></div>
            <div class="col-md-3"><div class="info-pill"><i class="fa-solid fa-location-dot"></i><br><?= $mercado['endereco'] ?></div></div>
            <div class="col-md-3"><div class="info-pill"><i class="fa-solid fa-id-card"></i><br><?= $mercado['cnpj'] ?></div></div>
        </div>
    </div>
</section>

<?php if (!empty($mercado['mapa'])) { ?>
    <section class="container py-4 mapa-box">
        <h2 class="mb-3">Como chegar</h2>
        <?php if (stripos($mercado['mapa'], '<iframe') !== false) { ?>
            <?= $mercado['mapa'] ?>
        <?php } else { ?>
            <a href="<?= $mercado['mapa'] ?>" class="btn btn-ecolote" target="_blank">Abrir mapa</a>
        <?php } ?>
    </section>
<?php } ?>

<main id="produtos" class="container py-5">
    <div class="mb-4">
        <h2>Produtos disponiveis</h2>
        <p class="text-muted mb-0">Converse pelo WhatsApp para confirmar disponibilidade antes de ir ao mercado.</p>
    </div>
    <div class="row g-4">
        <?php while ($produto = mysqli_fetch_assoc($produtos)) {
            $fotoProduto = !empty($produto['imagem']) ? $produto['imagem'] : 'imagem/mercadinho2.png';
            $mensagem = urlencode("Ola, gostaria de saber se o produto " . $produto['nome'] . " esta disponivel.");
            $whatsapp = 'https://wa.me/' . telefone_whatsapp($mercado['telefone']) . '?text=' . $mensagem;
            $produtoId = $produto['id'];
            $receitas = mysqli_query($conexao, "SELECT receita.* FROM receita INNER JOIN produto_receita ON receita.id=produto_receita.receita_id WHERE produto_receita.produto_id='$produtoId' ORDER BY receita.nome");
            ?>
            <div class="col-12 col-md-6 col-lg-4 d-flex">
                <div class="card public-card w-100">
                    <img src="<?= $fotoProduto ?>" class="card-img-top" alt="<?= $produto['nome'] ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between gap-3">
                            <h5 class="card-title mb-0"><?= $produto['nome'] ?></h5>
                            <span class="fw-bold text-nowrap">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>
                        </div>
                        <span class="badge text-bg-<?= $produto['disponibilidade'] == 'ativo' ? 'success' : 'secondary' ?> align-self-start"><?= $produto['disponibilidade'] ?></span>

                        <?php if (mysqli_num_rows($receitas) > 0) { ?>
                            <div class="recipe-list">
                                <strong>Receitas com este produto</strong>
                                <?php while ($receita = mysqli_fetch_assoc($receitas)) { ?>
                                    <div class="d-flex gap-2 align-items-center mt-2">
                                        <?php if (!empty($receita['foto'])) { ?>
                                            <img src="<?= $receita['foto'] ?>" alt="<?= $receita['nome'] ?>">
                                        <?php } ?>
                                        <div>
                                            <div class="fw-semibold"><?= $receita['nome'] ?></div>
                                            <small class="text-muted"><?= $receita['descricao'] ?></small>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <a href="<?= $whatsapp ?>" target="_blank" class="btn btn-ecolote mt-auto"><i class="fa-brands fa-whatsapp"></i> Perguntar no WhatsApp</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>

<footer class="footer-public">
    <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
        <span><?= $mercado['nome'] ?> no Ecolote.</span>
        <span>Confirme valores e disponibilidade pelo WhatsApp.</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
