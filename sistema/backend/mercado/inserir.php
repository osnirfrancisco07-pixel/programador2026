<?php 
include'../conexao.php';
//receber os dados dos nomes do frontend
$nome= $_REQUEST['nome'];
$email= $_REQUEST['email'];
$cnpj= $_REQUEST['cnpj'];
$senha= $_REQUEST['senha'];
$endereco= $_REQUEST['endereco'];
$telefone= $_REQUEST['telefone'];
$foto= $_REQUEST['foto'];
$mapa= $_REQUEST['mapa'];                                                                                                                                                                                                             ['senha'];

//inserção em sql-linguagem do banco
$sql="insert into mercado (nome,email,cnpj,senha,endereco,telefone,foto,mapa) values ('$nome','$email','$cnpj','$senha','$endereco','$telefone','$foto','$mapa')";
//executar
$resultado= mysqli_query($conexao,$sql);
//atualizar pagina
header('location:../../mercado.php');

?>