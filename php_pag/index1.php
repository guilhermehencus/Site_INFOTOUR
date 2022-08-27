<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="icon" type="imagem/png" href="logov.png" />
	<link rel="stylesheet" type="text/css" href="../css/index.css" />
	<link rel="stylesheet" type="text/css" href="../css/pontosturisticos3.css" />
	<title> InfoTour </title>
	<!--imagens-->
	<style media="screen">
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

		.divTudo {
			float: left;
			margin: 0% 15%;
			width: 70%;
			height: 1300px;
			background: #131313;
		}

		.Tudomesmo {
			width: 100%;
			height: 1200px;
		}

		.menu {
			width: 100%;
			height: 80px;
			background-color: #00334d;
			font-family: Arial;
			font-weight: bold;
			position: sticky;
			top: 0;

		}

		.menu ul {
			list-style: none;
		}

		.menu ul li {
			float: left;
			/*border:green solid;
        border-width: 0px 1px;*/
		}

		#cadastrar {
			float: right;
			margin: 0.7%;
		}

		#cadastrar a {
			height: 50px;
			width: 160px;
			border: 2px solid white;
			border-radius: 50px;
			padding: 3px;
		}

		#cadastrar p {
			padding: 0;
			margin: 7% 17%;
			float: left;
		}

		.menu a {
			width: 170px;
			height: 70px;
			display: block;
			text-decoration: none;
			background-color: #00334d;
			/*Cor original:red */
			color: white;
		}

		.menu p {
			/*float:left;
     margin: 13% 18%;*/
			text-align: center;
			padding: 16% 0;
		}

		.menu ul ul {
			visibility: hidden;
		}

		.menu ul li:hover ul {
			visibility: visible;
		}

		.menu a:hover {
			background-color: #00111a;
			/*#0f0f0a*/
			color: #acb3b3;
		}

		.menu ul ul li {
			float: none;
			border-bottom: solid 1px #ccc;
		}

		.menu ul ul li a {
			background-color: #5241f4;
		}

		.submenu {
			background: #999999;
			width: 1px;
			height: 40px;
			float: left;
			margin: 15px 0;
			border-radius: 10px;
		}

		header {
			width: 100%;
			height: 670px;
			background-image: url("../img/salvador.jpg");
			background-size: 100% 670px;
			background-repeat: no-repeat;
		}

		.a {
			width: 100%;
			height: 670px;
			background: rgba(0, 43, 65, 0.8);
		}
	</style>
</head>

<body>
	<header>
		<div class="a">
			<!--<div id="logo">
			       <img src="cajamar.jpg"  name="cajamar">
			    </div>-->
			<div id="nomesite">
				<p id="nome">INFO TOUR</p><br>
				<p id="nome1"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"o site completo sobre turismo nacional"</p>
			</div>
		</div>
	</header>
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
				include("../Conexao_Banco/connection.php");
				$id = $_SESSION['id'];
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
	</nav>
	<div class="Tudomesmo">
		<div class="divTudo">
			<!--  <div class="dois">-->
			<div class="divC">
				<div class="foto">
					<!--   <a href="cajacity.html" >
				              <img src="cajamar.jpg" class="imagenscity" name="cajamar">
					        </a>-->
					<a href="cajacity.html">
						<div class="imagenscity cajamar">
							<div class="divcaj">
								<p class="nomelugar">Cajamar</p>
							</div>
						</div>
					</a>
				</div>
				<div class="descricao">
					<p>Lorem ipsum dolor sit amet,
						consectetur adipiscing elit.
						Vestibulum at dolor tellus.
						Nullam viverra sed sem quis imperdiet.
						Duis congue euismod pretium.
						Nam tempor velit sed eros ultrices blandit.
						Sed eu aliquet turpis.
						Duis vitae finibus tortor, vitae gravida nunc.
						Nullam sed risus ac nisl rutrum interdum quis sed sapien.
						Sed a massa libero.
						Pellentesque scelerisque condimentum commodo.
						Pellentesque ut nisi eget nulla cursus lacinia vel sed nisl.
						Curabitur a porta lorem.
						Phasellus pharetra turpis non massa vestibulum gravida.
						Lorem ipsum dolor sit amet,
						consectetur adipiscing elit.
						Morbi eu enim at eros posuere venenatis sed non diam.
						...<a href="cajacity.html"> saiba mais </a>
					</p>
				</div>
			</div>

		</div>


		<!--  <div id="divP">
				      <p>&nbsp;&nbsp;</p>
				        <a  href="pico.html" class="texto">
					     Pico  <br> do Jaraguá
					    </a>
			        </div>-->
		<!--    </div>-->
	</div>
	</div>
</body>

</html>