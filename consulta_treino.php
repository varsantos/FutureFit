<?php
	/**
	 * 
	 * 
	 * 
	 * Consulta na base de dados
	 */
	//echo '<pre>';
	$_POST['matricula']		=	trim(str_replace([' ', ',', '.', '-', '/'], '', $_POST['matricula']));
	//echo "<br>Pesquisando pela matricula: {$_POST['matricula']}";
	//die("veio sim ");
	$host = "localhost:3306";
	$user = "root";
	$pass = "";
	$banco = "futurefit";
	$conn = new mysqli($host, $user, $pass, $banco);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "<br>Busca pela matricula com a query: <br>";
	/**
	 * 
	 * 
	 * Busca pelo aluno da matricula
	 */
	$sqlAluno = "
		SELECT 
			*
		FROM alunos a
		WHERE a.idaluno = {$_POST['matricula']}
	";
	$resAluno = $conn->query( $sqlAluno ) or die(' Erro na query:' . $sqlAluno); 

	if ($resAluno->num_rows > 0) {
		$Aluno = $resAluno->fetch_assoc();

		header("location: consulta_aluno.php?matricula={$Aluno['idaluno']}");
	} else {
		// Caso o aluno nao tenha sido encontrado...

		header("location: consulta_aluno.php?matricula=0");
		die("<br>Matricula nao encontrada");
	}