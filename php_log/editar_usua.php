<?php
session_start();
include("../Conexao_Banco/connection.php");
if (!isset($_POST["id"]) and !isset($_POST["nome"]) and !isset($_POST["email"]) and !isset($_POST["senha"])) {
	header('Location: ../php_pag/perfil.php');
	exit;
}
$id = $_POST["id"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = md5($_POST["senha"]);
$sql = "select count(*) as 'total' from Usuario_INFOTOUR where nome = '$nome' and email= '$email' and senha='$senha'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['total'] == 1) {
	$_SESSION['nao_alterado'] = true;
	header('Location: ../php_pag/perfil.php');
	exit;
}
$result_usuario = "update Usuario_INFOTOUR set nome='$nome'  where id_usua='$id'";
$resultado_usuario = mysqli_query($conexao, $result_usuario);
if ($resultado_usuario == true) {
	$result_usuario_2 = "update Usuario_INFOTOUR set email='$email' where id_usua='$id'";
	$resultado_usuario_2 = mysqli_query($conexao, $result_usuario_2);
	if ($resultado_usuario_2 == true) {
		$result_usuario_3 = "update Usuario_INFOTOUR set senha='$senha' where id_usua='$id'";
		$resultado_usuario_3 = mysqli_query($conexao, $result_usuario_3);
		if ($resultado_usuario_3 == true) {
			$_SESSION['alterado'] = true;
			header('Location: ../php_pag/perfil.php');
			exit;
		}
	}
} else {
	$_SESSION['nao_alterado'] = true;
	header('Location: ../php_pag/perfil.php');
	exit;
}
