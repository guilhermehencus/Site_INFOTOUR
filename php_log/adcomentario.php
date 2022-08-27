<?php
session_start();
include("../Conexao_Banco/connection.php");
$conteudo = $_POST["conteudo"];
$local = $_POST["local"];
$tempo = $_POST["tempo"];
$id = $_POST["idcom"];
if (isset($id)) {
    $result_e = "INSERT INTO Comentar_Local (nome_com, nome_local, data_comentario, id_com_usua) VALUES ('$conteudo', '$local', '$tempo', '$id')";
    if ($conexao->query($result_e) === TRUE) {
        $_SESSION['comentado'] = true;
        header('Location:../php_pag/CidadeFz.php');
        exit;
    }
} else {
}
