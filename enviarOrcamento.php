<?php
	if(!isset($_GET['id']) || !isset($_COOKIE)){
		header("Location:cart.php");
	}
	include "topo.php";
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
	if($i == 0){
		header("Location: colecao.php");	
	}

	

?>
<style>
	.disabled{
		opacity: 0.5;
		display: inline-block !important;
	}
</style>
<div id="corpoTodo" class="clearfix container">
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
						<img class="aoLadoMiddle" src="painel/arquivos/produtos/<?=$dadosCarrinho['foto1']?>" alt="" class="img-responsive" style="max-width: 100px; height: auto;" />
						<p class="tituloproduto aoLadoMiddle"><?=utf8_encode($dadosCarrinho['nome'])?></p>
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-121 miniCadastro">
		<?php
			$sqlCadastro = "select * from tbclientes where id = ".$_GET['id']."";
			$result = mysql_query($sqlCadastro);
			$dadosCliente = mysql_fetch_assoc($result);
			$tel = "";
			if($dadosCliente['telefone'] != ""){
				$tel = $dadosCliente['telefone'];
			}else if($dadosCliente['celular'] != ""){
				$tel = $dadosCliente['celular'];
			}
		?>
		<fieldset>
			
			<h3><img src="img/dados.png" alt="Dados Pessoais"/> Dados pessoais</h3>
			<p><?=$dadosCliente['email']?></p>
			<p><?=$dadosCliente['primeironome']?> <?=$dadosCliente['ultimonome']?></p>
			<p><?=$tel?></p>
			
		</fieldset>
		<?php include "scripts.php" ?>
		<script>
		$(function(){
			$("#enviarOrcamento").click(function(){
				$(this).addClass('disabled').attr('disabled','disabled');
				$('#carregando').show();
				$.ajax({
					url: "finalizar.php?id=<?=$_GET['id']?>&email=<?=$dadosCliente['email']?>",
					success: function(html) {
						$('#carregando img').replaceWith("<div class='sucessoEnvio'>Orçamento enviado com sucesso</div>");
						$(".sucessoEnvio").fadeIn();
						window.setTimeout(function(){
							window.location='index.php'
						}, 5000);
					}
				});
			});
		});
	</script>
		<fieldset>
			<h3><img src="img/orcamento.png" alt="Orçamento" /> Orçamento</h3>
			<div class="lblSubmit">
				<button class="fazerPedido btn btn-success" id="enviarOrcamento" onclick="javascript:void(0)">Enviar Orçamento</button>
			</div>
		</fieldset>
		<div id="carregando" style="display: none; text-align: center;" class="carregando clearfix"><img src='img/loader.gif' alt='Loading' class="imgCarregando" style="max-width: 50px;" /></div>
	</div>
	<div class="clearfix"></div>
</div>
<?php include "rodape.php";?>