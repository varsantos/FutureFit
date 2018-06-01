<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<div id="fundo-externo" class="bg-zindex">
			<div id="fundo">
				<img src="Backgound Images/gym4.jpg" alt=""/>
			</div>
		</div>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>FutureFit</title>
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
		<script src="js/modernizr.custom.js"></script>
	</head>
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
							<li><a href="Tela Login\Login Professor\escolhaprofessor.html" class="gn-icon gn-icon-pictures">Área do professor</a></li>
							<li><a class="gn-icon gn-icon-help">Dúvidas</a>							</li>
						</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<li><a href="index.html">Home</a></li>
				<li><a>Bem Vindo a Future Fit</a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="https://www.vix.com/pt/bdm/saude/10-jeitos-de-tomar-mais-agua-dicas-que-vao-melhorar-muito-seu-consumo"><span>Hidrate-se</span></a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="Tela Login/Login A+P/Loginescolha.html" ><span>Logout</span></a></li>
			</ul>
			</div><!-- /container -->
			<div ice:editable="align_center">
				<form id="form1" name="dados" method="post" action="consulta_treino.php">
					<br><br>
					<div align="left">
						<br><br>
						<fieldset class="fieldset-conta">
							<p>
								<h1>
								<center>
								Treino do aluno
								</center>
								</h1>
							</p>
							<p>Dados do aluno:</p>
							
							<style type="text/css">
							.tabela {
							font-family: Verdana, Arial, Helvetica, sans-serif;
							font-size: 12px;
							}
							</style>
							Insira seus dados para carregar os exercícios:
							<input type="number" name="matricula" maxlength="40" >
							<br>
<?php
	if (isset($_GET['matricula'])) {
		if ($_GET['matricula']) {

			$host = "localhost:3306";
			$user = "root";
			$pass = "";
			$banco = "futurefit";
			$conn = new mysqli($host, $user, $pass, $banco);
			// Check connection

			// Caso tenho encontrado 
			$sqlAluno = "
				SELECT 
					*
				FROM alunos a
				WHERE a.idaluno = {$_GET['matricula']}
			";
			$resAluno = $conn->query( $sqlAluno );

			if ($resAluno->num_rows > 0) {
				$Aluno = $resAluno->fetch_assoc();
?>
							<p>Aluno: <span  style="color: #f44; font-weight: 600;">
								<?php echo $Aluno['nome']; ?>
							</span></p>
							<br>
							<input size="40" type="button" value="Carregar treino">
							<table id="exerciciostbl" style="width: 100%; border-collapse: collapse;" border="1">
								<thead>
									<tr>
										<td colspan="4">
											<caption>Treinos semanais</caption>
										</td>
									</tr>
									<tr>
										<th>Treino</th>
										<th>Exercicio</th>
										<th>Series</th>
										<th>Repeti&ccedil;&otilde;es</th>
									</tr>
								</thead>
								<tbody>
<?php
				
				// Caso o aluno tenha sido encontrado...
				$sqlExercicios = "
					SELECT 
						a.*, 
					    ae.series,
					    ae.repeticoes,
					    e.nome AS nome_exercicio,
					    et.nometipo, 
					    p.nome AS nome_professor
					FROM alunos_exercicios ae
					INNER JOIN alunos a ON a.idaluno = ae.alunoid
					INNER JOIN exercicios e ON e.idexercicio = ae.exercicioid
					INNER JOIN execiciotipos et ON et.idtipoexercicio = tipoexercicioid
					LEFT JOIN professores p ON p.idprofessor = a.professorid
					WHERE ae.alunoid = {$_GET['matricula']}
				"; 
				 
				# Executa a sqlExercicios desejada 
				$resExercicios = $conn->query( $sqlExercicios ) or die(' Erro na sqlExercicios:' . $sqlExercicios); 

				if ($resExercicios->num_rows > 0) {


					while ($linha = $resExercicios->fetch_assoc()) {
?>
									<tr>
										<td><?php echo $linha['nometipo']; ?></td>
										<td><?php echo $linha['nome_exercicio']; ?></td>
										<td><?php echo $linha['series']; ?></td>
										<td><?php echo $linha['repeticoes']; ?></td>
									</tr>
<?php
				    }
				} else {
?>
									<tr>
										<td colspan="4">
											<p style="color: #f44; font-weight: 300;">Nenhum exercicio encontrado!</p>
										</td>
									</tr>
<?php
				}
?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">
											<button onclick="return validar()" type="submit">Enviar</button>
											<!-- <input type="submit" size="30" onclick="return validar()" name="submit" value="Enviar"/> -->
										</td>
									</tr>
								</tfoot>
								
							</table>
<?php
			} else {echo '<p>Falhou ao buscar pelo aluno</p>';}
		} else {
			//Caso nao tenha encontrado
?>
							<p style="color: #f44; font-weight: 600;">Matr&iacute;cula nao encontrada!</p>
<?php
		}
	}
?>
						</form>
					</fieldset>
				</div>
				
				</div><!-- /container -->
				<script src="js/classie.js"></script>
				<script src="js/gnmenu.js"></script>
				<script>
					new gnMenu( document.getElementById( 'gn-menu' ) );
				</script>
			</body>
		</html>