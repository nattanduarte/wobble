<?php
session_start();
if (isset($_SESSION['usuario'])) {
	header("Location: home.php");
}
else{


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$conexao = mysqli_connect("localhost", "root", "","usuarios");

		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$sexo = $_POST['sexo'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$passwordConfirm = $_POST['passwordConfirm'];

		$password = hash('sha512', $password);
		$passwordConfirm = hash('sha512', $passwordConfirm);

		if ($password==$passwordConfirm) {


			$query="INSERT INTO cadastros VALUES ('$nome', '$sobrenome', '$sexo', '$email', '$username', '$password');";

			if (mysqli_query($conexao,$query)===TRUE){
				header("Location: " . $_SERVER["HTTP_REFERER"] );		
			} else {
				echo "Nome de usuário já em uso";
			}
			echo "Cadastro completo";
			mysqli_close($conexao);
		}else{
			echo "Confirmação de senha inválida";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Wobble - Cadastre-se</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="#">
	<script src="./js/jquery.min.js"></script>
</head>
<body>
	<header class="header">
		<img src="#" alt="logo">
		<ul>
			<li><a href="#">Política de Privacidade</a></li>
			<li><a href="#">Faça login</a></li>
			<li><a href="#">Vamos rir um pouco?</a></li>
		</ul>
	</header>
	<container class="content">
		<form action="#" method="POST">
			<input type="text" name="nome" placeholder="Nome"><br> 
			<input type="text" name="sobrenome" placeholder="Sobrenome"><br>
			Sexo
			<select name="sexo">
			  <option value="masculino">Masculino</option>
			  <option value="feminino">Feminino</option>
			</select><br>
			<input type="email" name="email" placeholder="exemplo@mail.com"><br>
			<input type="text" name="username" placeholder="Usuário"><br>
			<input type="password" name="password" placeholder="Senha"><br>
			<input type="password" name="passwordConfirm" placeholder="Confirmação de senha"><br>
			<input type="file" name="fotoPerfil" ><br>
			<input type="file" name="fotoBackground" ><br>
			<input type="submit" value="Cadastrar">
		</form>
		<br>
		<button><a href="./index.php">Login</a></button>
</container>
</body>
</html>