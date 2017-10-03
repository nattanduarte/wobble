<html>
<body>
<?php

	$conexao = mysqli_connect("localhost", "root", "","usuarios");

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$query="CREATE TABLE cadastros (
	Nome VARCHAR(255), 
	Sobrenome VARCHAR(255),
	Sexo VARCHAR(255),
	Email VARCHAR(255),
	Usuario VARCHAR(255),
	Senha VARCHAR(255)
	,PRIMARY KEY(Usuario) )";

	if (mysqli_query($conexao,$query)===TRUE){
		echo "Tabela cadastros criada!";
	} else {
		echo "Error criando cadastros. Listando erros ... <br>";
		echo "<pre>";
		print_r(mysqli_error_list($conexao));
		echo "</pre>";
	}

	mysqli_close($conexao);
?>
</body>
</html>



