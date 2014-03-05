
<?php
	include "topo.php";
	$id = $_GET['id'];
	$dados = mysql_fetch_array(mysql_query("select * from tbprodutos where id = $id"));
	if(sizeof($dados) == 0){
		Header("Location:produtos.php");
	}
?>
	<link rel="stylesheet" href="css/rfverproduto.css" />
	<link rel="stylesheet" href="zoom/css/zoom.css" />
	<div id="corpoTodo" class="clear container">
		<div id="fotoInformacoes" class="col-lg-12">
			<div id="foto" class="col-lg-6 col-xs-12 col-md-6 col-sm-12">
				<div id="zoom">
					<img src="painel/arquivos/produtos/<?=$dados['foto1']?>" />
				</div>
				<div id="zoomhover"><img src="painel/arquivos/produtos/<?=$dados['foto1']?>" /></div>
				<div id="miniaturas">
					<?php
					for($i = 1; $i <= 5; $i ++){
						if($dados["foto$i"] != "" && $dados["foto$i"] != null){
							echo "<img src='painel/arquivos/produtos/_miniaturas/".$dados["foto$i"]."' name='img$i' alt='".utf8_encode($dados['nome'])."' />";
							echo "<img src='painel/arquivos/produtos/".$dados["foto$i"]."' id='img$i' style='display: none;'>";
						}
					}
					?>
				</div>
			</div>
			<div id="informacoes" class="col-lg-6 col-xs-12 col-md-6 col-sm-12">
				<form action="cart.php?type=add" method="post">
					<input type="hidden" name="id" value="<?=$dados['id']?>" />
					<input type="hidden" name="nome" value="<?=utf8_encode($dados['nome'])?>" />
					<input type="hidden" name="foto1" value="<?=$dados['foto1']?>" />
				<h3 class="corTitulo text-center"><?=utf8_encode($dados['nome'])?><!--JG Colcha Matelassê Premier Malha Grafite HD - Solteiro--></h3>
				<p class="codigo text-center">Cód. do produto: <?=$dados['id']?></p>
				<div id="precos col-lg-12 text-center">

					<div id="parcelas" class="text-center">
						<?php
							if($dados['variacoes'] != "" && $dados['variacoes'] != null){
								$checkbox = explode(';',$dados['variacoes']);
								for($i = 0; $i < sizeof($checkbox); $i++){
									$idCheck = str_replace(" ","",$checkbox[$i]);
									$sqlVariacao = "select * from tbprodutos_variacoes where id=".$idCheck;
									$dadosVariacao = mysql_fetch_array(mysql_query($sqlVariacao));
									echo "<p style='overflow: hidden;' class='text-center'><label><input type='radio' checked name='variacao' value='".$dadosVariacao['variacao']."' />".$dadosVariacao['variacao']."</label></p>";
								}
							}else{
								echo "<input type='hidden' name='variacao' value='Único' />";
							}

						?>
					</div>
				</div>
				<div class="pull-right" style="margin: 15px 0 0 30px;">
					<span class="forma">Formas de Pagamento</span><br>
					<span class="cartoes">Cart&otilde;es de Cr&eacute;dito</span><br>
  					<img src="img/cielo.png" alt="Cielo" />
				</div>
				<div class="clearfix"></div>
				<div id="escolherQuantidade" class="text-center">

					<div id="inputNumber" class="aoLado">
						<p>Escolha a quantidade</p>
						<input type="text" id="qtd" name="qtd" value="1" readonly />
						<div id="controls">
							<div class="qtdMore"></div>
							<div class="qtdLess"></div>
						</div>
					</div>
					<input type="submit" class="btn btn-success aoLado" value="Fazer Pedido Agora!" />
					</form>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div id="descricao" class="setorAbas">
			<div class="topoAba">
				<span class="aba">
					DESCRIÇÃO DO PRODUTO
				</span>
			</div>
			<div class="conteudoAba">
				<p><?=utf8_encode($dados['descricao'])?></p>
			</div>
			<div class="bottomAba">
				<span class="voltarTopo">
					VOLTAR AO TOPO
				</span>
			</div>
		</div>

		<div id="relacionados" class="setorAbas">
			<div class="topoAba">
				<span class="aba">
					QUEM VIU, VIU TAMBÉM
				</span>
				<div class="pull-right controlesRelacionados">
					<button id="butanona" class="controleEsquerda"></button>
					<button id="butonona" class="controleDireita"></button>
				</div>
			</div>
			<div class="cycle-slideshow abaProdutosRelacionados conteudoAba"
						data-cycle-fx=carousel
						data-cycle-timeout=0
						data-cycle-next='#butonona'
						data-cycle-prev='#butanona'
						data-cycle-slides='.produtoRelacionado'
						data-cycle-carousel-visible=4
						data-allow-wrap=false
						style="max-height: 906px;"

			>
				<?php
				$sqlProdutosRelacionados = "select * from tbprodutos where id <> $id and id_categoria = ".$dados['id_categoria'];
				$result = mysql_query($sqlProdutosRelacionados);
				while ($dados2 = mysql_fetch_array($result)) {
				?>
					<div class="produtoRelacionado">
						<a href="verproduto.php?id=<?=$dados2['id']?>">
							<img src="painel/arquivos/produtos/_miniaturas/<?=$dados2['foto1']?>" alt="<?=$dados2['nome']?>" />
						</a>
						<br />
						<a href="verproduto.php?id=<?=$dados2['id']?>" class="saibaMais">Saiba Mais</a>
					</div>
				<?php
				}
				?>
			</div>
			<div class="bottomAba">
				<span class="voltarTopo">
					VOLTAR AO TOPO
				</span>
			</div>
		</div>
	</div>
	<?php include "scripts.php" ?>
	<script type="text/javascript" src="zoom/js/jquery.zoom.js"></script>
	<script>
		$(function(){

			$(".qtdMore").click(function(){
				var qtd = parseInt($("#qtd").val());
				$("#qtd").val(qtd+1);
			});

			$(".qtdLess").click(function(){
				var qtd = parseInt($("#qtd").val());
					if(qtd > 1)
						$("#qtd").val(qtd-1);
			});

			$(".voltarTopo").click(function(){
				$("html, body").animate({ scrollTop: 0 }, 600);
				return false;
			});

			$("select").change(function(){
				$(this).css('background-color', "#" + $(this).val());
				if($(this).val() == 'Selecione a Cor'){
					$(this).css('background-color', "#FFFFFF");
				}
			})

			$("#miniaturas img").hover(function(){
				var id = $(this).attr('name');
				var imagem = $("#"+id).attr('src');
				$("#zoom img, #zoomhover img").attr('src',imagem);
				$("#zoomhover").css("background-image","url("+imagem+")");
			});

		});
	</script>
<?include "rodape.php"?>