<? 
	define('ID_MODULO',86,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'produtos_categoria',
		'tabela'=>'tbprodutos_categoria',
		'tabela2'=>'tbprodutos_categoria',
		'nome'=>'categoria',
		'id'=>'id_categoria',
		'urlfixo'=>'', 
		'pasta'=>'',
	);


	if ($_GET['ID']>0) {
		$dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	}

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="produtos_categoria.php">Produtos</a> &rsaquo; <a href="produtos_categoria.php">Categorias</a> &rsaquo; Consultar
</div>
<div id="conteudo">
<?

	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');

	
	# Area -> 
	
	$Areas=array();
	$a1 = db_consulta("SELECT * FROM tbprodutos_colecao ORDER BY nome ASC");
	while ($b1=db_lista($a1)) $Areas[$b1['nome']]=$b1['id_colecao'];

	
	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('select',		'Cole&ccedil;&atilde;o',	'id_colecao',			'250',			$Areas,				'',											''),
		array('text',		'Categoria', 'nome',			'500',			'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);

?>
</div>
<?
	include('../includes/Rodape.php');
?>