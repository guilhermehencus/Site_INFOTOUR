<!DOCTYPE html>
<?php
session_start();
?>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="imagem/png" href="logov.png" />
	<link rel="stylesheet" type="text/css" href="../css/index.css" />
	<link rel="stylesheet" type="text/css" href="../css/teste.css" />
	<title> InfoTour </title>
	<style>
		#foto_perfil {
			width: 6%;
			float: right;
			margin: 0 0.5% 0 0;
		}

		#foto_perfil img {
			width: 100%;
			height: 100%;
			border: 2px solid black;
			border-radius: 50px;
		}

		#foto_perfil a {
			height: 70px;
			width: 100%;
			border-radius: 50px;
		}
	</style>

<body>
	<nav class="menu">
		<ul>
			<li>
				<a href="plataforma.php">
					<p>A plataforma</p>
				</a>
			</li>
			<li>
				<div class="submenu">
				</div>
			</li>
			<li>
				<a name="criadores" href="criadores.php">
					<p>Os criadores</p>
				</a>
				<!--esse tem onclick="funcao1()"-->
			</li>
			<li>
				<div class="submenu">
				</div>
			</li>
			<li>
				<a name="busca" href="BuscarRegiao.php">
					<p>Buscar região</p>
				</a>
				<!--esse tem onclick="funcao1()"-->
			</li>
			<li>
				<div class="submenu">
				</div>
			</li>
			<li>
				<a href="index1.php">
					<p>InfoTour</p>
				</a>
				<!--esse tem class="info"-->
			</li>
			<?php
			include("../Conexao_Banco/connection.php");
			if (isset($_SESSION['id'])) { ?>
				<?php
				$id = $_SESSION['id'];
				include("../Conexao_Banco/connection.php");
				$sql = mysqli_query($conexao, "select B.foto from Usuario_INFOTOUR A join Foto_Usuario B on (A.id_usua=B.id_fot_usu) where B.id_fot_usu='$id'");
				while ($imagem = mysqli_fetch_object($sql)) {
					echo " <li id='foto_perfil'> <a href='perfil.php'> <img  src='../img/" . $imagem->foto . "' width='81'/> </a>  </li>  ";
				}
				?>
			<?php } else { ?>
				<li id="cadastrar">
					<a href="loginForm.php">
						<p>Cadastre-se</p>
					</a>
				</li>
			<?php }  ?>
		</ul>
	</nav><br>
	<div class="preto" id="sn">
		<div class="g" id="let">
			<img src="../img/fotoSite1.jpg" alt="Avatar" class="foto">
			<p id="cria"> Matheus dos Santos Silva </p><br><br><br><br>
			<p class="lo"> Eu sou o Matheus, tenho 17 anos
				e estudo na Etec Anhanguera, fui um dos responsáveis
				por maior parte</p>
			<p class="lo"> da criação desta plataforma, visando principalmente
				o design do site. No ano de 2019 fiz outro projeto</p>
			<p class="lo">na Etec Bartolomeu Bueno da Silva, participando da Feira Tecnológica. Nesse ano
				abordei temas mais sérios para a realização do projeto, acredito que o turismo foi uma ótima
				escolha e que poderemos aju-</p>
			<p class="lo">-dar diversas pessoas.</p>
		</div>
	</div><br><br><br>
	<div class="preto">
		<div>
			<img src="../img/fotoSite2.jpg" alt="Guilherme" class="foto1">
			<p id="cria1"> Guilherme Henrique Guimarães Custódio </p><br><br><br><br><br>
			<p class="lo1"> 17 anos, estudante da última série do curso Informática para Internet na ETEC Bartolomeu Bueno da Silva, principal responsável pelo desenvolvimento escrito do projeto, bem como a parte Back-end do site. Além desse projeto, participou de um outro projeto na Feira Tecnológica de 2019 ocorrida no mesmo instituto de ensino.
			</p>
		</div>
	</div><br><br><br>
	<div class="preto">
		<img src="../img/fotoSite3.jpg" alt="Avatar" class="foto">
		<p id="cria"> Augusto Souza Santos </p><br><br><br><br>
		<p class="lo">17 anos, estudante do 3° ano do ensino médio integrado ao técnico na ETEC Bartolomeu Bueno da Silva, responsável por aperfeiçoar o front-end do site.</p>
	</div>