<?php
session_start();
?>
<?php
include("../Conexao_Banco/connection.php");
?>
<html>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="imagem/png" href="css/img/logod.png" />
	<link rel="stylesheet" type="text/css" href="../css/csscadastro.css" />
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<title> Info Tour </title>
</head>

<body>
	<?php
	if (isset($_SESSION['secadastrar'])) :
	?>
		<div class="errado">
			<p> Não achou o seu perfil, veja se não esqueceu nada ou aproveita e se cadastra </p>
		</div>
	<?php
	endif;
	unset($_SESSION['secadastrar']);
	if (isset($_SESSION['secadastre'])) :
	?>
		<div class="errado">
			<p> Para ter acesso ao recurso precisará se logar pela plataforma </p>
		</div>
	<?php
	endif;
	unset($_SESSION['secadastre']);
	?>
	<div>
		<h1> Entre para acessar as informações </h1>
		<center>
			<form method="post" action="../php_log/login_conexao.php">
				<table>
					<tr>
						<th>Nome*</th>
						<td><input type="post" placeholder="Seu nome" name="nome" autocomplete="off" required></td>
					</tr>
					<tr>
						<th>Email*</th>
						<td><input type="post" placeholder="nobody@mail.com " name="email" autocomplete="off" required></td>
					</tr>
					<tr>
						<th>Senha*</th>
						<td><input type="password" placeholder="Senha" name="senha" required></td>
					</tr>


				</table>
		</center>
		<input class="botao" type="submit" name="botao" value="Logar">
		</form>
		<a href="cadastro.php"> <input class="botao" type="submit" name="botao" value="Cadastre-se"> </a> <br>
		<input onclick="history.go(-1);" class="botao" type="submit" name="volt" value="Voltar">
	</div>
</body>

</html>