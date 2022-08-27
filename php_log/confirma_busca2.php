<?php
session_start();
include("../Conexao_Banco/connection.php");
$id_mun=$_GET['id'];
$sql_busc="select B.id_lin_mun, B.nome_link from Municipios A join Link_Local B on (A.id_mun=B.id_lin_mun) where id_lin_mun='$id_mun'";
$result_busc = mysqli_query($conexao, $sql_busc);
$resultado_busc=mysqli_fetch_assoc($result_busc);	
if (empty($resultado_busc)) {
	$_SESSION['nao_registrado_local_b'] = true;
	header('Location:../php_pag/cidadeFz.php');
}
elseif (isset($resultado_busc)) {
	$link= $resultado_busc['nome_link'];
	header('Location:'.$link); 
	}
