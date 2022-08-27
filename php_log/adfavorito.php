<?php
session_start();
include("../Conexao_Banco/connection.php");
$nome_fav = $_POST["nome_fav"];
$link = $_POST["linkfav"];
$id = $_POST["idfav"];
if (isset($id)) {
    $result_e = "INSERT INTO Favorito_Usuario(nome, link, id_fav_usu) VALUES ('$nome_fav', '$link', '$id')";
    if ($conexao->query($result_e) === TRUE) {
        $_SESSION['adicionado'] = true;
        header('Location:../php_pag/CidadeFz.php');
        exit;
    }
} else {
}
