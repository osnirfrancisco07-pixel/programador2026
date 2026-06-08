<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do mercado - Ecolote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="assets/particle.css">
    <link rel="stylesheet" href="assets/estilo.css">
</head>
<body class="corpologin">
<div class="row justify-content-center align-items-center vh-100 painel">
    <div class="col-12 col-sm-10 col-md-6 col-lg-4 card shadow p-4 telalogin">
        <div class="text-center">
            <i class="fa-solid fa-store" style="color:rgb(116,192,252);font-size: 76px;"></i>
            <h3 class="mt-3">Login do mercado</h3>
            <?php if (!empty($_GET['erro'])) { ?>
                <div class="alert alert-danger py-2">Email ou senha invalidos.</div>
            <?php } ?>
        </div>
        <form action="./backend/mercado/logar.php" method="post">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
            <a href="./login.php" class="btn btn-outline-primary">Admin</a>
        </form>
    </div>
</div>
<div id="particles-js"></div>
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="./assets/particle.js"></script>
</body>
</html>
