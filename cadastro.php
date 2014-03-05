<?php
	if(!isset($_POST['email']) || !isset($_COOKIE)){
		header("Location:cart.php");
	}
	$email = $_POST['email'];
	
	if (isset($_COOKIE['produto_']))
		unset($_COOKIE['produto_']);

	$cookies = array();
	$i = 0;
	foreach($_COOKIE as $key => $value){
		if('produto_' == substr($key, 0, 8)){
			$cookies[$i] = $key;
			$i++;
		}
	}
	
	include "topo.php";
?>

<div id="corpoTodo" class="clearfix container">
	<div class="col-lg-12">
	<link rel="stylesheet" href="validator/css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="css/cadastro.css" />
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pedido">
		<h3>Orçamento realizado em <?php
		date_default_timezone_set('America/Sao_Paulo'); 
		echo date('d/m/Y')?></h3>
		<!--<p>Pedido: </p>-->
		<div class="cabecalhoOrcamento">Produto</div>
		<div>
			<?php
			for($i = 0; $i < sizeof($cookies); $i++){
				$meuArray = unserialize($_COOKIE[$cookies[$i]]);
				$sqlCarrinho = "select * from tbprodutos WHERE id = ".$meuArray['id'];
				$resultado = mysql_query($sqlCarrinho);
				$dadosCarrinho = mysql_fetch_array($resultado);
			?>
				<div class="produto tdProduto clear">
					<a href="verproduto.php?id=<?=$dadosCarrinho['id']?>">
						<img class="aoLadoMiddle" src="painel/arquivos/produtos/<?=$dadosCarrinho['foto1']?>" alt="" style="max-width: 100px; height: auto;" />
						<p class="tituloproduto aoLadoMiddle"><?=utf8_encode($dadosCarrinho['nome'])?></p>
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 miniCadastro">
		<fieldset>
			<h3><img src="img/dados.png" alt="Dados Pessoais"/> Dados pessoais</h3>
			<p>Solicitamos apenas as informações essenciais para o orçamento</p>
			<?php
				$sqlCadastro = "select * from tbclientes where email = '".$email."'";
				$result = mysql_query($sqlCadastro);
				$numRows = mysql_num_rows($result);
				$firstName = $lastName = $telefone = $celular = "";
				/*if($numRows > 0){
					$dadosCliente = mysql_fetch_assoc($result);
					$firstName = "value='".$dadosCliente['primeironome']."' readonly";
					$lastName = "value='".$dadosCliente['ultimonome']."' readonly";
					$telefone = "value='".$dadosCliente['telefone']."' readonly";
					$celular = "value='".$dadosCliente['celular']."' readonly";
				} */
			?>
			<form method="post" action="realizarCadastro.php">
				<label class="lblEmail">
					E-mail<br />
					<input type="email" name="email" class="input-text input-email validate[required,custom[email]]" value="<?=$email ?>" readonly />
				</label>
				<label class="lblText">
					Primeiro nome<br />
					<input type="text" name="firstName" class="input-text validate[required,minSize[4],maxSize[20]]" />
				</label>
				<label class="lblText">
					Último nome<br />
					<input type="text" name="lastName" class="input-text validate[required,minSize[4],maxSize[20]]" />
				</label>
				<label class="lblText">
					Celular<br />
					<input type="text" name="celular" id='celular' class="input-text validate[custom[phone]]" />
				</label>
				<label class="lblText">
					Telefone<br />
					<input type="text" name="telefone" id='telefone' class="maskTelefone input-text validate[required,custom[phone]]" />
				</label>
				<fieldset>
					<legend>Endereço</legend>
					<label class="lblText">
						CEP<br />
						<input type="text" name="cep" id='cep' class="input-text validate[required]" />
					</label>
					<span id="btnBuscarCep" class="btn btn-default">Buscar</span>
					<label class="lblText logradouro">
						Logradouro<br />
						<input type="text" name="logradouro" id='logradouro' class="input-text validate[required]" />
					</label>
					<label class="lblText">
						Nº/Complemento<br />
						<input type="text" name="numero" id='numero' class="input-text validate[required]" />
					</label>
					<label class="lblText">
						Bairro<br />
						<input type="text" name="bairro" id='bairro' class="input-text validate[required]" />
					</label>
					<label class="lblText">
						Cidade<br />
						<input type="text" name="cidade" id='cidade' class="input-text validate[required]" />
					</label>
					<label class="lblText">
						Estado<br />
						<input type="text" name="estado" id='estado' maxlength="2" class="input-text validate[required]" />
					</label>
					
				</fieldset>
				<div class="lblSubmit">
					<input type="submit" class="fazerPedido btn btn-success" value="Fechar Orçamento"/>
				</div>
			</form>
		</fieldset>
	</div>
	<div class="clearfix"></div>
</div>
</div>
<?php include "scripts.php" ?>
<script src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
<script src="validator/js/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
<script src="validator/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
	$(function(){
		$('form').validationEngine('attach');
		$("#celular").mask("(99) 99999-9999");
		$(".maskTelefone").mask("(99) 9999-9999");
		$("#cep").mask("99.999-999");
	});
</script>
<?php include "rodape.php";?>