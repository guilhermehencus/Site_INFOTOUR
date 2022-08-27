<?php
session_start();
include("../Conexao_Banco/connection.php");
$pagina = $_POST["pagina"];
$quantidade_pg = $_POST["quantidade_pg"];
$id = $_POST["id"];
echo "<html><head>
<style>
    a {
        font-family:'century gothic';
        font-size: 20px;
        color: #00334d;;
    }
    #primeirapg{
        font-family:'century gothic';
        font-size: 30px;
        color: #00334d;;
    }
		.y{
			float: right;
			margin-right:140px;
			margin-top: 40px;
		}
		.b {
			float: left;
			margin-left: -60px;
			margin-top: -90px;
		}
		#localb{
			float: right;
			margin-top: -100px;
			margin-left: 600px;
		}
		#localc{
			float: left;
			margin-left: -40px;
		}
		#botesq{
			float: left;
			margin-top:-30px;
			margin-left: -40px;
		}
		#albot2{
			margin-top: -140px;
			transform: translateY(0.65in);
			margin-left: -40px;
		}
		#botdire{
			transform: translateY(1in);
			margin-left:640px;
			margin-top: -140px;
		}
		#albot1{
			transform: translateY(0.6in);
			margin-left:640px;
			margin-top:-190px;
		}

</style>
</head>";

/* calculo da inicialização */
$inicial = ($pagina * $quantidade_pg) - $quantidade_pg;
$result_c = "select * from Comentar_Local where id_com_usua=$id order by id_com LIMIT $inicial, $quantidade_pg";
$resultado_c = mysqli_query($conexao, $result_c);
if (($resultado_c) and ($resultado_c->num_rows != 0)) {
?> <h1 id="comentarioss"> Comentários </h1>
	<button class="fechar">
		<b>X</b>
	</button>
	<?php
	$countl = 0;
	while ($row_coment = mysqli_fetch_assoc($resultado_c)) {
	?>



		<?php
		$countl = $countl + 1;
		if ($countl % 2) {
		?>
			<?php
			$row_c = $row_coment['id_com'];
			$result_editado = "select * from Editado where id_ed_com= '$row_c'";
			$resultado_editado = mysqli_query($conexao, $result_editado);
			if (isset($resultado_editado)) { ?>
				<ul>
					<li>
						<p id="localc"> <i> <?php echo $row_coment['nome_local']  ?> : <?php echo $row_coment['data_comentario']  ?> editado </i> </p>
					</li> <?php } else { ?>
					<li>
						<p id="localc1"> <i> <?php echo $row_coment['nome_local']  ?> : <?php echo $row_coment['data_comentario']   ?> </i> </p>
					</li> <?php } ?>
				<li>
					<form method="POST" action="../php_log/alcomentario.php"> <input type='hidden' name="idcom" value="<?php echo $row_coment['id_com']  ?>" required />
				<li><input id='r' type='post' class='y' name='conteudo' value="<?php echo $row_coment['nome_com']  ?>" required /></li>
				<li><input type="submit" id="albot1" value="Alterar Comentário"></li>
				</form>
				</li>
				<a href='../php_log/excomentario.php?id=<?php echo $row_coment['id_com'] ?> '> <input type="submit" id="botdire" value="Excluir Comentário"> </a> <?php } else {
																																									?> <?php $result_editado = "select * from Editado where id_ed_com=' $row_c'";
																																									$resultado_editado = mysqli_query($conexao, $result_editado);
																																									if (isset($resultado_editado)) { ?>
					<p id="localb"> <i> <?php echo $row_coment['nome_local']  ?> : <?php echo $row_coment['data_comentario']  ?> editado </i> </p> <?php } else { ?>
					<p id="localb1"> <i> <?php echo $row_coment['nome_local']  ?> : <?php echo $row_coment['data_comentario']  ?> </i> </p> <?php } ?> <br> <br>
				<form method="POST" action="../php_log/alcomentario.php"> <input type='hidden' name="idcom" value="<?php echo $row_coment['id_com']  ?>" required />
					<input id='d' type='post' class='b' name='conteudo' value="<?php echo $row_coment['nome_com'] ?>" required /> <input type="submit" id="albot2" value="Alterar Comentário"> </a>
				</form> <input type="submit" id="botesq" value="Excluir Comentário" /> </a> <a href='../php_log/alcomentario.php?id=<?php echo $row_coment['id_com'] ?> '> </a> <?php }
																																										} ?> <br><Br><br>
		<?php
		$result_pg = "SELECT count(id_com) as 'total' FROM Comentar_Local where id_com_usua=$id;";
		$resultado_pg = mysqli_query($conexao, $result_pg);
		$resultado = mysqli_fetch_assoc($resultado_pg);
		$count = $resultado['total'];
		$row_g = $count / $quantidade_pg;
		$row_result_pg = ceil($row_g); /* pegar quantidade de página  ceil= arredondamento*/
		/* limitar página antes */
		$max_links = 1;

		for ($pagina_ant = $pagina - 1; $pagina_ant <= $pagina - $max_links; $pagina_ant++) {
			if ($pagina_ant >= 1) {
				echo " <br>  <a href='#' onclick=' paginaComentario($pagina_ant, $quantidade_pg)' > $pagina_ant </a> ";
			}
		}
		echo '<li>';
		echo ' <span id="primeirapg"> ';
		echo "$pagina";
		echo '</span>';
		echo '</li>';
		for ($pagina_dep = $pagina + 1; $pagina_dep <= $pagina + $max_links; $pagina_dep++) {
			if ($pagina_dep <= $row_result_pg) {
				echo "<li > <a  href='#' onclick=' paginaComentario($pagina_dep, $quantidade_pg)' > $pagina_dep </a> </li>";
			}
		}


		/* cpmparando */
	} else {
		?>
		<h1 id="comentarioss"> Comentários </h1>
		<button class="fechar">
			<b>X</b>
		</button>
		<p id="necom"> Nenhum comentário encontrado </p> <?php
														}
															?>
	<script>
		//* Aqui Matheus da para personalizar a página com o envento do click *//
		var id = <?php echo $id ?>;
		$(document).ready(function() {
			paginaComentario(pagina, quantidade_pg)
		});

		function paginaComentario(pagina, quantidade_pg) {
			var dados = {
				pagina: pagina,
				quantidade_pg: quantidade_pg,
				id: id

			}
			$.post('exibircomentario.php', dados, function(retorna) {
				iniciaModal('modal-coment');
				$("#exicom").html(retorna);
			});
		}
	</script>