<? 
	define('ID_MODULO',105,true);
	include('../includes/Config.php');
	include('../includes/Topo.php');
 

	$Config = array(
		'arquivo'=>'orcamento',
		'tabela'=>'tborcamento',
		'titulo'=>'titulo',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'orcamento',
	);


	if ($_GET['ID']>0){ 
		$dados = db_dados("SELECT o.id, DATE_FORMAT( o.data,  '%d/%m/%Y %H:%i:%s' ) AS data, concat(primeironome, ' ',ultimonome) as cliente, c.email, c.telefone, c.cidade, c.estado, c.celular, c.logradouro, c.numero, c.bairro, c.cep 
							FROM tborcamento o, tbclientes c
							WHERE o.id = ".$_GET['ID']."
							AND o.id_cliente = c.id
							LIMIT 1;");
		db_consulta('update tborcamento set flag_status = true where id='.$_GET['ID']);
	}

?>
<?
include('../includes/Mensagem.php');
?>
<div id="conteudo">
<?

 
 


	# Montando os Dados
	$campos = array(
		#	0=>Tipo			1=>Titulo				2=>Nome Campo		3=>Tamanho(px)	4=>CampoExtra		5=>Comentário								6=>Atributos
		array('text',		'C&oacute;digo',		'id',				'300',			'',					'',											''),
		array('text',		'Cliente',				'cliente',			'300',			'',					'',											''),
		array('text',		'Email',				'email',			'300',			'',					'',											''),
		array('text',		'Telefone',				'telefone',			'300',			'',					'',											''),
		array('text',		'Celular',				'celular',			'300',			'',					'',											''),
		array('text',		'Logradouro',				'logradouro',			'300',			'',					'',											''),
		array('text',		'N&uacute;mero',				'numero',			'300',			'',					'',											''),
		array('text',		'Bairro',				'bairro',			'300',			'',					'',											''),
		array('text',		'CEP',				'cep',			'300',			'',					'',											''),
		array('text',		'Cidade',				'cidade',			'300',			'',					'',											''),
		array('text',		'Estado',				'estado',			'300',		   	'',					'',											''),
		array('text',		'Data de Envio',		'data',				'300',		   	'',					'',											''),
	);


	# Exibindo os campos
	echo adminCampos2($campos,$Config,$dados, $_GET['ID']);






?>
</div>
<style>
	.consulta * {
		text-align: center !important;
	}
	.text-left{
		text-align: left !important;	
	}
	.bt-orcamento {
	    width: 216px;
	    height: 33px;
	    color: #FFF;
	    background-color: #000;
	    border: none;
		font-size: 14px;
		font-weight: bold;
	}
	.bt-orcamento.responder{
	    background-color: #FF9D00 !important;
	}
	.botoes-orcamento{
	    margin-left: 20px;
	    margin-bottom: 15px;
	}
</style>
<script type="text/javascript">
	$(function(){
		$(".bt-orcamento.responder").click(function(){
			$(".tb-dados-cliente").fadeOut(function(){
				$(".responder-orcamento").slideToggle("fast");
			});
		});
		$(".bt-orcamento.dados-cliente").click(function(){
			$(".responder-orcamento").fadeOut(function(){
				$(".tb-dados-cliente").slideToggle("fast");
			});
		})
	})
</script>>
<?
	include('../includes/Rodape.php');
?>