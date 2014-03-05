<? 
	define('ID_MODULO',110,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'servicos',
		'tabela'=>'servicos',
		'titulo'=>'servicos',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'',
	);

?>
<?
include('../includes/Mensagem.php');
?>
                	<div class="conthead">
                        <h2>"Servi&ccedil;os"</h2>
                    </div>
<div id="conteudo">

<br />
<br />

<?

 


	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>Título				2=>Fonte			3=>Url
		array('texto',		'Tipo',					'tipo',				''),
		array('texto',		'Texto',			'texto',			''),
	);


	# Consulta SQL
	$SQL = "SELECT * FROM servicos ORDER BY id DESC";


	# Processando os dados
	$Lista = new Consulta($SQL,10,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('editar'),$Config,false);



	# Paginação
	//echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';


?>
</div>
<? include('../includes/Rodape.php'); ?>