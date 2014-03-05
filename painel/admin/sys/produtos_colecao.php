<? 
	define('ID_MODULO',86,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'produtos_colecao',
		'tabela'=>'tbprodutos_colecao',
		'titulo'=>'colecao',
		'id'=>'id_colecao',
		'urlfixo'=>'', 
		'pasta'=>'',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Cole&ccedil;&otilde;es de Produtos</h2>
                    </div>
<div id="conteudo">

<a  id="btnalt" href="produtos_colecao_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Nova Cole&ccedil;&atilde;o</a>
<br />
<br />

<?

 


	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título		2=>Fonte			3=>Url
		array('texto',		'COLE&Ccedil;&Otilde;ES',		'nome',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM tbprodutos_colecao ORDER BY nome DESC";


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