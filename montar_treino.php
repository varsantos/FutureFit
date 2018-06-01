<?php

	$host = "localhost:3306";
	$user = "root";
	$pass = "";
	$banco = "futurefit";
	$conn = new mysqli($host, $user, $pass, $banco);
	// Check connection teste
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sqlAllAlunos = "SELECT idaluno, nome FROM alunos ORDER BY nome ASC";
	$resAllAlunos = $conn->query($sqlAllAlunos);

	if ($resAllAlunos->num_rows > 0) {
		$AlunosAll = [];
		while ($linha = $resAllAlunos->fetch_assoc()) {
			$AlunosAll[$linha['idaluno']] = $linha;
		}
	}

	if (isset($_REQUEST['matricula']) ) {

		// Busca pelo aluno
		$sqlAluno = "SELECT * FROM alunos WHERE idaluno = {$_REQUEST['matricula']};";
		$resAluno = $conn->query($sqlAluno);

		if ($resAluno->num_rows > 0) {
			$Aluno = $resAluno->fetch_assoc();


			// Busca pelos tipos de treino
			$sqlTreinos = "SELECT * FROM execiciotipos ORDER BY nometipo ASC;";
			$resTreinos = $conn->query($sqlTreinos);

			if ($resTreinos->num_rows > 0) {
				$Treinos = [];
				while ($linha = $resTreinos->fetch_assoc()) {
					$Treinos[$linha['idtipoexercicio']] = $linha;
				}
			}
			// Busca pelos exercicios
			$sqlExercicios = "SELECT * FROM exercicios ORDER BY nome ASC;";
			$resExercicios = $conn->query($sqlExercicios);

			if ($resExercicios->num_rows > 0) {
				$Exercicios = [];
				while ($linha = $resExercicios->fetch_assoc()) {
					$Exercicios[$linha['idexercicio']] = $linha;
				}
			}
		} else {
			die("Aluno nao encontrado");
		}
	}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
<div id="fundo-externo" class="bg-zindex">
			<div id="fundo">
				<img src="Backgound Images/gym6.jpg" alt=""/>
			</div>
		</div>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>FutureFit</title>
		<meta name="description" content="#" />
		<meta name="keywords" content="#" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li>
									<ul class="gn-submenu">
										
									</ul>
								</li>
								<li><a href="conta.php" class="gn-icon gn-icon-cog">Conta</a></li>
                                <li><a href="consulta_aluno.php" class="gn-icon gn-icon-article">Consultar treino</a></li>
								<li><a href="Tela Login/Login Professor/escolhaprofessor.html" class="gn-icon gn-icon-pictures">Montar treino</a></li>
                                <li><a class="gn-icon gn-icon-help">Dúvidas</a>							</li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href="index.html">Home</a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="Tela Login/Login A+P/Loginescolha.html"><span>Logout</span></a></li>
				<li><a class="codrops-icon codrops-icon-drop" href="https://www.vix.com/pt/bdm/saude/10-jeitos-de-tomar-mais-agua-dicas-que-vao-melhorar-muito-seu-consumo"><span>Hidrate-se</span></a></li>
			</ul>

<style type="text/css">
.tabela {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 12px;
}

select.error, input.error {
	border: 1px solid #f00;
}
p.error {
	color: #f44;
	font-weight: 400;
}
p.success {
	color: #4F4;
	font-weight: 400;
}

</style>
    <fieldset class="fieldset-conta" style="position: relative; display: block; margin: 12px auto; margin-top: 62px;">
    <center>
    	<h2 style=" font-family: Tahoma, Arial, Helvetica, sans-serif;
            font-size: 28px;"/>Ficha de Treino</h2>
    </center>
    <p>Treino do Aluno:</p>
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)

  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }

}
function emailMask(email) {
	var maskedEmail = email.replace(/([^@\.])/g, "*").split('');
	var previous	= "";
	for(i=0;i<maskedEmail.length;i++){
		if (i<=1 || previous == "." || previous == "@"){
			maskedEmail[i] = email[i];
		}
		previous = email[i];
	}
	return maskedEmail.join('');
}
</script>

<form 
	id="frmBuscaAluno" 
	name="frmBuscaAluno" 
	method="get" 
	action="montar_treino.php" 
>
	<table width="401" height="170" border="0" cellspacing="5" class="tabela">
		<tr>
		    <td height="35">Aluno:</td>
		    <td>
				<select <?php echo isset($_GET['error']) ? (($_GET['error'] == 1) ? 'class="error"' : '') : '' ?> id="slcNumMatricula" name="matricula" onchange="$('#frmBuscaAluno').submit()">
					<option value="0">Selecione o aluno</option>
<?php
if (count($AlunosAll)) {
	foreach ($AlunosAll as $idaluno => $dados_aluno) {
?>
					<option 
						value="<?php echo $idaluno ?>" 
						<?php echo isset($_GET['matricula']) ? (($_GET['matricula'] == $idaluno) ? 'selected="selected"' : '') : ''; ?>
					>
						<?php echo str_pad($idaluno, 8, '0', STR_PAD_LEFT) . " - {$dados_aluno['nome']}"; ?>
					</option>
<?php
	}
} else
?>
	  			</select>
			</td>
	  	</tr>
	  	<tr>
	  		<td colspan="2">
<?php

if (isset($_GET['error'])) {
	switch ($_GET['error']) {
		case 101: {
			echo '<p class="error">Erro: Selecione um aluno.</p>';
		} break;
		case 102: {
			echo '<p class="error">Erro: Selecione um tipo de treino.</p>';
		} break;
		case 103: {
			echo '<p class="error">Erro: Selecione um exerc&iacute;cio.</p>';
		} break;
		case 104: {
			echo '<p class="error">Erro: Informe um n&uacute;mero de s&eacute;ries.</p>';
		} break;
		case 105: {
			echo '<p class="error">Erro: Informe um n&uacute;mero de repeti&ccedil;&otilde;es.</p>';
		} break;
		
		default: {
			echo '<p class="error">Erro desconhecido. Consulte o administrador.</p>';
		} break;
	}
}

if (isset($_GET['status'])) {
	switch ($_GET['status']) {
		case 200: {
			echo '<p class="success">Exerc&iacute;cio removido com sucesso!</p>';
		} break;
		case 202: {
			echo '<p class="error">Falha ao remover exerc&iacute;cio do treino!</p>';
		} break;
		
		default:
			# code...
			break;
	}
}
?>
	  		</td>
	  	</tr>
	</table>
</form>
<?php
if (isset($_REQUEST['matricula']) ) {
?>
<form action="cadastra_treino_aluno.php" method="post">
	<input type="hidden" name="alunoid" value="<?php echo $_REQUEST['matricula']; ?>">
	<table style="width: 100%;">
		<thead>
			<tr>
				<td>Treinos</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="5">
<?php
	if (isset($_GET['result'])) {
		if ($_GET['result']) {
?>
					<p style="color: #4f4; font-weight: 400;">Treino cadastrado</p>
<?php
		} else {
?>
					<p style="color: #f44; font-weight: 400;">Falha ao cadastrar treino<br>Sequencia j&aacute; cadastrada.</p>
<?php
		}
	}
?>
				</td>
			</tr>
			<tr>
				<td><nobr>Tipo de treino: <nobr></td>
				<td>
					<select 
						name="tipoexercicioid" 
						<?php echo isset($_GET['error']) ? (($_GET['error'] == 2) ? 'class="error"' : '') : '' ?>
					>
						<option value="0">Selecione o tipo de treino</option>
<?php
foreach ($Treinos as $idtipoexercicio => $dadosTreino) {
?>
						<option value="<?php echo $idtipoexercicio; ?>" 
							<?php echo isset($_GET['tipoexercicioid']) ? (($_GET['tipoexercicioid'] == $idtipoexercicio) ? 'selected="selected"' : '') : '' ?>
						>
							<?php echo $dadosTreino['nometipo']; ?>
						</option>
<?php
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<select name="exercicioid"  <?php echo isset($_GET['error']) ? (($_GET['error'] == 3) ? 'class="error"' : '') : '' ?>>
						<option value="0">Selecione o exerc&iacute;cio</option>
<?php
foreach ($Exercicios as $idexercicio => $dadosExercicio) {
?>
						<option value="<?php echo $idexercicio; ?>" 
							<?php echo isset($_GET['exercicioid']) ? (($_GET['exercicioid'] == $idexercicio) ? 'selected="selected"' : '') : '' ?>
						>
							<?php echo $dadosExercicio['nome']; ?>
						</option>
<?php
}
?>
					</select>
				</td>
				<td>
					<input 
						type="number" 
						name="series" 
						placeholder="S&eacute;ries" 
						<?php echo isset($_GET['error']) ? (($_GET['error'] == 4) ? 'class="error"' : '') : '' ?>
						value="<?php echo isset($_GET['series']) ? $_GET['series'] : '' ?>"
					>
				</td>
				<td>
					<input 
						type="number" 
						name="repeticoes" 
						<?php echo isset($_GET['error']) ? (($_GET['error'] == 5) ? 'class="error"' : '') : '' ?> 
						placeholder="N&uacute;mero de repeti&ccedil;&otilde;es"
						value="<?php echo isset($_GET['repeticoes']) ? $_GET['repeticoes'] : '' ?>"
					>
				</td>
				<td>&nbsp;</td>
				<td><button type="substring">Adicionar</button></td>
			</tr>
		</tbody>
	</table>
</form>

<hr style="padding: 8px 0;">
<table style="width: 100%;">
	<thead>
		<tr>
			<th colspan="3">Mapa de treinos</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($Treinos as $idtipoexercicio => $dadosTreino) {
?>
		<tr><td colspan="6">&nbsp;</td></tr>
		<tr>
			<td><strong><?php echo $dadosTreino['nometipo']; ?></strong></td>
			<td colspan="5"></td>
		</tr>
<?php 
		$sqlMapa = "
			SELECT 
				a.idaluno, 
			    e.idexercicio, 
			    et.idtipoexercicio, 
			    e.nome as nome_exercicio, 
			    ae.series, 
			    ae.repeticoes
			from alunos_exercicios ae
			INNER JOIN alunos a ON a.idaluno = ae.alunoid
			INNER JOIN execiciotipos et ON et.idtipoexercicio = ae.tipoexercicioid
			INNER JOIN exercicios e ON e.idexercicio = ae.exercicioid
			WHERE et.idtipoexercicio = {$idtipoexercicio}
				AND a.idaluno = {$Aluno['idaluno']}
		";
		$resMapa = $conn->query($sqlMapa);

		if ($resMapa->num_rows > 0) {

			while ($linha = $resMapa->fetch_assoc()) {
				//$Treinos[$linha['idtipoexercicio']] = $linha;

?>
		<tr>
			<td>&nbsp;</td>
			<td>
				<?php echo $linha['nome_exercicio']; ?>
			</td>
			<td>
				<?php echo $linha['series']; ?>
			</td>
			<td>
				<?php echo $linha['repeticoes']; ?>
			</td>
			<td>&nbsp;</td>
			<td>
				<form action="remover_treino.php" method="post" onsubmit="return confirm('Deseja realmente remover esse exerccio?');">
					<input type="hidden" name="tipoexercicioid" value="<?php echo $linha['idtipoexercicio'] ?>">
					<input type="hidden" name="exercicioid" value="<?php echo $linha['idexercicio'] ?>">
					<input type="hidden" name="alunoid" value="<?php echo $linha['idaluno'] ?>">
					<button type="submit"> - </button>
				</form>
			</td>
		</tr>
<?php
			}
		}
 ?>
		<tr>
			<td>&nbsp;</td>

			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
<?php
}
?>
</table>
<?php
}
?>
</fieldset>
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>
