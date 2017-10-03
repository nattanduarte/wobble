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
	<link rel="stylesheet" type="text/css" href="#">
	<script src="./js/jquery.min.js"></script>
	
</head>
<body>
	<header class="header">
		<img src="#" alt="logo">
		<ul>
			<li><a href="#">Política de Privacidade</a></li>
			<li><a href="cadastrar_usuario.php">Cadastre-se</a></li>
			<li><a href="#">Vamos rir um pouco?</a></li>
		</ul>
	</header>
	<section class="presentation">
		<h1>Bem vindo ao Wobble</h1>
		<p>The dog smells bad sniff other cat's butt and hang jaw half open thereafter for purr as loud as possible, be the most annoying cat that you can, and, knock everything off the table. Ask to go outside and ask to come inside and ask to go outside and ask to come inside scratch the box chase laser cereal boxes make for five star accommodation meow for food, then when human fills food dish, take a few bites of food and continue meowing. Ask to go outside and ask to come inside and ask to go outside and ask to come inside sit in box so stare at ceiling light but kick up litter tuxedo cats always looking dapper meowing chowing and wowing. Hate dog spread kitty litter all over house, poop in litter box, scratch the walls chew on cable. Kitty ipsum dolor sit amet, shed everywhere shed everywhere stretching attack your ankles chase the red dot, hairball run catnip eat the grass sniff hide from vacuum cleaner and attack the dog then pretend like nothing happened climb a tree, wait for a fireman jump to fireman then scratch his face, and plan steps for world domination. Purr as loud as possible, be the most annoying cat that you can, and, knock everything off the table stare at the wall, play with food and get confused by dust poop in litter box, scratch the walls but groom yourself 4 hours - checked, have your beauty sleep 18 hours - checked, be fabulous for the rest of the day - checked pelt around the house and up and down stairs chasing phantoms yet kitty loves pigs for stares at human while pushing stuff off a table.</p>
	</section>
	<container class="content">
		<form action="#" method="post">
			<h2>Faça login</h2>
			<input type="text" name="username" placeholder="Usuário" /><br>
			<input type="password" name="password" placeholder="Senha" /><br>
			<input type="submit" value="Entrar" />
		</form>
	<br>
		<p>Não é cadastrado? <a href="cadastrar_usuario.php">Cadastre-se!</a></p>
	</container>
</body>
</html>