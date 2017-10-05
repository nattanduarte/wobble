<?php
session_start();
if (isset($_SESSION['usuario'])) {

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

?>
<!DOCTYPE html>
<html>
<head>
	<title>Wobble</title>
</head>
<body>
<?php if (isset($_SESSION['usuario'])){ ?>
	<p>Bem vindo</p>
	<form action="#" method="post">
		<input type="Submit" value="Encerrar Sessão">
	</form>
<?php 
	echo "<img id='capa' src='$background' alt='Cover'>";
	echo "<img id='perfil' src='$imagem' alt='Cover'>";
} 


?>

	

</body>
</html>