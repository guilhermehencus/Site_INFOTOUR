<?php
session_start();
include("../Conexao_Banco/connection.php");
if (empty($_POST['nome']) or empty($_POST['email']) or empty($_POST['loca']) or empty($_POST['estado']) or empty($_POST['telefone1']) or empty($_POST['telefone2']) or empty($_POST['senha']) or empty($_POST['csenha'])) {
	header('Location: ../php_pag/cadastro.php');
	exit;
}
$nome = $_POST["nome"];
$email = $_POST["email"];
$loca = $_POST["loca"];
$estado = $_POST["estado"];
$telefone1 = $_POST["telefone1"];
$telefone2 = $_POST["telefone2"];
$senha = $_POST["senha"];
$csenha = $_POST["csenha"];
if ($senha != $csenha) {
	$_SESSION['senha_diferente_senha'] = true;
	header('Location: ../php_pag/cadastro.php');
	exit;
}
$senha = md5($senha);
$sql = "select count(*) as total from Usuario_INFOTOUR where nome = '$nome' and email= '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['total'] == 1) {
	$_SESSION['muda_nome_email'] = true;
	header('Location: ../php_pag/cadastro.php');
	exit;
}
$sql_1 = "select  B.uf, B.id_est, A.id_mun from  Estados B  join Municipios A on (B.id_est=A.id_mun_est)
 where A.nome='$loca' and B.uf='$estado' limit 1";
$result_1 = mysqli_query($conexao, $sql_1);
$resultado_1 = mysqli_fetch_assoc($result_1);
if (empty($resultado_1)) {
	$_SESSION['selecione_correto'] = true;
	header('Location: ../php_pag/cadastro.php');
} elseif (isset($resultado_1)) {
	$estado = $resultado_1['id_est'];
	$loca = $resultado_1['id_mun'];
}
if (!preg_match('^[0-9]{4}-[0-9]{4}$^', $telefone1) or !preg_match('^\([0-9]{2,3}\)[0-9]{5}-[0-9]{4}$^', $telefone2)) {  // preg_match valida se o usuário digitou corretamente o número de telefone fixo ou móvel, []= intervalo do número e {} = quantidade de caracteres, /= para lê o Parêntese //
	$_SESSION['selecione_correto_telefone'] = true;
	header('Location: ../php_pag/cadastro.php');
} else {
	$sql_2 = "INSERT INTO Usuario_INFOTOUR (nome, email, id_usu_mun, id_usu_est, telefonefix, telefonemov, senha) VALUES ('$nome', '$email', '$loca', '$estado','$telefone1', '$telefone2', '$senha')";
	if ($conexao->query($sql_2) === TRUE) {
		$sql_3 = "select id_usua, nome, email, senha from Usuario_INFOTOUR  where nome='$nome' and email='$email' and senha='$senha' limit 1";
		$result_3 = mysqli_query($conexao, $sql_3);
		$resultado_3 = mysqli_fetch_assoc($result_3);
		$id_usua = $resultado_3['id_usua'];
		$sql_4 = "INSERT INTO Foto_Usuario (foto, id_fot_usu) VALUES ('../img/habitantes.png', '$id_usua')";
		if ($conexao->query($sql_4) === TRUE) {
			$_SESSION['status_cadastro'] = true;
			$conexao->close();
			header('Location: ../php_pag/cadastro.php');
			exit;
		}
	}
}
