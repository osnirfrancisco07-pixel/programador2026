<?php
include'../conexao.php';
$id =$_REQUEST['id'];

$sql="DELETE FROM mercado where id='$id'";
$resultado =mysqli_query($conexao,$sql);

header('location:../../mercado.php');
?>