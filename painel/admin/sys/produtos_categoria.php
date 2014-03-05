<? 
	define('ID_MODULO',86,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'produtos_categoria',
		'tabela'=>'tbprodutos_categoria',
		'tabela2'=>'tbprodutos_colecao',
		'nome'=>'categoria',
		'id'=>'id_categoria',
		'urlfixo'=>'', 
		'pasta'=>'',
	);

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="produtos_categoria.php">Produtos</a> &rsaquo; <a href="produtos_categoria.php">Categorias</a> &rsaquo; Consultar
</div>
<div id="conteudo">
	<a  id="btnalt" href="produtos_categoria_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Nova Categoria</a>
<br />
<br />

<?
	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');




	// -----------------------------------------------------------------------------------------------------------
	// Listagem
	// -----------------------------------------------------------------------------------------------------------

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>TÃ­tulo					2=>Fonte			3=>Url
		array('texto',		'COLE&Ccedil;&Atilde;O',				'colecao',			''),
		array('texto',		'NOME DA CATEGORIA',		'nome',			''),
	);


	# Consulta SQL
	/*$SQL = "SELECT * FROM ".$Config['tabela']." WHERE 1 ".$busca." ORDER BY titulo ASC";*/
	
	
	$SQL = "
			SELECT tbprodutos_categoria.*, tbprodutos_colecao.nome as colecao
			FROM 
				tbprodutos_categoria, tbprodutos_colecao
				WHERE tbprodutos_colecao.id_colecao = tbprodutos_categoria.id_colecao
				AND	upper(tbprodutos_categoria.nome) <> upper('todos') 		
			ORDER BY 
				tbprodutos_colecao.nome ASC, 
				tbprodutos_categoria.nome ASC
		   ";
	

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