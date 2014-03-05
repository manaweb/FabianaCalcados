<?
include "topo.php"; 
include "orcamento/cart/produto.class.php";
include "orcamento/cart/carrinho.class.php";

$Cart = new Carrinho;

if (isset($_COOKIE['produto_']))
	unset($_COOKIE['produto_']);

if (isset($_POST)){
	$Produto = new Produto($_POST);
	$Cart->AddCart($Produto);
}
if(@$_GET['type'] == 'add'){
	header("Location: cart.php");
}else if(@ $_GET['type'] == 'remove'){
	$id = $_GET['id'];
	setcookie("produto_$id",NULL);
	header("Location: cart.php");
}
$cookies = array();
$i = 0;
foreach($_COOKIE as $key => $value){
	if('produto_' == substr($key, 0, 8)){
		$cookies[$i] = $key;
		$i++;
	}
}

?>
<div id="corpoTodo" class="clearfix container">
	<link rel="stylesheet" href="css/cart.css" />
	<div class="col-lg-12">
	<table class="table-responsive">
		<thead>
			<tr>
				<th>Produto</th>
				<th>Código do Produto</th>
				<th>Variação</th>
				<th>Quantidade</th>
				<!--<th>Total</th>-->
				<th></th>
			</tr>
		</thead>
		<tbody>
				<?php
				if(sizeof($cookies) == 0){
						echo "<tr><td class='empty'>Você não possui nenhum produto no carrinho</td><td></td><td></td><td></td><td></td></tr>";
				}else{
					for($i = 0; $i < sizeof($cookies); $i++){
						$meuArray = unserialize($_COOKIE[$cookies[$i]]);
						$sqlCarrinho = "select * from tbprodutos WHERE id = ".$meuArray['id'];
						$resultado = mysql_query($sqlCarrinho);
						if(mysql_num_rows($resultado) > 0){
							$dadosCarrinho = mysql_fetch_array($resultado);
					?>
							<tr>
								<td class="tdProduto">
									<input type="hidden" value="<?=$meuArray['id']?>" class="idProduto" />
									<a href="verproduto.php?id=<?=$dadosCarrinho['id']?>">
										<img src="painel/arquivos/produtos/<?=$dadosCarrinho['foto1']?>" alt="" class="img-responsive" style="max-width: 100px; height: auto;" />
										<p class="tituloproduto"><?=utf8_encode($dadosCarrinho['nome'])?></p>
									</a>
								</td>
								<td class="tdCod">
									<span class="vUnitario"><?=$meuArray['id']?></span>
								</td>
								<td class="tdPreco">
									<span class="vUnitario" style="font-weight: bold;"><?=utf8_encode($meuArray['variacao'])?></span>
								</td>
								<td class="tdQtd">
									<a class="menos"></a>
									<input type="text" name="qtd" readonly value="<?=$meuArray['qtd']?>" class="qtdCart" />
									<a class="mais"></a>
								</td>
								<!--<td>
									R$ <span class="vTotal"><?//=($dadosCarrinho['preco'] * $meuArray['qtd'])?></span>
								</ td>-->
								<td><a href="javascript:void(0)" class='remover' id='<?=$dadosCarrinho['id']?>'>X</a></td>
							</tr>
			<?php 	
						}else{
							setcookie("produto_".$meuArray['id'],NULL);
						}
					}
				} 
				
				?>
			
		</tbody>
	</table>
	</div>
	<!--<div class="totais">
		<p class="subtotal">Subtotal<input type="text" value="" class="subtotalGeral"/></p>
		<p class="total">Total <input type="text" value="" class="totalGeral"/></p>
	</div>-->
	<div class="clear fecharPedido">
		<a class="btn btn-warning" href="colecao.php">Escolher mais produtos</a>
		<a class="btnFinalizar btn btn-success" href="javascript:void(0)">Finalizar Orçamento</a>
	</div>
	<div class="clear"></div>
</div>
<?php include "scripts.php"; ?>
<script>
	$(function(){
		if($(".empty").text() == "Você não possui nenhum produto no carrinho"){
			$(".btnFinalizar").hide();
		}
		calcularTotais();
		$(".mais").click(function(){
			var columnIndex = $('.mais').index(this);
			var vUnitario = parseFloat($(".vUnitario").eq(columnIndex).text().replace(",","."));
			var qtd = parseInt($(".qtdCart").eq(columnIndex).val());
			$(".qtdCart").eq(columnIndex).val(qtd+1);
			var total = vUnitario * (qtd+1);
			$('.vTotal').eq(columnIndex).text((total.toFixed(2)).toString().replace(".",","));
			
			calcularTotais();
			
		});
		
		$(".menos").click(function(){
			var columnIndex = $('.menos').index(this);
			var vUnitario = parseFloat($(".vUnitario").eq(columnIndex).text().replace(",","."));
			var qtd = parseInt($(".qtdCart").eq(columnIndex).val());
			if(qtd > 1){
				$(".qtdCart").eq(columnIndex).val(qtd-1);
				var total = vUnitario * (qtd-1);
				$('.vTotal').eq(columnIndex).text((total.toFixed(2)).toString().replace(".",","));
			}
			calcularTotais();
		});
		
		function calcularTotais(){
			var total = 0;
			var valor = 0;
			$(".vTotal").each(function(){
				valor = parseFloat($(this).text().replace(",","."));
				total += valor;
			})
			$(".subtotalGeral, .totalGeral").val((total.toFixed(2)).toString().replace(".",","));
		}

		$(".remover").click(function(){
			if(confirm("Deseja mesmo remover este item do carrinho?")){
				window.location = 'cart.php?type=remove&id=' + $(this).attr('id');
			}
		})

		$(".btnFinalizar").click(function(){
			var produtos = new Array();
			var quantidades = new Array();
			for(i = 0; i < $(".idProduto").size();i++){
				produtos[i] = $(".idProduto").eq(i).val();
				quantidades[i] = $(".qtdCart").eq(i).val();
			}
			window.location = "cadastrar.php?id="+produtos+"&qtd="+quantidades;
		})
	});
</script>
<?include "rodape.php"; ?>