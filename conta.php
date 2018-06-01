<!DOCTYPE html>
	<html lang="en" class="no-js">
	<head>
		<div id="fundo-externo" class="bg-zindex">
			<div id="fundo">
				<img src="Backgound Images/gym3.jpg" alt=""/>
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
							<li><a href="Tela Login/Login A+P/Loginescolha.html" class="gn-icon gn-icon-pictures">Área do professor</a></li>
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
			<script src="js/classie.js"></script>
			<script src="js/gnmenu.js"></script>
			<script>
				new gnMenu( document.getElementById( 'gn-menu' ) );
			</script>
			</div><!-- /gn-scroller -->
			<li><a href="index.html">Home</a></li>
			<li><a class="codrops-icon codrops-icon-prev" href="Tela Login/Login A+P/Loginescolha.html"><span>Logout</span></a></li>
			<li><a class="codrops-icon codrops-icon-drop" href="https://www.vix.com/pt/bdm/saude/10-jeitos-de-tomar-mais-agua-dicas-que-vao-melhorar-muito-seu-consumo"><span>Hidrate-se</span></a></li>
			<style type="text/css">
			.tabela {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 12px;
			}
			</style>
		<body>
			<br>
	<fieldset class="fieldset-conta">
			<br><br><br><br><br><br><br>
			<center>
			<h2 style=" font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: 28px;">Informações da conta</h2></center>
<?php
	if (isset($_GET['criar_conta'])) {
		if ($_GET['criar_conta']) {
?>
				<p style="color: rgb(80,255,80); font-weight: 600; font-size: 14pt;">Conta criada com sucesso!</p>
<?php
		} else {
?>
				<p style="color: rgb(255,80,80); font-weight: 600; font-size: 14pt;">Falha ao criar sua conta :/ !</p>
<?php
		}
	}
?>
				<p>Dados do aluno:</p>
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
		for(i=0; i < maskedEmail.length; i++){
			if ( i <= 1 || previous == "." || previous == "@"){
				maskedEmail[i] = email[i];
			}
			previous = email[i];
		}
		console.log(maskedEmail.join(''));
		return maskedEmail.join('');
	}
</script>
				<form id="form1" name="dados" method="post" action="enviadadosaluno.php">
					<table width="201" height="170" border="0" cellspacing="0" class="tabela">
						<tr>	
							<td height="10" colspan="4" valign="top">Aqui voce pode alterar seus dados cadastrais:
							</td>
						</tr>
						<tr>
							<td height="35">Nome:</td>
							<td><input type="text" name="nome" maxlength="40" ></td>
							<td>
								<label for="Matricula"> Nº da matricula</label>
								<select id="idmatricula">
									<option value="matricula">Matricula </option>
								</select>
							</td>
						</tr>
						<tr>
							<td height="35">CPF:</td>
							<td>
								<input type="text" name="cpf" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" >
							</td>
						</tr>
						<tr>
							<td height="35">E-mail:</td>
							<td><input type="text" name="email" maxlength="50" ></td>
						</tr>
						<tr>
							<td height="35">Endereço:</td>
							<td><input type="text" name="endereco" maxlength="50" ></td>
						</tr>
						<tr>
							<td height="35">Cep:</td>
							<td><input type="text" name="cep" maxlength="9" OnKeyPress="formatar('#####-###', this)" ></td>
						</tr>
						<tr>
							<td height="35">Tel.:</td>
							<td><input type="text" name="telefone" maxlength="15" OnKeyPress="formatar('##-#####-####', this)" ></td>
						</tr>
						<tr>
							<td width="35" height="35">Data de nascimento:(DD/MM/AAAA)</td>
							<td width="265"><input type="text" name="datanasc" maxlength="10" OnKeyPress="formatar('##/##/####', this)" ></td>
						</tr>
						<tr>
							<td width="35" height="35">Sexo:</td>
							<td>
								<label><input name="sexo" type="radio" value="M"/> Masculino</label>
								<label><input name="sexo" type="radio" value="F"/> Feminino</label>
							</td>
						</tr>
						<tr>
							<td height="35">Peso atual:</td>
							<td><input type="text" name="peso" maxlength="5" OnKeyPress="formatar('##,#', this)" ></td>
						</tr>
						<tr>
							<td height="35">Altura:</td>
							<td><input type="text" name="altura" maxlength="6" OnKeyPress="formatar('###,##', this)" ></td>
						</tr>
						<tr>
							<td height="35">Nome do professor</td>
							<td>
								<select name="professor" id="idprofessor">
									
								</select>
							</td>
						</tr>
						<tr>
							<td height="35">Objetivo:</td>
							<td>
								<select name="objetivo" id="objetivo">
									<option value="Selecione seu objetivo">Selecione seu objetivo</option>
									<option value="Perda de Peso">Perda de Peso</option>
									<option value="Ganho de massa muscular, Hipertrofia">Ganho de massa muscular, Hipertrofia</option>
									<option value="Cardiovascular">Cardiovascular</option>
									<option value="Manter físico">Manter físico</option>
									<option value="Aumentar nível de força">Aumentar nível de força</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<p>Deixar mensagem:(Opcional)</p>
							</td>
							<td>
								<textarea type="text" name="msg"  style="resize:none" rows="6" cols="55" size="140" maxlength="400" placeholder="Deixe uma mensagem para o professor"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<button onclick="return validar()" type="submit">Enviar</button>
								<!-- <input type="submit" size="30" onclick="return validar()" name="submit" value="Enviar"/> -->
							</td>
						</tr>
					</table>
				</form>
			</fieldset>
			</div><!-- /container -->
			<script src="js/classie.js"></script>
			<script src="js/gnmenu.js"></script>
			<script>
				new gnMenu( document.getElementById( 'gn-menu' ) );
			</script>
		</body>
	</html>