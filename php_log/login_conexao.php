<?php
session_start();
include("../Conexao_Banco/connection.php");
if (empty($_POST['nome']) or empty($_POST['email']) or empty($_POST['senha'])) {
header('Location: ../php_pag/loginForm.php');
exit;
}
if (empty($_POST['nome']) and empty($_POST['email']) and empty($_POST['senha'])) {
header('Location: ../php_pag/loginForm.php');
exit;
}
$nome= filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$senha = md5($_POST['senha']);
$email=$_POST["email"];
$sql = "select id_usua, nome, email, senha from Usuario_INFOTOUR  where nome='$nome' and email='$email' and senha='$senha' limit 1";
$result = mysqli_query($conexao, $sql);
$resultado=mysqli_fetch_assoc($result);	
if (empty($resultado)) {
	$_SESSION['secadastrar'] = true;
	header('Location: ../php_pag/loginForm.php');
}
elseif (isset($resultado)) {
	 $_SESSION['id']= $resultado['id_usua'];
	 $_SESSION['usuarioNome'] = $resultado['nome'];
	 $_SESSION['usuarioSenha'] = $resultado['senha'];
	header('Location:../php_pag/index1.php'); 
	}
