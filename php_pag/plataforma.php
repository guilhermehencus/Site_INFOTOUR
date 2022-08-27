<html>
<?php
session_start();
?>

<head>
  <title> A Plataforma </title>
  <link rel="stylesheet" type="text/css" href="../css/index.css" />
  <link rel="stylesheet" type="text/css" href="../css/plat.css" />
  <style media="screen">
    #objet {
      font-family: 'century gothic';
      font-size: 30px;
      color: white;
    }

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

    .textoP {
      text-align: justify;
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
  </nav>

  <div class="Tudomesmo">


    <div class="divTudo">
      <center><br><br>
        <p class="plat"> A plataforma </p><br><br></br>
        <p id="ideia"> A ideia </p>
      </center><br><br><br>
      <p class="textoP">&nbsp;&nbsp;&nbsp;&nbsp;A ideia surgiu a partir das escolhas de temas e análises de problemáticas, com
        isso veio a ideia de fazer uma plataforma sobre turismo, já que o turismo é uma atividade com extrema
        demanda no Brasil. Com essas Informações, apenas foi aprimorada a ideia, pensando em qualquer necessidade
        das pessoas, ajudando em todas as ocasiões e entregando o máximo de informação possível. O nome Info Tour veio da
        ideia de juntar o Turismo com Informação. O protótipo da plataforma conta com exemplos de como as informações serão
        acessadas no site, com uma facilidade de acesso, permitindo que qualquer usuário consiga acessar o site sem dificuldades</p><br><br><br>
      <center>
        <p id="objet"> Objetivos da Plataforma</p>
      </center><br><br><br>
      <p class="textoP">&nbsp;&nbsp;&nbsp;&nbsp;As primeiras impressões da plataforma surgiram após diversas ideias, mas com um mesmo objetivo, apresentar
        informações sobre locais do Brasil. Já com a ideia em mente, começou o desenvolvimento, com um design moderno, a plataforma
        foi surgindo aos poucos com diversas funções e interações, com informações detalhadas sobre qualquer região no Brasil, com
        informações sobre eventos, índice de segurança e até mapas com localizações de hotéis e restaurantes. Com a Info Tour você
        descobre o Brasil na tela do seu computador.</p>

    </div>
  </div>

</body>

</html>