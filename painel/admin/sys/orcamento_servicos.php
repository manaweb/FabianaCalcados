<? 
	define('ID_MODULO',105,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'orcamento_servicos',
		'tabela'=>'orcamento-servicos',
		'titulo'=>'Servicos',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>Servi&ccedil;os de Or&ccedil;amentos</h2>
                    </div>
<div id="conteudo">

<a  id="btnalt" href="orcamento_servicos_dados.php"><img src="../img/add.png" align="absmiddle" /> Adicionar Novo Servi&ccedil;o para p&aacute;gina de Or&ccedil;amentos</a>
<br />
<br />

<?

 


	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título				2=>Fonte			3=>Url
		array('texto',		'SERVI&Ccedil;O',		'nome',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM tborcamento_servicos ORDER BY id DESC";


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