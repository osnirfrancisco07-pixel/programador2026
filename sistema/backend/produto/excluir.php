<?php
include'../conexao.php';
$id=$_REQUEST['id'];

$sql="DELETE FROM produto where id='$id'";
$resultado =mysqli_query($conexao,$sql);

header('location:../../produto.php');
?>