<? 
	define('ID_MODULO',115,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	include('../includes/tinyMCE_advanced.php');

	$Config = array(
		'arquivo'=>'banner_secundario',
		'tabela'=>'banner_secundario',
		'titulo'=>'titulo',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'banner_secundario',
	);


	if ($_GET['ID']>0) {
		$dados = db_dados("SELECT * FROM ".$Config['tabela']." WHERE ".$Config['id']."=".(int)$_GET['ID']." LIMIT 1;");
	}

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="banner_secundario.php">Publicidade</a> &rsaquo; <a href="banner_secundario.php">Banner Secund&aacute;rio</a> &rsaquo; <?=($dados[$Config['id']]>0)?'Editar: '.$dados[$Config['titulo']]:'Adicionar';?>
</div>
<div id="conteudo">
<?

	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');

	
	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo		2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos										''),
		array('text',		'T&iacute;tulo','titulo',			'500',			'',					'',											''),
		array('text',		'URL',			'destino',			'200',			'',					'',											''),
		//array('text',		'Largura X:',	'dimx',				'100',			'',					'pixels',									''),
		//array('text',		'Largura Y:',	'dimy',				'100',			'',					'pixels',									''),
		array('file',		'Arquivo',		'arquivo',			'350',		   	'',					'Largura: 702px X Altura: 306px',			''),
	);


	# Exibindo os campos
	echo adminCampos($campos,$Config,$dados);

?>
</div>
<?
	include('../includes/Rodape.php');
?>