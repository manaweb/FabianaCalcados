<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>RF - Casa & Cia</title>
		<link rel="stylesheet" type="text/css" href="css/rfprodutos.css">
		<link rel="stylesheet" type="text/css" href="css/rfcasacia.css">	
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="css/rfcasaciaie.css" type="text/css" media="screen"/>
		<![endif]-->
		<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
		<script type="text/javascript" src="js/jquery.cycle2.js"></script>
		<script type="text/javascript" src="js/jquery.cycle2.carousel.js"></script>
		<?php
			include("php/config/config.php");
			include("painel/includes/BancoDeDados.php");
			$conexao = db_conectar(); 
		
		?>
		
	</head>

	<body>
		<div id="wrapper">
			<div id="bannerTopo" class="bannerTopo">
				<ul>
					<li></li>
				</ul>
			</div>
			<div id="topo" class="topo">
				<div id="topoConteudo" class="conteudo">
					<ul>
						<li><a href="index.php">HOME</a> <span class="barra">|</span></li>
						<li><a href="empresa.php">EMPRESA</a> <span class="barra">&nbsp;</span></li>
						<li class="logo">
							<a href="javascript:void(0);">
								<img src="img/logo.png">
							</a>
						</li>
						<li><a href="">PRODUTOS</a> <span class="barra">|</span></li>
						<li><a href="contato.php">FALE CONOSCO</a> <span class="barra">&nbsp;</span></li>
						
					</ul>
				</div>
			</div>
			<div id="corpo">
				<div id="corpoConteudo" class="conteudo">
					<div id="bannerGrupo1" class="espacoBanner">
						<div id="bannerCorpo" class="bannerEsquerda bannerCorpo_1-1 cycle-slideshow"
												data-cyle-slides="> a"
												data-cyle-pager="#pagerBanner"
						>
							<?
							$sqlBanner = "select * from tbpublicidade";
							$result = mysql_query($sqlBanner);
							while($dadosBanner = mysql_fetch_array($result)){
								$link = $dadosBanner['destino'] == "" ? "" : "href='".$dadosBanner['destino']."' target='_blank'";
							?>
							<a <?=$link?>>
								<img src="painel/arquivos/banner/<?=$dadosBanner['arquivo']?>" alt="<?=utf8_encode($dadosBanner['titulo'])?>"/>
							</a>
							<?}?>
						</div>
						<div id="pagerBanner" class="pagerBanner"></div>
						<div id="bannerCorpo2" class="bannerDireita bannerCorpo_1-2">
							<img src="img/banner3.jpg">
						</div>
					</div>
					<div id="bannerGrupo2">
						<div id="instagram" class="bannerEsquerda bannerCorpo_2-1">
							<div class="instagram">
								<h2>A loja</h2> 
								<p>
									<img src="img/fotos_instagram.png">
								</p>
							</div>
						</div>
						<div id="colecao" class="bannerEsquerda bannerCorpo_2-2">
							<div class="colecao">
								<h1><span class="fonteConfira">Conheça</span> a nova coleção <span class="destaque">2013</span></h1>
								<button class="confira">CONFIRA</button>
							</div>
						</div>
						<div id="telefone" class="bannerEsquerda bannerCorpo_2-3">
							<div class="telefone">
								<h3>Nosso Telefone <span class="destaque">16 3203 9913</span><span class="reduzirFonte">contato@rfcasaecia.com.br</span></h3>
							</div>
						</div>
						<div id="outrora" class="bannerEsquerda bannerCorpo_2-4">
							<div class="outrora">
								
							</div>
						</div>
					</div>