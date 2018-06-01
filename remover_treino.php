<?php
/**
 * 
 * 
 * 
 * Removendo um treino de aluno da base
 */


$host = "localhost:3306";
$user = "root";
$pass = "";
$banco = "futurefit";
$conn = new mysqli($host, $user, $pass, $banco);
// Check connection teste
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

print '<pre>';
print_r($_REQUEST);
/*
    [tipoexercicioid] => 2
    [exercicioid] => 3
    [alunoid] => 1
*/
if (!!! isset($_REQUEST['tipoexercicioid'])) header("location: montar_treino.php?error=106");
if (!!! isset($_REQUEST['exercicioid'])) header("location: montar_treino.php?error=106");
if (!!! isset($_REQUEST['alunoid'])) header("location: montar_treino.php?error=106");

$sqlDelete = "
	DELETE FROM alunos_exercicios 
	WHERE 
		tipoexercicioid = {$_REQUEST['tipoexercicioid']}
		AND exercicioid = {$_REQUEST['exercicioid']}
		AND alunoid = {$_REQUEST['alunoid']}
	";

if ($conn->query($sqlDelete)) {
	header("location: montar_treino.php?matricula={$_REQUEST['alunoid']}&status=200");
} else {
	header("location: montar_treino.php?matricula={$_REQUEST['alunoid']}&status=201");
}

die();