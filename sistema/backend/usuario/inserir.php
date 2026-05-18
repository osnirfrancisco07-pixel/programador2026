<?php 
include'../conexao.php';
//receber os dados dos nomes do frontend
$nome= $_REQUEST['nome'];
$email= $_REQUEST['email'];
$cpf= $_REQUEST['cpf'];
$senha= $_REQUEST                                                                                                                                                                                                                      ['senha'];

//inserção em sql-linguagem do banco
$sql="insert into usuario (nome,email,cpf,senha) values ('$nome','$email','$cpf','$senha')";
//executar
$resultado= mysqli_query($conexao,$sql);
//atualizar pagina
header('location:../../principal.php');

?>