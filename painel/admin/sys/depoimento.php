<? 
	define('ID_MODULO',112,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'depoimento',
		'tabela'=>'depoimento',
		'nome'=>'depoimento',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'depoimento',
	);

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="depoimento.php">Depoimentos</a> &rsaquo; Consultar
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
		array('texto',		'NOME',				'nome',				''),
		array('texto',		'EMPRESA',			'empresa',			''),
		array('texto',		'CARGO',			'cargo',			''),
		array('texto',		'MENSAGEM',			'mensagem',			''),
		array('foto',		'FOTO',				'imagem',			''),
	);


	# Consulta SQL
	/*$SQL = "SELECT * FROM ".$Config['tabela']." WHERE 1 ".$busca." ORDER BY titulo ASC";*/
	
	
	$SQL = "
			select * from depoimento order by id desc
		   ";
	
	
	

	# Processando os dados
	$total = mysql_num_rows(mysql_query($SQL));
	$Lista = new Consulta($SQL,$total,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir', 'status'),$Config,false);



	# Paginação
	//echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';


?>
</div>
<? include('../includes/Rodape.php'); ?>