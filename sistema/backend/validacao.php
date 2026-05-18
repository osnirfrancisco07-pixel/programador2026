<?PHP
//INICIAR SESSÃO
session_start();
ECHO $_SESSION["email"];
ECHO $_SESSION["senha"];

//se não existir a variavel de sessao cpf e senha
if(!isset($_SESSION["email"]) or !isset($_SESSION["senha"])){
    //destruir sessão anterior
    session_destroy();

    //limpar variaveis de sessão
    unset($_session['email']);
    unset($_session['senha']); 
     //manda login
 header('location:../sistema/login.php');
}


?>