<?php
session_start();
include("../Conexao_Banco/connection.php");
$_SESSION['secadastre'] = true;
header('Location:../php_pag/loginForm.php');
