<?php

session_start();
if (isset($_SESSION['usuario'])) {
	header("Location: home.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$conexao = mysqli_connect("localhost", "root", "","usuarios");

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$username = $_POST['username'];
	$password = $_POST['password'];

	$password = hash('sha512', $password);

	$query="SELECT * FROM cadastros";	
		if ($resposta=mysqli_query($conexao,$query)){


			foreach ($resposta as $linha){
				$nomeSelect=$linha['Nome'];
				$sobrenomeSelect=$linha['Sobrenome'];
				$sexoSelect = $linha['Sexo'];
				$emailSelect = $linha['Email'];
				$usernameSelect = $linha['Usuario'];
				$passwordSelect = $linha['Senha'];

				if ($username == $usernameSelect) {
					if ($password == $passwordSelect) {
						
							session_start();
							$_SESSION['usuario']=$username;
							header("Location: home.php");

						mysqli_close($conexao);
					}
				}
			}
				mysqli_free_result($resposta);

		}else{
			echo "Erro na query:<br>$query<br>Listando erros ... <br>";
			echo "<pre>";
			print_r(mysqli_error_list($conexao));
			echo "</pre>";
		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Wobble - Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/clear.css">
	<link rel="stylesheet" type="text/css" href="./css/diagramacao.css">
	<link rel="stylesheet" type="text/css" href="./css/estilo.css">
	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
	<script src="./js/jquery.min.js"></script>
	
</head>
<body>
	<header class="header">
		<h1 class="logo">Wobble</h1>
		<nav class="menu">
			<ul>
				<li><a class="link" href="#">Política de Privacidade</a></li>
				<li><a class="link" href="#">Vamos rir um pouco?</a></li>
			</ul>
		</nav>	
	</header>
	<container class="principal">
		<section class="presentation">
			<h1>Bem vindo ao Wobble</h1>
			<p>Essa rede social foi desenvolvida sob encomenda para você, usuário, que quer ter uma foto de perfil e uma de capa, adicionar uns amigos e tal!!</p>
		</section>
		<container class="content">
			<form class="form" action="#" method="post">
				<h2>Faça login</h2> 
				<input type="text" name="username" placeholder="Usuário" /><br>
				<input type="password" name="password" placeholder="Senha" /><br>
				<input type="submit" value="Entrar" />
			</form>
		<br>
			<p>Não é cadastrado? <a href="cadastrar_usuario.php">Cadastre-se!</a></p>
		</container>
	</container>
</body>
</html>