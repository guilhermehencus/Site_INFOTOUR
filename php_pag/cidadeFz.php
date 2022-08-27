<!DOCTYPE html>
<?php
session_start();
?>
<!--icone-->
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="imagem/png" href="logov.png" />
	<link rel="stylesheet" type="text/css" href="../css/index.css" />
	<link rel="stylesheet" type="text/css" href="../css/index5.css" />
	<link rel="stylesheet" type="text/css" href="../css/buscar.css" />
	<link rel="stylesheet" type="text/css" href="../css/buscarms.css" />
	<title> InfoTour </title>
	<style media="screen">
		.divTudo {
			float: left;
			margin: 0% 15%;
			width: 70%;
			height: 2100px;
			background: #131313;
		}

		#caj {
			transform: translateY(2in);
		}

		#caj1 {
			transform: translateY(2in);
		}

		.div15icon {
			width: 84px;
			height: 84px;
		}

		.div15 {
			color: white;
			float: left;
			width: 100%;
			height: 31%;
			margin: 3% 0;
			background: #131313;
			border-radius: 50px;
		}

		.google {
			margin-top: 10px;
		}

		#cidade,
		#qa,
		#clima,
		#temperatura {
			font-size: 30px;
			font-family: 'century gothic';
			color: #00334d;
		}

		#foto_perfil {
			width: 5.5%;
			float: right;
			margin: 0 0.5% 0 0;
			margin-top: -15px;
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
				<a onclick="funcao1()" name="criadores" href="criadores.php">
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
				<!--esse tem onclick="funcao1()"-->
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
					echo " <br>&nbsp;&nbsp;<li id='foto_perfil'><a href='perfil.php'> <img  src='../img/" . $imagem->foto . "' width='90' height='70' style='border-radius:20px;'/> </a>  </li>  ";
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
		<?php
		if (isset($_SESSION['nao_registrado_local_b'])) :
		?>
			<div class="errado">
				<p> O local não está na nossa plataforma, adicionaremos futuramente </p>
			</div>
		<?php
		endif;
		unset($_SESSION['nao_registrado_local_b']);
		?>
		<?php
		if (isset($_SESSION['excluir'])) :
		?>
			<div class="errado">
				<p> Você tirou o local como favorito </p>
			</div>
		<?php
		endif;
		unset($_SESSION['excluir']);
		?>
		<?php
		if (isset($_SESSION['adicionado'])) :
		?>
			<div class="certo">
				<p> Favoritado com sucesso, olha no perfil </p>
			</div>
		<?php
		endif;
		unset($_SESSION['adicionado']);
		?>
		<?php
		if (isset($_SESSION['comentado'])) :
		?>
			<div class="certo">
				<p> Seu cometário foi adicionado com sucesso </p>
			</div>
		<?php
		endif;
		unset($_SESSION['comentado']);
		?>
	</nav>
	<div id="div14">
		<div class="div15">
			<img class="nuvem div15icon" src="../img/nuvem1.png" alt="nuvem">
			<!--id="nuve"-->
		</div>
		<div class="div15">
			<img class="esta div15icon" src="../img/estatisticas.png" alt="estatisticas">
		</div>
		<div class="div15">
			<img class="data1 div15icon" src="../img/data.png" alt="eventos">
		</div>
		<div>
			<?php
			include("../Conexao_Banco/connection.php");
			if (empty($_SESSION['id'])) { ?>
				<form method="post" action="../php_log/vaicadastrar.php">
					<input type="submit" value=" Favoritar &#10025;">
				</form>
				<?php } else {
				include("../Conexao_Banco/connection.php");
				$idfav = $_SESSION['id'];
				$linkfav = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$sql_2 = mysqli_query($conexao, "select B.id_favusua from Usuario_INFOTOUR A join Favorito_Usuario B on (A.id_usua=B.id_fav_usu) where B.id_fav_usu='$id' and B.nome='Cajamar' ");
				$resultado_2 = mysqli_fetch_assoc($sql_2);
				if (empty($resultado_2)) {
				?>
					<form method="POST" action="../php_log/adfavorito.php">
						<?php

						echo "<input type='hidden' name='idfav' value=" . $idfav . ">";
						echo "<input type='hidden' name='nome_fav' value='Cajamar'>";
						echo "<input type='hidden' name='linkfav' value=" . $linkfav . ">";
						?>
						<input type="submit" id="favorito" value=" Favoritar &#10025;">
					</form>
				<?php } else { ?>
					<form method="post" action="../php_log/exfavorito.php">
						<input type='hidden' name='idfav' value="<?php echo $idfav ?>">
						<input type='hidden' name='linkfav' value="<?php echo $linkfav ?>">
						<input type="submit" value=" Favoritado &#10025;" class="fav">
					</form>
				<?php } ?>
			<?php } ?>
		</div>
		<div>
			<?php
			include("../Conexao_Banco/connection.php");
			if (empty($_SESSION['id'])) { ?>
				<form method="post" action="../php_log/vaicadastrar.php">
					<button id="coment1" class="coment"> Comentar </button>
				</form>
			<?php } else { ?>
				<button id="coment1" class="coment"> Comentar </button>

			<?php } ?>
		</div>

	</div>
	<div class="divTudo">
		<div id="centro">
			<div id="cajesc">
				<h1 id="caj"> <?php echo $c = "Cajamar" ?> </h1>
				<h2 id="caj1"> Principais Informações</h2>
			</div>
		</div>
		<div id="divCon">
			<h3 class="tx"> Sobre Cajamar </h3>
			<p class="mTxt">
				Cajamar é um município que
				se localiza na região metropolitana de São Paulo, a cidade
				surgiu por volta dos anos 60. A cidade foi dividida do município de Santana de Parnaíba em
				18 de fevereiro de 1959. A população de Cajamar estima-se entre 77.934 pessoas, conforme
				os dados do IBGE em 2020, a área é de 131,386 km² e uma densidade demográfica de
				1.143,01 hab/km², os principais distritos são Jordanésia e Polvilho.
			</p>

			<center><br>
				<div class="mapa">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117214.05464213276!2d-46.950315980117736!3d-23.354216919886667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cf1e958732e083%3A0xef1224749a327978!2sCajamar%2C%20SP!5e0!3m2!1spt-BR!2sbr!4v1607361742223!5m2!1spt-BR!2sbr" width="500" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="google"></iframe>
				</div>
				<h3 class="cid10"> Cidades do Brasil </h3>
				<div class="fotos">
					<?php
					include("../Conexao_Banco/connection.php");
					$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$sql = mysqli_query($conexao, "select DISTINCT id_mun, nome from Municipios  where id_mun_est=26 and nome!= '$c'  order by RAND() limit 1");
					while ($imagem = mysqli_fetch_object($sql)) {
						echo "<div id='divImagem1'>";
						echo "<a href='../php_log/confirma_busca2.php?id=$imagem->id_mun' ><br><p id='nomeIMG' style='font-size:20px;'>$imagem->nome</p></a>";
						echo "<img id='imagem1' src='../img/mns.png' style='width:500px;height:300px;'/>";
						echo "</div>";
					}
					?>
				</div>
			</center>
		</div>

		<!--<div id="slider" class="sld">
		     	<button class="btSlider"></button>
			      	<div id="dvload">
			       	  <div id="dvbarra"></div>
			      	</div>
		     	<button class="btSlider"></button>
	      	</div>-->
		<table>
			<tr>
				<td>
					<div id="modal-info" class="modal-container">
						<div class="modal1">
							<button class="fecha">
								<b>X</b>
							</button>
							<h3 class="titulo"> Informações do Clima</h3>
							<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
							</script>
							<center>
								<div id="tempcid">
									<img src='' id="icone" width="140px"><br><br><br><br>

									<strong id="cidade">Cajamar:</strong><br>
									<span id="temperatura">
										<p id="qa"> Cº </p>
									</span>

								</div>
								<span id="clima"></span>
							</center>
							<script>
								$("#favorito").hover(function() {
									$(this).css("color", "yellow")
									$("#favorito").mouseout(function() {
										$(this).css("color", "white");
									});
								});
								$(".fav").css("color", "yellow");
								$(document).ready(function() {
									$.get("http://apidev.accuweather.com/currentconditions/v1/36484.json?language=pt&apikey=hoArfRosT1215", function(data) {
										$('#temperatura').html(data[0].Temperature.Metric.Value);
										$('#clima').html(data[0].WeatherText);
										$('#icone').attr('src', 'https://vortex.accuweather.com/adc2010/images/slate/icons/' + data[0].WeatherIcon + '.svg');
									});
								});
							</script>
						</div>
					</div>
				</td>
			</tr>
			<!--</div>-->
			<td>
				<div id="modal-esta" class="modal-container">
					<div class="modal1 moddif">
						<button class="fecha">
							<b>X</b>
						</button>
						<p class="titulo"><b>Estatísticas da cidade de Cajamar<b></p>
						<table class="modalevenimgs">
							<tr>
								<td class="tex"><b>Habitantes</b> </td>
								<td class="tex"><b>Segurança</b></td>
								<td class="tex"><b>Localização</b></td>
								<td class="tex"><b>Trânsito</b></td>
							</tr>
							<tr>
								<td class="modalevenimg"><img src="../img/habitantes.png" class="habi"></td>
								<td class="modalevenimg"><img src="../img/segurança.png" class="habi"></td>
								<td class="modalevenimg"><img src="../img/localizacao.png" class="habi"></td>
								<td class="modalevenimg"><img src="../img/transito.png" class="habi"></td>
							</tr>
							<tr>
								<td>
									<p class="num"><b>77.934<b></p>
								</td>
								<td>
									<p class="num" id="seg"><b>Seguro</p>
								</td>
								<td>
									<p class="num"><b>Zona Urbana</b>
								</td>
								<td>
									<p class="num num1"> <b>Limpo</b>
								</td>
							</tr>
						</table>
					</div>
			<td>
				<div id="modal-event" class="modal-container">
					<div class="modal1 moddif">
						<button class="fecha">
							<b>X</b>
						</button>
						<p class="titulo">
							<b>Eventos e Cultura em Cajamar<b>
						</p>
						<table class="modalevenbas">
							<tr>
								<td class="tex"><b>Boiadeiro</b> </td>
								<td class="tex"><b>Shows</b></td>
								<td class="tex"><b>Feiras</b></td>
								<td class="tex"><b>Teatro</b></td>
							</tr>
							<tr>
								<td class="modalevenimg"><img src="../img/boi.png" class="habi"></td>
								<td class="modalevenimg"><img src="../img/microfone.png" class="habi"></td>
								<td class="modalevenimg"><img src="../img/feira.png" class="habi"></td>
								<td class="modalevenimg"><img src="../img/teatro.png" class="habi"></td>
							</tr>
							<tr>
								<td>
									<p class="num"><b>&nbsp;F. do Peão<b></p>
								</td>
								<td>
									<p class="num"><b>Musical</p>
								</td>
								<td>
									<p class="num"><b>Noturna</b>
								</td>
								<td>
									<p class="num"><b>Peças</b>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</td>
	</div>
	</td>
	<tr>
		<td>
			<div id="modal-esta" class="modal-container">
				<Div class="modal1">
					<button class="fecha">
						<b>X</b>
					</button>
					<p class="titulo"><b>Estatísticas da cidade de Cajamar<b></p>
					<table>
						<tr>
							<td class="tex"><b>Habitantes</b> </td>
							<td class="tex">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Segurança</b></td>
							<td class="tex">&nbsp;&nbsp;&nbsp;&nbsp;<b>Localização</b></td>
							<td class="tex">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Trânsito</b></td>
						</tr>
						<tr>
							<td><img src="habitantes.png" class="habi"></td>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../img/segurança.png" class="habi"></td>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../img/localizacao.png" class="habi"></td>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;<img src="../img/transito.png" class="habi"></td>
						</tr>
						<tr>
							<td>
								<p class="num"><b>&nbsp;&nbsp;&nbsp;&nbsp;71.805<b></p>
							</td>
							<td>
								<p id="seg"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seguro</p>
							</td>
							<td>
								<p class="num">&nbsp;&nbsp;&nbsp;&nbsp;<b>Zona Urbana</b>
							</td>
							<td>
								<p class="num1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Limpo</b>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<div id="modal-coment" class="modal-container">
			<div class="modal1">
				<button class="fecha">
					<b>X</b>
				</button>
				<form method="post" action="../php_log/adcomentario.php" enctype="multipart/form-data">
					<h1 class="texto100"> Adicionar Comentário </h1>
					<input id="r" type="post" class="y" placeholder="..." name="conteudo" required>
					<input type="hidden" name="local" value="<?php echo $c ?>">
					<input type="hidden" name="tempo" value="<?php $h = strtotime("-4 Hours");
																echo date("H-i-s d-m-Y ", $h) ?>">
					<input type="hidden" name="idcom" value="<?php echo $idfav ?>">
					<input type=submit value="Enviar">
			</div>
			</form>
		</div>
		</div>
		</table>
		<script>
			function iniciaModal(modal1ID) {
				const modal1 = document.getElementById(modal1ID);
				modal1.classList.add('mostrar');
				modal1.addEventListener('click', (e) => {
					if (e.target.id == modal1ID || e.target.className == 'fecha') {
						modal1.classList.remove('mostrar');
					}
				});
			}
			const nuvem = document.querySelector('.nuvem');
			nuvem.addEventListener('click', function() {
				iniciaModal('modal-info');
			});
		</script>
		<script>
			function iniciaModal(modal1ID) {
				const modal1 = document.getElementById(modal1ID);
				modal1.classList.add('mostrar');
				modal1.addEventListener('click', (e) => {
					if (e.target.id == modal1ID || e.target.className == 'fecha') {
						modal1.classList.remove('mostrar');
					}
				});
			}
			const esta = document.querySelector('.esta');
			esta.addEventListener('click', function() {
				iniciaModal('modal-esta');
			});
		</script>
		<script>
			var imgs = [];
			var slider;
			var imgAtual;
			var maxImg;
			var tmp;

			function preCarregamento() {
				var s = 1;
				for (var i = 0; i < 5; i++) {
					imgs[i] = new Image();
					imgs[i].src = "imgs/s" + s + ".jpg";
					s++;
				}
			}

			function carregar(img) {
				slider.style.backgroundImage = "url('" + imgs[img].src + "')";
			}

			function inicia() {
				preCarregamento();
				imgAtual = 0;
				maxImg = imgs.lenght - 1;
				slider = document.getElementById("slider");
				carregar(imgAtual);
				tmp = setInterval(troca, 3000);
			}

			function troca() {
				imgAtual++;
				if (imgAtual > maxImg) {
					imgAtual = 0;
				}
				carregar(imgAtual);
			}
			window.addEventListener("load", inicia);
		</script>
		<script>
			function iniciaModal(modal1ID) {
				const modal1 = document.getElementById(modal1ID);
				modal1.classList.add('mostrar');
				modal1.addEventListener('click', (e) => {
					if (e.target.id == modal1ID || e.target.className == 'fecha') {
						modal1.classList.remove('mostrar');
					}
				});
			}
			const data1 = document.querySelector('.data1');
			data1.addEventListener('click', function() {
				iniciaModal('modal-event');
			});
		</script>
		<script>
			function iniciaModal(modal1ID) {
				const modal1 = document.getElementById(modal1ID);
				modal1.classList.add('mostrar');
				modal1.addEventListener('click', (e) => {
					if (e.target.id == modal1ID || e.target.className == 'fecha') {
						modal1.classList.remove('mostrar');
					}
				});
			}
			const coment = document.querySelector('.coment');
			coment.addEventListener('click', function() {
				iniciaModal('modal-coment');
			});
		</script>
		</div>

</body>

</html>