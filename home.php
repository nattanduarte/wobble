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
	<p>Bem vindo, <?php echo $user; ?>!</>
</body>
</html>