<?php
session_start();
include("../Conexao_Banco/connection.php");
if (empty($_POST["idfav"]) and empty($_POST["linkfav"]) and isset($_GET["id"])) {
$idfav= $_GET["id"];
$result_e="delete from Favorito_Usuario where id_favusua='$idfav' ";
$resultado_e=mysqli_query($conexao ,$result_e);
if ($resultado_e==true) {
$_SESSION['excluirf'] = true;
header('Location: ../php_pag/perfil.php');
exit;
}
else
{
echo mysqli_error();
exit;
}
}
elseif (isset($_POST["idfav"]) and isset($_POST["linkfav"]) and empty($_GET["id"])) {
$idfav= $_POST["idfav"];
$link= $_POST["linkfav"];
$result_e="delete from Favorito_Usuario where id_fav_usu='$idfav' and link='$link'";
$resultado_e=mysqli_query($conexao ,$result_e);
if ($resultado_e==true) {
$_SESSION['excluir'] = true;
header('Location: ../php_pag/CidadeFz.php');
exit;
}
else
{
echo mysqli_error();
exit;
}
}
else {
echo mysqli_error();	
}
