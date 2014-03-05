<? 
	define('ID_MODULO',86,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'produtos',
		'tabela'=>'tbprodutos',
		'titulo'=>'produtos',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'produtos',
	);


	if ($_GET['ID']>0) {
		$dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	}

?>
<style>
	img{
		max-width: 350px;
	}
	.btnExcluirImagem {
		margin-left: 11px;
	}
	#fundoPreto{
		background: #000;
		opacity: 0.7;
		filter: alpha(opacity=70);
		position: absolute;
		width: 100%;
		top: 0;
		z-index: 999999999;
	}
	#fundoPreto img{
		position: fixed;
		left: 50%;
		margin-left: -20px;
		top: 50%;
		margin-top: -20px;
		width: 40px;
	}

</style>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="produtos.php">Produtos</a>  <?=($dados[$Config['id']]>0)?'Editar: '.$dados[$Config['titulo']]:'Adicionar';?>
</div>
<div id="conteudo">
<?

	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');

	
	# Area -> 
	
	$Areas=array();
	$a1 = db_consulta("select concat(co.nome, ' >> ', cat.nome) as colecao_categoria, cat.id_categoria from tbprodutos_categoria cat, tbprodutos_colecao co where co.id_colecao = cat.id_colecao and cat.nome <> 'Todos'");
	while ($b1=db_lista($a1)) $Areas[$b1['colecao_categoria']]=$b1['id_categoria'];
	
	$variacoes=array();
	$a1 = db_consulta("Select * from tbprodutos_variacoes");
	while ($b1=db_lista($a1)) $variacoes[$b1['variacao']]=$b1['id'];

	
	# Montando os Dados
	$campos = array(
	#	0=>Tipo			1=>Titulo							2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário					6=>Atributos
		array('text',		'Nome',							'nome',				'500',			'',					'',								''),
		//array('text',		'Pre&ccedil;o',					'preco',			'200',			'',					'',								'id=preco'),
		array('textarea',	'Descri&ccedil;&atilde;o',		'descricao',		'350',		   	'',					'',								''),
		array('file',		'Imagem 1',						'foto1',			'350',			'',					'Imagem Obrigat&oacute;ria',	''),
		array('file',		'Imagem 2',						'foto2',			'350',			'',					'Imagem opcional',				''),
		array('file',		'Imagem 3',						'foto3',			'350',			'',					'Imagem opcional',				''),
		array('file',		'Imagem 4',						'foto4',			'350',			'',					'Imagem opcional',				''),
		array('file',		'Imagem 5',						'foto5',			'350',			'',					'Imagem opcional',				''),
		array('select',		'Caategoria',					'id_categoria',	'250',			$Areas,				'',								''),
		array('checkbox2',   'Varia&ccedil;&otilde;es' ,     'variacoes' ,        '500',        $variacoes,          '',                 			''),
	);
	

	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);

?>
</div>
<?
	include('../includes/Rodape.php');
?>
	<script type="text/javascript" src="../js/jquery.maskMoney.js"></script>
	<script type="text/javascript" src="../js/colorpicker.js"></script>
	<link rel="stylesheet" media="screen" type="text/css" href="../css/colorpicker.css" />
	<script type="text/javascript" src="../js/eye.js"></script>
    <script type="text/javascript" src="../js/utils.js"></script>
    <script type="text/javascript" src="../js/layout.js?ver=1.0.2"></script>

<script type="text/javascript">
	$(document).ready(function(){
		//aki começa gambi para marcar os checkbox que estão salvos
		<?php
			if ($_GET['ID']>0) {
				$x = "select variacoes from tbprodutos where id = ".$_GET['ID'];
				$dadosx = mysql_fetch_assoc(mysql_query($x));
				$checkbox = explode(";",str_replace(" ","",$dadosx['variacoes']));
				for($i = 0; $i < sizeof($checkbox); $i++){
					echo "$('#checkbox_".$checkbox[$i]."').attr('checked','checked');\n";
				}
			}
		?>


		$(".btnExcluirImagem").click(function(){
			if(!confirm('Deseja mesmo excluir essa foto?'))
				return false;
			var altura = $("html").height();
			$("body").append("<div id='fundoPreto' style='height: "+altura+"px !important';><img src='http://rfcasaecia.com.br/img/loader.gif'></div>").css('overflow', 'hidden');
			var campoImagem = $(this).attr('id');
			var imagem = $(this).attr('name');
			$.ajax({
				url: "excluirImagemProduto.php?campo="+campoImagem+"&imagem="+imagem+"&id="+<?php echo(int)$_GET['ID']?>,
				success: function(html) {
					alert("Imagem removida com sucesso");
					window.location.reload();
						
				}
			});
		})



		var inputColor = 1;
		$("#cor1, #cor2, #cor3").val("");
		$("#preco").maskMoney({showSymbol:true,symbol:"R$", decimal:".", thousands:"", allowZero:true});
		$("#cor1, #cor2, #cor3").focus(function(){
			$(this).removeClass('focus');
			$(this).addClass('color');
		});
		$("#cor1, #cor2, #cor3").blur(function(){
			$(this).removeClass('focus');
			$(this).addClass('color');
		});
		
		$("#btnalt").click(function(){
			if(inputColor < 3){
				inputColor++
				$(".cor"+inputColor).show();
			}else{
				$(".addCor").hide();
			}
		})
		
		var objColorPicker = null;
		
		$("#cor1, #cor2, #cor3").attr('value',($(this).attr('value')))
		
		$('#cor3').ColorPicker({
			color: '<?=$dados['cor3']?>',
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
				
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb, el) {
				$("#cor3").css('background', '#' + hex);
				$("#cor3").attr('value', hex);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		
		
		$('#cor2').ColorPicker({
			color: '<?=$dados['cor2']?>',
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#cor2").css('background', '#' + hex);
				$("#cor2").attr('value', hex);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		
		$('#cor1').ColorPicker({
			color: '<?=$dados['cor1']?>',
			livePreview: true,
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
				$("#cor1").attr('value', '<?=$dados['cor1']?>');
				$("#cor1").css('background', '<?=$dados['cor1']?>');
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$("#cor1").css('background', '#' + hex);
				$("#cor1").attr('value', hex);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		
		$("#cor1").attr('value', '<?=$dados['cor1']?>');
		$("#cor1").css('background', '<?=$dados['cor1']?>');
		
		$("#cor2").attr('value', '<?=$dados['cor2']?>');
		$("#cor2").css('background', '<?=$dados['cor2']?>');
		
		$("#cor3").attr('value', '<?=$dados['cor3']?>');
		$("#cor3").css('background', '<?=$dados['cor3']?>');
});
</script>
<style>
	.cor2, .cor3{
		display: none;
	}
	<?if($dados['cor2'] != NULL && $dados['cor2'] != ""){
		echo ".cor2{display: table-row !important;}";
	}
	
	if($dados['cor3'] != NULL && $dados['cor3'] != ""){
		echo ".cor3{display: table-row !important;}
			 #addCor{display: table-row !important;}
		";
	}?>
	
</style>
