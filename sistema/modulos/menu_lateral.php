<aside id="sidebar" class="sidebar p-3 text-white bg-dark">
   <h4> Meu painel </h4>
   <h5>Bem-vindo(a)<?php echo $_SESSION['usuario']?></h5>
     <ul class="nav flex-column">

        <li class="nav-item"> 
            <a class="nav-link" href="./principal.php"><i class="fa-regular fa-user"></i>Usuários</a>

        </li>
 <li class="nav-item"> 
            <a class="nav-link" href="./mercado.php"><i class="fas fa-shopping-cart"></i>
Mercados</a>

        </li>

         <li class="nav-item"> 
            <a class="nav-link" href="./produto.php"><i class="fas fa-box"></i>Produtos</a>

        </li>

     </ul>

     </aside>