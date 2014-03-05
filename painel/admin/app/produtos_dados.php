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
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="produtos.php">Produtos</a>  <?=($dados[$Config['id']]>0)?'Editar: '.$dados[$Config['titulo']]:'Adicionar';?>
</div>
<div id="conteudo">
<?

	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');

	
	# Area -> 
	
	$Areas=array();
	$a1 = db_consulta("select concat(c.categoria, ' >> ', s.subcategoria) as categoria_subcategoria, s.id_subcategoria from tbprodutos_categorias c, tbprodutos_subcategorias s where c.id_categoria = s.categoria and s.subcategoria <> 'Todos'");
	while ($b1=db_lista($a1)) $Areas[$b1['categoria_subcategoria']]=$b1['id_subcategoria'];

	
	# Montando os Dados
	$campos = array(
	#	0=>Tipo			1=>Titulo							2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário		6=>Atributos
		array('text',		'Nome',							'nome',				'500',			'',					'',					''),
		array('text',		'Pre&ccedil;o',					'preco',			'200',			'',					'',					'id=preco'),
		array('textarea',	'Descri&ccedil;&atilde;o',		'descricao',		'350',		   	'',					'',					''),
		array('file',		'Imagem',						'foto1',			'350',			'',					'',					''),
		array('select',		'Subcategoria',					'id_subcategoria',	'250',			$Areas,				'',					''),
		array('text',		'Cor 1',						'cor1',				'500',			'',					'',					'id="cor1" class="color"'),
		array('text',		'Cor 2',						'cor2',				'500',			'',					'',					'id="cor2" class="color"'),
		array('text',		'Cor 3',						'cor3',				'500',			'',					'',					'id="cor3" class="color"'),
		array('a',		    'Adicionar Cor',				'addCor',				'',			'',					'',					''),
	);
	

	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);

?>
</div>
<?
	include('../includes/Rodape.php');
?>
<script type="text/javascript" src="../js/jquery.maskMoney.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
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
			if(inputColor == 2){
				$(".addCor").hide();
			}
			
			inputColor++
			$(".cor"+inputColor).show();
		})
	});
</script>
<script type="text/javascript" src="../js/jscolor.js"></script>
<style>
	<?if($dados['cor2'] == NULL){
		echo ".cor2{display: 'none';}";
	}
	
	if($dados['cor3'] == NULL){
		echo ".cor3{display: 'none';}
			 #addCor{display:none;}
		";
	}?>
	
</style>
