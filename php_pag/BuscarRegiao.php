<!DOCTYPE html>
<?php
session_start();
?>
<!--cid10-->
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="imagem/png" href="logov.png" />
	<link rel="stylesheet" type="text/css" href="../css/index.css" />
	<link rel="stylesheet" type="text/css" href="../css/buscar.css" />

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
</head>

<body>
	<nav class="menu">
		<ul>
			<li>
				<a href="plataforma.php">
					<p>A plataforma</p>
				</a>
			</li>
			<li>
				<div class="divisoria">
				</div>
			</li>
			<li>
				<a name="criadores" href="criadores.php">
					<p>Os criadores</p>
				</a>
			</li>
			<li>
				<div class="divisoria">
				</div>
			</li>
			<li>
				<a name="busca" href="BuscarRegiao.php">
					<p>Buscar região</p>
				</a>
			</li>
			<li>
				<div class="divisoria">
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
					echo " <li id='foto_perfil'><a href='perfil.php'><img  src='../img/" . $imagem->foto . "'></a>  </li>  ";
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
		<!--<div id="divNav">
		</div>-->
	</nav>
	<div class="Tudomesmo">
		<div class="divTudo">
			<div class="divC1">
				<?php
				if (isset($_SESSION['nao_registrado_local'])) :
				?>
					<div class="errado">
						<p> Infelizmente esse local não está na nossa plataforma, adicionaremos futuramente </p>
					</div>
				<?php
				endif;
				unset($_SESSION['nao_registrado_local']);
				?>


				<center>
					<h3 class="cid10"> Buscar Local </h3><Br><br><br>
				</center>
				<div id="buscregi">
					<form method="POST" autocomplete="off" action="">
						<input type='text' name='pesquisar' id="pesquisar" class='barrapes' placeholder='  Pesquisar'></input>
					</form>
					<ul class="resultado">

					</ul>
					<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
					<script type="text/javascript">
						$(function() {
							$("#pesquisar").keyup(function() {
								var pesquisar = $(this).val();
								if (pesquisar != '') {
									var dados = {
										pq: pesquisar
									}
									$.post('../php_log/verificar_busca.php', dados, function(retorna) {
										$(".resultado").html(retorna);
									});
								} else {
									$(".resultado").html('');

								}
							});
						});
					</script>

					</ul>

				</div>

			</div>
		</div>
	</div>

</body>

</html>