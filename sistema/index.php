<?php
include './backend/conexao.php';

@mysqli_query($conexao, "UPDATE visualizacao SET total = total + 1 WHERE pagina='index'");
if (mysqli_affected_rows($conexao) == 0) {
    @mysqli_query($conexao, "INSERT INTO visualizacao(pagina, total) VALUES ('index', 1)");
}

$mercados = mysqli_query($conexao, "SELECT * FROM mercado ORDER BY nome");
$totalMercados = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM mercado"))['total'] ?? 0;
$totalProdutos = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM produto WHERE disponibilidade='ativo'"))['total'] ?? 0;
$visualizacoes = 0;
$dadosVisitas = @mysqli_query($conexao, "SELECT total FROM visualizacao WHERE pagina='index'");
if ($dadosVisitas) {
    $visualizacoes = mysqli_fetch_assoc($dadosVisitas)['total'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecolote</title>
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
                <li class="nav-item"><a class="nav-link active" href="#mercados">Mercados</a></li>
                <li class="nav-item"><a class="nav-link active" href="#sobre">Produtos</a></li>
                <li class="nav-item"><a class="nav-link active" href="#mercados">Receitas</a></li>
            </ul>
            <a href="./mercado_login.php" class="btn btn-outline-light me-2">Login mercado</a>
            <a href="./login.php" class="btn btn-dark">Admin</a>
        </div>
    </div>
</nav>

<div id="carouselExample" class="carousel slide hero-carousel" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="imagem/1779909443_346b3f2a__imagem2.png" class="d-block w-100" alt="Produtos com economia">
        </div>
        <div class="carousel-item">
            <img src="imagem/1779909435_197d16b4__imagem1.png" class="d-block w-100" alt="Mercado parceiro">
        </div>
        <div class="carousel-item">
            <img src="imagem/1779910131_b7d13cfb__imagem3.png" class="d-block w-100" alt="Compras acessiveis">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Proximo</span>
    </button>
</div>

<div class="container stats-bar">
    <div class="row g-3">
        <div class="col-md-4"><div class="stat-item"><strong><?= $visualizacoes ?></strong>visualizacoes na plataforma</div></div>
        <div class="col-md-4"><div class="stat-item"><strong><?= $totalMercados ?></strong>mercados parceiros</div></div>
        <div class="col-md-4"><div class="stat-item"><strong><?= $totalProdutos ?></strong>produtos ativos</div></div>
    </div>
</div>

<section id="sobre" class="section-roxa mt-5">
    <div class="container text-center">
        <h2 class="mb-3">Bem-vindos ao Ecolote</h2>
        <p class="lead mb-0">Encontre mercados com produtos a precos acessiveis, economize dinheiro e ajude a evitar desperdicio.</p>
    </div>
</section>

<main id="mercados" class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="mb-1">Mercados cadastrados</h2>
            <p class="text-muted mb-0">Escolha um mercado para ver produtos, receitas e contato direto.</p>
        </div>
    </div>
    <div class="row g-4">
        <?php while ($mercado = mysqli_fetch_assoc($mercados)) {
            $foto = !empty($mercado['foto']) ? $mercado['foto'] : 'imagem/mercadinho2.png';
            ?>
            <div class="col-12 col-sm-6 col-lg-3 d-flex">
                <div class="card public-card w-100">
                    <img src="<?= $foto ?>" class="card-img-top" alt="<?= $mercado['nome'] ?>">
                    <div class="card-body">
                        <h5 class="card-title mb-0"><?= $mercado['nome'] ?></h5>
                        <p class="card-text text-muted mb-0"><i class="fa-solid fa-location-dot"></i> <?= $mercado['endereco'] ?></p>
                        <p class="small text-muted mb-2"><i class="fa-solid fa-phone"></i> <?= $mercado['telefone'] ?></p>
                        <a href="mercado_detalhe.php?id=<?= $mercado['id'] ?>" class="btn btn-ecolote mt-auto">Acessar mercado</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>

<footer class="footer-public">
    <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
        <span>Ecolote - economia local e menos desperdicio.</span>
        <span>Mercados, produtos e receitas em um so lugar.</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
