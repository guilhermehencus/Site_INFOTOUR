<?php
session_start();
include("../Conexao_Banco/connection.php");
$idcom= $_GET["id"];
$result_e="delete from Comentar_Local where id_com='$idcom' ";
$resultado_e=mysqli_query($conexao ,$result_e);
if ($resultado_e==true) {
$_SESSION['excluirc'] = true;
header('Location: ../php_pag/perfil.php');
exit;
}
else
{
echo mysqli_error();
exit;
}
