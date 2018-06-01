<?php
    $host = "localhost:3306";
    $user = "root";
	$pass = "";
	$banco = "futurefit";
	try {
		// echo "<br>Iniciando o sistema de insercao de dados cadastrais.";
		$conn = new mysqli($host, $user, $pass, $banco);
	} catch (Exception $e) {
		die("Connection failed: " . $e);
	}


	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error . ' 2');
	}
/**
 * 
 * 
 * Dados a serem inseridos na base.
 */

	$_POST['nome']		=	trim($_POST['nome']); //trim(ucfirst(strtolower($_POST['nome'])));//  . substr_count($_POST['nome'], ' ');
	$_POST['cpf']		=	trim(str_replace([' ', ',', '.', '-', '/'], '', $_POST['cpf']));
	$_POST['email']		=	$_POST['email']; // Velidacao de existir pelo menos um '@' e um '.'
	$_POST['endereco']	=	$_POST['endereco'];
	$_POST['cep']		=	trim(str_replace([' ', ',', '.', '/'], '', $_POST['cep']));
	$_POST['telefone']	=	trim(str_replace([' ', ',', '.', '(', ')', '+', '/'], '', $_POST['telefone']));
	$_POST['sexo']		=	strtoupper($_POST['sexo']);
	$_POST['password']	=	$_POST['password'];
	// Tratando o valor da data de nascimento
	$_POST['datanasc'] = strlen($_POST['datanasc']) ? trim($_POST['datanasc']) : null;
	if ($_POST['datanasc']) {
		$_POST['datanasc'] = explode('/', $_POST['datanasc']);
		$dia = $_POST['datanasc'][0];
		$mes = $_POST['datanasc'][1];
		$ano = $_POST['datanasc'][2];

		$_POST['datanasc'] = "{$ano}-{$mes}-{$dia}";
	}

	$sql = "INSERT INTO professores (";
	$_campos = "";
	$_valores = "";

	foreach ($_POST as $campo => $valor) {
		$valor = str_replace("'", '`', $valor);
		$_campos .= $campo . ',';

		if (strlen($valor) > 0) { 
			// echo "<br>Velidando se '{$valor}' eh um numero: " . is_numeric($valor);
			if ( is_numeric($valor) ) {
				// die("Debuging");
				$_valores .= " {$valor},";
			} else {
				$_valores .= " '{$valor}',";
			}
		} else {
			$_valores .= "NULL,";
		}
		
		//*** toda essa função em cima poderia ser resumida com essa aqui de baixo***
		// $_valores .= strlen($valor) ? ( is_numeric($valor) ? " {$valor}," : " '{$valor}'," ) : "NULL,";
	}

	$_campos = substr_replace($_campos, '', -1);
	$_valores = substr_replace($_valores, '', -1);
/**
 * 
 * 
 * Montando a query de insercao na base
 */
	echo $sql = "INSERT INTO professores ({$_campos}) VALUES ({$_valores})";

	// EXECUTANDO!!!!
	$resultado = $conn->query($sql);
	$conn->close();
	
	if ($resultado === TRUE) {
		header("location: conta_professor.php?criar_conta_professor=1");
	    // echo "New record created successfully";
	} else {
		header("location: conta_professor.php?criar_conta_professor=0");
	    // echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>