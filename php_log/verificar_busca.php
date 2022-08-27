<?php
echo "<html><head><style>
.buscas{
	font-family: 'century gothic';
  color: white;
	text-decoration:none;
	margin-left:20px;
	margin-top:20px;
}
.buscas:hover{
	color: blue;
}
li{
	margin-left:20px;
}
</style>
";
session_start();
include("../Conexao_Banco/connection.php");
$pesquisar=filter_input(INPUT_POST, "pq", FILTER_SANITIZE_STRING);
$pesquisar_result="select  B.uf, A.nome, A.id_mun from  Estados B  join Municipios A on (B.id_est=A.id_mun_est)
				where A.nome like '%$pesquisar%' order by A.nome limit 15";
$pesquisar_resultado= mysqli_query($conexao, $pesquisar_result);
if (($pesquisar_resultado) and ($pesquisar_resultado->num_rows !=0)) {
while ($rows=mysqli_fetch_assoc($pesquisar_resultado)) {
		echo "<br>";
		echo "<li> <a class='buscas' href='../php_log/confirma_busca.php?id=". $rows['id_mun']. "'> ".$rows['nome']."  – ".$rows['uf']."  </a> </li>";

		}
	}
	else {
		echo "<li> <a > Nenhum local encontrado </a> </li";
		}
