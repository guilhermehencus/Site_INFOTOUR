<?PHP
session_start();
include("../Conexao_Banco/connection.php");
if (isset($_FILES['arquivo'])) {
	$id=$_POST["id"];
	$foto=$_FILES['arquivo'] ['type'] ['name'];
	$altura = "450";
	$largura = "930";
			
	$salvo['tamanho'] = 1024*1024*100; //5mb
			
			
			//Renomeiar
			$salvo['renomeia'] = false;
					echo "Altura pretendida: $altura - largura pretendida: $largura <br>";
	
	switch($_FILES['arquivo']['type']):
		case 'image/jpeg';
		case 'image/pjpeg';
			$imagem_temporaria = imagecreatefromjpeg($_FILES['arquivo']['tmp_name']);
			
			$largura_original = imagesx($imagem_temporaria);
			
			$altura_original = imagesy($imagem_temporaria);
			
			$nova_largura = $largura ? $largura : floor (($largura_original / $altura_original) * $altura);
			
			$nova_altura = $altura ? $altura : floor (($altura_original / $largura_original) * $largura);
			
			$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
			imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			//função imagejpeg que envia para o browser a imagem armazenada no parâmetro passado
			imagejpeg($imagem_redimensionada, '../img/' . $_FILES['arquivo']['name']);
			echo "<img src='../img/" .$_FILES['arquivo']['name']. "'>";
			break;
			case 'image/png':
		case 'image/x-png';
			$imagem_temporaria = imagecreatefrompng($_FILES['arquivo']['tmp_name']);
			
			$largura_original = imagesx($imagem_temporaria);
			$altura_original = imagesy($imagem_temporaria);
			echo "Largura original: $largura_original - Altura original: $altura_original <br> ";
			
			/* Configura a nova largura */
			$nova_largura = $largura ? $largura : floor(( $largura_original / $altura_original ) * $altura);

			/* Configura a nova altura */
			$nova_altura = $altura ? $altura : floor(( $altura_original / $largura_original ) * $largura);
			
			/* Retorna a nova imagem criada */
			$imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
			
			/* Copia a nova imagem da imagem antiga com o tamanho correto */
			//imagealphablending($imagem_redimensionada, false);
			//imagesavealpha($imagem_redimensionada, true);

			imagecopyresampled($imagem_redimensionada, $imagem_temporaria, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_original, $altura_original);
			
			//função imagejpeg que envia para o browser a imagem armazenada no parâmetro passado
			imagepng($imagem_redimensionada, '../img/' . $_FILES['arquivo']['name']);
			echo "<img src='../img/" .$_FILES['arquivo']['name']. "'>"; 
			
		break;
		endswitch;  
			if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp|jfif|jpg)$/", $_FILES['arquivo'] ['type'] )){
     	   			$_SESSION['alterar_foto_tipo'] = true;
					header('Location:../php_pag/perfil.php');
   	 		} 

			
			
			//Faz a verificação do tamanho do arquivo
			else if ($salvo['tamanho'] < $_FILES['arquivo']['size']){
				$_SESSION['alterar_foto_tamanho'] = true;
					header('Location:../php_pag/perfil.php');
			}
			
			//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
			else{
				//Primeiro verifica se deve trocar o nome do arquivo
				if($salvo['renomeia'] == true){
					//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
					$nome_final = time().'.jpg';
				}else{
					//mantem o nome original do arquivo
					$nome_final = $_FILES['arquivo']['name'];
				}
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $salvo['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
					$query = mysqli_query($conexao, "UPDATE Foto_Usuario SET
					foto='$nome_final' where id_fot_usu='$id'");
					$_SESSION['alterar_foto'] = true;	
					$_SESSION['usuarioFoto']= $query['foto'];
					header('Location:../php_pag/perfil.php');
				}else{
					$_SESSION['alterar_foto_ruim'] = true;
					header('Location:../php_pag/perfil.php');
				}
			}
			
			
		
}
else {
	header('Location:../php_pag/perfil.php'); 
}
