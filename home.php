<?php
session_start();

if (isset($_SESSION['usuario'])) {
$conexao = mysqli_connect("localhost", "root", "","usuarios");

	$user = $_SESSION['usuario'];
	$background = "./usuarios/" . $user . "/background.jpg";
	$imagem = "./usuarios/" . $user . "/imagem.jpg";

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		session_unset();
		session_destroy();
		header("Location: index.php");
	}

}else{
	header("Location: index.php");
} 
$nome="";
$sobrenome="";

$query="SELECT * FROM cadastros";	
	if ($resposta=mysqli_query($conexao,$query)){


		foreach ($resposta as $linha){
			$nomeSelect=$linha['Nome'];
			$sobrenomeSelect=$linha['Sobrenome'];
			$sexoSelect = $linha['Sexo'];
			$emailSelect = $linha['Email'];
			$usernameSelect = $linha['Usuario'];
			$passwordSelect = $linha['Senha'];

			if ($user == $usernameSelect) {
				$nome=$nomeSelect;
				$sobrenome=$sobrenomeSelect;
			}
			
		}
			mysqli_free_result($resposta);

	}else{
		echo "Erro na query:<br>$query<br>Listando erros ... <br>";
		echo "<pre>";
		print_r(mysqli_error_list($conexao));
		echo "</pre>";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Wobble</title>
	<meta charset="utf-8">	
	<link rel="stylesheet" type="text/css" href="./css/clear.css">
	<link rel="stylesheet" type="text/css" href="./css/home.css">
	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
</head>
<body>
<?php if (isset($_SESSION['usuario'])){ ?>
	<form action="#" method="post">
		<input type="Submit" value="Encerrar Sessão">
	</form>
<?php 
	echo "<img class='capa' src='$background' alt='Cover'>";
	echo "<img class='perfil' src='$imagem' alt='Cover'>";
} 
?>
	<p>Bem vindo, <?php echo "$nome $sobrenome"; ?>!<p/>
</body>
</html>