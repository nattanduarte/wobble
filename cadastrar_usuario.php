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

		$foto=$_FILES['foto']['tmp_name'];
		$background=$_FILES['background']['tmp_name'];
	

		

		if ($password==$passwordConfirm) {
			$caminho= mkdir("./usuarios/".$username."/",0777);
			copy($foto,"./usuarios/".$username."/imagem.jpg");
			copy($background,"./usuarios/".$username."/background.jpg");

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
	<link rel="stylesheet" type="text/css" href="./css/clear.css">
	<link rel="stylesheet" type="text/css" href="./css/cadastrod.css">
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
				<li><a href="#">Política de Privacidade</a></li>
				<li><a href="index.php">Faça login</a></li>
				<li><a href="#">Vamos rir um pouco?</a></li>
			</ul>
		</nav>	
	</header>
	<container class="content">
		<form class="formu" action="#" method="POST"  enctype="multipart/form-data">
			<label>Nome:</label><br/> <input type="text" name="nome" placeholder="Nome"> <br/>
			<label>Sobrenome:</label><br/> <input type="text" name="sobrenome" placeholder="Sobrenome"><br/>
			<label>Sexo: </label>
			<select name="sexo">
			  <option value="masculino">Masculino</option>
			  <option value="feminino">Feminino</option>
			</select><br/>
			<label>E-mail:</label><br/> <input type="email" name="email" placeholder="exemplo@mail.com"><br/>
			<label>Username:</label><br/> <input type="text" name="username" placeholder="Usuário"><br/>
			<label>Senha:</label><br/> <input type="password" name="password" placeholder="Senha"><br/>
			<label>Confirme a senha:</label><br/> <input type="password" name="passwordConfirm" placeholder="Confirmação de senha"><br/>
			<label>Foto de perfil:</label><br/> <input type="file" name="foto" ><br/>
			<label>Foto de capa:</label><br/> <input type="file" name="background" ><br/>
			<input type="submit" value="Cadastrar">
		</form>
		<br>

</container>
</body>
</html>