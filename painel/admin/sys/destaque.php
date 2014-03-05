<? 
	define('ID_MODULO',118,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'destaque',
		'tabela'=>'destaque',
		'nome'=>'titulo',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'destaque',
	);

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="destaque.php">Publicidade</a> &rsaquo; <a href="destaque.php">Destaques</a> &rsaquo; Consultar
</div>
<div id="conteudo">
<?
	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');




	// -----------------------------------------------------------------------------------------------------------
	// Listagem
	// -----------------------------------------------------------------------------------------------------------

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>TÃ­tulo			2=>Fonte			3=>Url
		array('texto',		'T&Iacute;TULO',	'titulo',			''),
		array('foto',		'IMAGEM',			'arquivo',			''),
	);


	# Consulta SQL
	/*$SQL = "SELECT * FROM ".$Config['tabela']." WHERE 1 ".$busca." ORDER BY titulo ASC";*/
	
	
	$SQL = "SELECT * FROM destaque";
	
	# Processando os dados
	$Lista = new Consulta($SQL,20,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir','editar'),$Config,true);



	# Paginação
	echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';


?>
</div>
<? include('../includes/Rodape.php'); ?>