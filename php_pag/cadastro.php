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
	if (isset($_SESSION['senha_diferente_senha'])) :
	?>
		<div class="errado">
			<p> A senha que digitou está diferente que você tinha confirmado </p>
		</div>
	<?php
	endif;
	unset($_SESSION['senha_diferente_senha']);
	?>
	<?php
	if (isset($_SESSION['muda_nome_email'])) :
	?>
		<div class="errado">
			<p> Desculpa, o usuário específico já se cadastrou nessa plataforma </p>
		</div>
	<?php
	endif;
	unset($_SESSION['muda_nome_email']);
	?>
	<?php
	if (isset($_SESSION['selecione_correto'])) :
	?>
		<div class="errado">
			<p> Escreve e selecione corretamente o município e o seu estado pertencente </p>
		</div>
	<?php
	endif;
	unset($_SESSION['selecione_correto']);
	?>
	<?php
	if (isset($_SESSION['selecione_correto_telefone'])) :
	?>
		<div class="errado">
			<p> Digite corretamente o número de telefone </p>
		</div>
	<?php
	endif;
	unset($_SESSION['selecione_correto_telefone']);
	?>
	<?php
	if (isset($_SESSION['status_cadastro'])) :
	?>
		<div class="correto">
			<p> Parabéns, cadastro com sucesso </p>
		</div>
	<?php
	endif;
	unset($_SESSION['status_cadastro']);
	?>
	<div>
		<h1> Cadastre-se para receber mais informações </h1>
		<center>
			<form method="post" action="../php_log/cadastrar.php">
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
						<th>Cidade*</th>
						<td><input type="post" placeholder="exemplo: Cajamar" name="loca" autocomplete="off" required></td>
					</tr>
					<tr>
						<th> Estado onde mora* </th>
						<td><select name="estado">
								<option value="AC"> Acre </option>
								<option value="AL"> Alagoas </option>
								<option value="AP"> Amazonas </option>
								<option value="AP"> Amapá </option>
								<option value="AM"> Amazonas </option>
								<option value="BA"> Bahia </option>
								<option value="CE"> Ceará </option>
								<option value="DF"> Distrito Federal </option>
								<option value="ES"> Espírito Santo </option>
								<option value="GO"> Goiás </option>
								<option value="MA"> Maranhão </option>
								<option value="MT"> Mato Grosso </option>
								<option value="MS"> Mato Grosso do Sul </option>
								<option value="MG"> Minas Gerais </option>
								<option value="PA"> Pará </option>
								<option value="PB"> Paraíba </option>
								<option value="PR"> Paraná </option>
								<option value="PE"> Pernambuco </option>
								<option value="PI"> Piauí </option>
								<option value="RJ"> Rio de Janeiro </option>
								<option value="RN"> Rio Grande do Norte </option>
								<option value="RS"> Rio Grande do Sul </option>
								<option value="RO"> Rondônia </option>
								<option value="RR"> Roraima </option>
								<option value="SP"> São Paulo </option>
								<option value="SE"> Sergipe </option>
								<option value="TO"> Tocantins </option>
							</select>

					</tr>
					<tr>
						<th>Telefone(s)*</th>
						<td>
							<input class="tele" type="post" placeholder="ex: 4022-8922" name="telefone1" autocomplete="off" required>
							<input class="tele" type="post" placeholder="ex: (12)98764-3210" name="telefone2" autocomplete="off" required>
						</td>
					</tr>
					<tr>
						<th>Senha*</th>
						<td><input type="password" placeholder="Senha" name="senha" required></td>
					</tr>
					<tr>
						<th>Confirmação da Senha*</th>
						<td><input type="password" placeholder="Confirmar senha" name="csenha" required></td>
					</tr>

				</table>
		</center>
		<input class="botao" type="submit" name="botao" value="Cadastrar">
		</form>
		<a href="loginForm.php"> <input class="botao" type="submit" name="botao" value="Entrar"> </a>
	</div>
</body>
<html>