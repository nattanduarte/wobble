<html>
<?php
	$conexao = mysqli_connect("localhost", "root", "");

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$query="CREATE DATABASE usuarios";

	if (mysqli_query($conexao,$query)===TRUE){
		echo "Base de dados usuarios criada!";
	} else {
		echo "Error! Listando erros ... <br>";
		echo "<pre>";
		print_r(mysqli_error_list($conexao));
		echo "</pre>";
	}

	mysqli_close($conexao);
?>
</html>