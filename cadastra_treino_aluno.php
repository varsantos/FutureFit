<?php
/**
 * 
 * 
 * 
 * Cadastro do mapa de treinos
 */
print('<pre>');
print_r($_POST);

$host = "localhost:3306";
$user = "root";
$pass = "";
$banco = "futurefit";
$conn = new mysqli($host, $user, $pass, $banco);
// Check connection teste
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


//    [alunoid] => 3
//    [tipoexercicioid] => 1
//    [exercicioid] => 4
//    [series] => 3
//    [repeticoes] => 3

// Validacao dos dados fornecidos
$retorno = "";
foreach ($_REQUEST as $_c => $_v) {
	$retorno .= "&{$_c}={$_v}";
}
switch (0) {
	case ($_REQUEST['alunoid']): {
		header("location: montar_treino.php?error=101{$retorno}");
		exit;
	} break;
	case ($_REQUEST['tipoexercicioid']): {
		header("location: montar_treino.php?matricula={$_REQUEST['alunoid']}&error=102{$retorno}");
		exit;
	} break;
	case ($_REQUEST['exercicioid']): {
		header("location: montar_treino.php?matricula={$_REQUEST['alunoid']}&error=103{$retorno}");
		exit;
	} break;
	case ($_REQUEST['series']): {
		header("location: montar_treino.php?matricula={$_REQUEST['alunoid']}&error=104{$retorno}");
		exit;
	} break;
	case ($_REQUEST['repeticoes']): {
		header("location: montar_treino.php?matricula={$_REQUEST['alunoid']}&error=105{$retorno}");
		exit;
	} break;
	
	default: {
		// Faca nada, apenas continue com o codigo
	} break;
}

//print '<pre>';
//print_r($_REQUEST);
//die();

$_campos = "";
$_valores = "";

foreach ($_POST as $campo => $valor) {
	$_campos .= "{$campo}, ";
	$_valores .= "{$valor}, ";
}

$_campos = substr_replace($_campos, '', -2);
$_valores = substr_replace($_valores, '', -2);

$sqlAllAlunos = "INSERT INTO alunos_exercicios ({$_campos}) VALUES ({$_valores});";

if ($conn->query($sqlAllAlunos)) {
	header("location: montar_treino.php?matricula={$_POST['alunoid']}&result=1");
	//die("Treino inserido com sucesso!");
} else {
	header("location: montar_treino.php?matricula={$_POST['alunoid']}&result=0");
	//die("Falha ao inserir Treino");
}
