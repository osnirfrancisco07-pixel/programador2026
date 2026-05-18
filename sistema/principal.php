<?php
include'./backend/conexao.php';
include'./backend/validacao.php';
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecolote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet"  href="./assets/estilo.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
</head>
  <body>
    <nav class="navbar navbar-dark navbar-expand-lg corbarra">
  <div class="container-fluid">
    

    <button onclick="abrirmenu()" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"><img src="https://tse1.mm.bing.net/th/id/OIP.2zL9a_D686bt7rQ-ggmvngHaHa?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo React" width="59">Ecolote</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">público</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            menu
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

 
<div id="escurecer" class="escurecer" onclick="abrirmenu()"></div>
 <div class="container-fluid">
  <div class="row">
  <div class="col-md-2 bg-dark">
<aside id="sidebar" class="sidebar p-3 text-white bg-dark">
   <h4> Meu painel </h4>
   <h5>Bem-vindo(a)<?php echo $_SESSION['usuario']?></h5>
     <ul class="nav flex-column">

        <li class="nav-item"> 
            <a class="nav-link" href="#"><i class="fa-regular fa-user"></i>Usuários</a>

        </li>
 <li class="nav-item"> 
            <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i>
Mercados</a>

        </li>

         <li class="nav-item"> 
            <a class="nav-link" href="#"><i class="fas fa-box"></i>Produtos</a>

        </li>

     </ul>

     </aside>
  </div>
  <div class="col-md-5">
    <h3>Cadastro</h3>

<form action ="./backend/usuario/inserir.php" method="post" class="p-3">                                                                                                                                                                                                                                                                                                                         
  <div class="mb-3">
    <label  class="form-text"><i class="fas fa-user"></i>    Nome</label>
    <input type="text" name="nome" class="form-control" >
    
  </div>
  <div class="mb-3">
    <label  class="form-label"><i class="fas fa-id-card"></i> CPF</label>
    <input type="text"
    lass="form-control">

  </div>
<div class="mb-3">
    <label  class="form-label"><i class="fa-regular fa-envelope"></i>Email</label>
    <input type="email" name="email" class="form-control">
  </div>

  <div class="mb-3">
    <label  class="form-label"><i class="fa-regular fa-envelope"></i>senha</label>
    <input type="senha" name="senha" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">cadastrar</button>
  <button type="reset" class="btn btn-primary">limpar</button>
</form>
  </div>
<div class="col-md-5">

 <table class="table" id="tabela">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"><i class="fas fa-user"></i>    Nome</th>
      <th scope="col"><i class="fa-regular fa-envelope"></i>Email</th>
      <th scope="col">Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql ='select * from usuario';
    $dados =mysqli_query($conexao,$sql);
    //percorrer todos os registros banco
    while($coluna =mysqli_fetch_assoc($dados)){
    ?>
    <tr>
      <th scope="row"> <?php echo $coluna['id'] ?></th>
      <td><?php echo $coluna['nome'] ?></td>
      <td><?php echo $coluna['email']?></td>
      <td><a href=""><i class="fa-solid fa-pen"></i></a> 
      <a href="<?php echo './backend/usuario/excluir.php?id='.$coluna['id']?>" onclick="return confirm('Deseja realmente excluir?')" ><i class="fa-solid fa-trash-can" style="color: rgb(177, 9, 9);"></i></a></td>
    
    </tr> 
    <?php }?>
  </tbody>
</table>

  </div>

 </div>

 
<script>
     function abrirmenu(){
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('escurecer').classList.toggle('show')
       }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="./assets/script.js"></script>
  </body>
</html>