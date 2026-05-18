<?php
include'../conexao.php';
$id =$_REQUEST['id'];

$sql="DELETE FROM usuario where id='$id'";
$resultado =mysqli_query($conexao,$sql);

header('location:../../principal.php');
?>