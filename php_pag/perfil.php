<?php
session_start();
include("../Conexao_Banco/connection.php");
$id = $_SESSION['id'];
if (empty($id)) {
  header('Location: index1.php');
}
?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="icon" type="imagem/png" href="logov.png" />
  <link rel="stylesheet" type="text/css" href="../css/perfil_1.css" />
  <link rel="stylesheet" type="text/css" href="../css/csscadastro.css" />
  <link rel="stylesheet" type="text/css" href="../css/perfilcon2.css" />
  <link rel="stylesheet" type="text/css" href="../css/perfilcon3.css" />
  <title> InfoTour </title>
  <style>
    .modal1 {
      background: white;
      width: 90%;
      min-width: 400px;
      padding: 40px;
      border: 10px solid #00334D;
      box-shadow: 0 0 0 10px white;
      position: relative;
    }
  </style>
</head>

<body>
  <?php
  if (isset($_SESSION['alterado'])) :
  ?>
    <div id="alterado">
      <p> Alterado com sucesso </p>
    </div>
  <?php
  endif;
  unset($_SESSION['alterado']);
  ?>
  <?php
  if (isset($_SESSION['nao_alterado'])) :
  ?>
    <div id="alterado_nao">
      <p> Parece que colocou os mesmos dados, faz novamente </p>
    </div>
  <?php
  endif;
  unset($_SESSION['nao_alterado']);
  ?>
  <?php
  if (isset($_SESSION['alterar_foto'])) :
  ?>
    <div class="sucesso">
      <p> Alterado com sucesso a foto </p>
    </div>
  <?php
  endif;
  unset($_SESSION['alterar_foto']);
  ?>
  <?php
  if (isset($_SESSION['alterar_foto_tipo'])) :
  ?>
    <div class="insucesso">
      <p> Por favor, altera o tipo da foto para PNG ou um outro </p>
    </div>
  <?php
  endif;
  unset($_SESSION['alterar_foto_tipo']);
  ?>
  <?php
  if (isset($_SESSION['alterar_foto_tamanho'])) :
  ?>
    <div class="insucesso">
      <p> Por favor, veja se a foto não é pesada para carregar </p>
    </div>
  <?php
  endif;
  unset($_SESSION['alterar_foto_tamanho']);
  ?>
  <?php
  if (isset($_SESSION['alterar_foto_ruim'])) :
  ?>
    <div class="insucesso">
      <p> Deu alguma coisa de errado, coloca novamente ou seleciona uma outra </p>
    </div>
  <?php
  endif;
  unset($_SESSION['alterar_foto_ruim']);
  ?>
  <?php
  if (isset($_SESSION['excluirc'])) :
  ?>
    <div id="alterado">
      <p> Excluido o comentário com sucesso </p>
    </div>
  <?php
  endif;
  unset($_SESSION['excluirc']);
  ?>
  <?php
  if (isset($_SESSION['excluirf'])) :
  ?>
    <div id="alterado">
      <p> Retirado dos favoritos com sucesso </p>
    </div>
  <?php
  endif;
  unset($_SESSION['excluirf']);
  ?>
  <center>
    <div id="ajuste">
      <?php
      include("../Conexao_Banco/connection.php");
      if (isset($id)) { ?>
        <?php
        include("../Conexao_Banco/connection.php");
        $sql = mysqli_query($conexao, "select B.foto from Usuario_INFOTOUR A join Foto_Usuario B on (A.id_usua=B.id_fot_usu) where B.id_fot_usu='$id'");
        while ($imagem = mysqli_fetch_object($sql)) {
          echo "<div id='DivPerfil'> <a href='perfil.php'> <img  src='../img/" . $imagem->foto . "' width='70%' height='25%' class='imagem2'/> </a>";
        }
        ?>
      <?php }
      ?>
      <Br><Br>
      <form method="POST" action="../php_log/alterar_foto.php" enctype="multipart/form-data" id="campos_foto">

        <input type="hidden" name="id" value="<?php echo $id ?>" required />
        <label class="classname2" for="input_file"> Selecionar </label>
        <input type="file" name="arquivo" id="input_file" required>
        <input type="submit" value="Trocar Foto">

      </form>
      <button id="coment1" class="coment"> Comentários </button><button id="coment2" class="fav"> Ver Favoritos </button>
      <?php
      include("../Conexao_Banco/connection.php");
      $result = "select*from Usuario_INFOTOUR where id_usua='$id'";
      $resultado = mysqli_query($conexao, $result);
      $row_usuario = mysqli_fetch_assoc($resultado);

      ?>
      <h1 id="perfIl"> Bem Vindo, <?php echo $row_usuario['nome'];  ?> </h1>

      <h2 id="perfil2"> Informações do Perfil </h2>
      <form method="post" action="../php_log/editar_usua.php">
        <table>
          <tr>
            <input type="hidden" name="id" autocomplete="off" value="<?php echo $row_usuario['id_usua'] ?>">
            <th> Nome </th>
            <td><input type="post" name="nome" autocomplete="off" value="<?php echo $row_usuario['nome'] ?>"> </td>
          </tr>
          <tr>
            <th> Email </th>
            <td><input type="post" name="email" autocomplete="off" value="<?php echo $row_usuario['email'] ?>"> </td>
          </tr>
          <tr>
            <th> Nova Senha </th>
            <td><input type="password" name="senha" autocomplete="off"> </td>
          </tr>
        </table> &nbsp;&nbsp;
        <input type="submit" class="botao1" value="Editar">
      </form>
      <input onclick="history.go(-1);" type="submit" class="botao1" id="e" value="Voltar">
      <br>
      <a href="../php_log/sair.php"> <input type="submit" class="botao1" id="e" value="Sair"></a>
  </center>
  </div>
  </div>
  <div id="modal-coment" class="modal-container">
    <div class="modal1 moddif" id="exicom">



    </div>
  </div>
  <div id="modal-fav" class="modal-container">
    <div class="modal1 moddif" id="exifav">



    </div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    function iniciaModal(modal1ID) {
      const modal1 = document.getElementById(modal1ID);
      modal1.classList.add('mostrar');
      modal1.addEventListener('click', (e) => {
        if (e.target.id == modal1ID || e.target.className == 'fechar') {
          modal1.classList.remove('mostrar');
        }
      });
    }
    const coment = document.querySelector('.coment');
    coment.addEventListener('click', function() {
      var id = <?php echo $id ?>;
      var quantidade_pg = 2;
      var pagina = 1;
      $(document).ready(function() {
        paginaComentario(pagina, quantidade_pg)
      });

      function paginaComentario(pagina, quantidade_pg) {
        var dados = {
          pagina: pagina,
          quantidade_pg: quantidade_pg,
          id: id
        }
        $.post('exibirComentario.php', dados, function(retorna) {
          iniciaModal('modal-coment');
          $("#exicom").html(retorna);
        });
      }

    });
  </script>
  <script jquery>
    function iniciaModal(modal1ID) {
      const modal1 = document.getElementById(modal1ID);
      modal1.classList.add('mostrar');
      modal1.addEventListener('click', (e) => {
        if (e.target.id == modal1ID || e.target.className == 'fechar') {
          modal1.classList.remove('mostrar');
        }
      });
    }
    const fav = document.querySelector('.fav');
    fav.addEventListener('click', function() {
      var id = <?php echo $id ?>;
      var quantidade_pg = 2;
      var pagina = 1;
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

    });
  </script>
</body>

</html>