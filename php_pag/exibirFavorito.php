<?php
session_start();
include("../Conexao_Banco/connection.php");
$pagina = $_POST["pagina"];
$quantidade_pg = $_POST["quantidade_pg"];
$id = $_POST["id"];
/* calculo da inicialização */
$inicial = ($pagina * $quantidade_pg) - $quantidade_pg;
$result_c = "select * from Favorito_Usuario where id_fav_usu=$id order by id_favusua LIMIT $inicial, $quantidade_pg";
$resultado_c = mysqli_query($conexao, $result_c);
if (($resultado_c) and ($resultado_c->num_rows != 0)) {
?> <button class="fechar">
    <b>X</b>
  </button>

  <h1 id="comentarioss"> Favoritos </h1>
  <?php

  while ($row_fav = mysqli_fetch_assoc($resultado_c)) {
  ?>





    <p class="favo"> Nome do Lugar: <a href='<?php echo $row_fav['link'] ?>'> <?php echo $row_fav['nome'] ?> </a> </p>
    <a href='../php_log/exfavorito.php?id=<?php echo $row_fav['id_favusua'] ?> '> <input type="submit" id="botfav" value="Tirar dos Favorito"> </a>

  <?php }
  $result_pg = "SELECT count(id_favusua) as 'total' FROM Favorito_Usuario where id_fav_usu=$id;";
  $resultado_pg = mysqli_query($conexao, $result_pg);
  $resultado = mysqli_fetch_assoc($resultado_pg);
  $count = $resultado['total'];
  $row_g = $count / $quantidade_pg;
  $row_result_pg = ceil($row_g); /* pegar quantidade de página  ceil= arredondamento*/
  /* limitar página antes */
  $max_links = 1;

  for ($pagina_ant = $pagina - 1; $pagina_ant <= $pagina - $max_links; $pagina_ant++) {
    if ($pagina_ant >= 1) {
      echo "<li > <span id='pgant' > <a class='page-link' href='#' onclick=' paginaFavorito($pagina_ant, $quantidade_pg)' > $pagina_ant </a> </span> </li> ";
    }
  }
  echo '<li>';
  echo ' <span  id="primeirapg"> ';
  echo "$pagina";
  echo '</span>';
  echo '</li>';
  for ($pagina_dep = $pagina + 1; $pagina_dep <= $pagina + $max_links; $pagina_dep++) {
    if ($pagina_dep <= $row_result_pg) {
      echo "<li > <span id='pgdep'> <a  class='page-link' href='#' onclick=' paginaFavorito($pagina_dep, $quantidade_pg)' > $pagina_dep </a> </span> </li>";
    }
  }


  /* comparando */
} else {
  ?>

  <button class="fechar">
    <b>X</b>
  </button>

  <h1 id="comentarioss"> Favoritos </h1>
  <p id="necom"> Nenhum adicionado ainda </p> <?php
                                            }
                                              ?>
<script>
  //* quando o usuário seleciona a página fica uma cor chamativa principal que onde está *//

  var id = <?php echo $id ?>;
  $(document).ready(function() {
    paginaFavorito(pagina, quantidade_pg)
  });

  function paginaFavorito(pagina, quantidade_pg) {
    var dados = {
      pagina: pagina,
      quantidade_pg: quantidade_pg,
      id: id

    }
    $.post('exibirFavorito.php', dados, function(retorna) {
      iniciaModal('modal-fav');
      $("#exifav").html(retorna);
    });
  }
  /* personaliza a partir daqui */
  $('#primeirapg').css("background-color", "yellow");
  $('#pgdep').addEventListener('click', function() {
    $('#pgdep').css("background-color", "yellow");
    $('#primeirapg').css("color", "black");
    $('#pgant').css("color", "black");
  });
  $('#pgant').addEventListener('click', function() {
    pgant.css("background-color", "yellow");
    $('#primeirapg').css("color", "black");
    $('#pgdep').css("color", "black");
  });
</script>