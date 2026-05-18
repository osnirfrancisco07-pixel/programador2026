<?php
    //conectar com banco
    include './conexao.php';

    //receber o email e senha do front-end por requisição
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];

    //SQL que busca no banco um usuário com email e senha especifica
    $sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha' ";
    //executar SQL
    $resultado = mysqli_query($conexao, $sql);
    //pegar valores das colunas do banco
    $colunas = mysqli_fetch_assoc($resultado);


    //imprimir o encontrado
    echo $colunas['nome'];

    //SE O NUMERO DE LINHAS FOR MAIOR QUE ZERO BUSCADOS,PODE LOGAR
    if(mysqli_num_rows($resultado)>0){
        session_start();

        //variveis de sessão
        $_SESSION['usuario'] = $colunas['nome'];
        $_SESSION['email'] = $colunas['email'];
        $_SESSION['senha'] = $colunas['senha'];

        HEADER('LOCATION:../PRINCIPAL.PHP');
    }ELSE{
        //MANTEM A PESSOA NOMLOGIN CASO ERRAR
        HEADER('LOCATION:../LOGIN.PHP');
    }
?>