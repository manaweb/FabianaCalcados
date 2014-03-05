<? 
	define('ID_MODULO',105,true);
	include("../../../php/config/config.php");
	include('../includes/Config.php');
	include('../includes/Topo.php');
	

	$Config = array(
		'arquivo'=>'orcamento',
		'tabela'=>'tborcamento',
		'nome'=>'orcamento',
		'id'=>'id',
		'urlfixo'=>'', 
		'pasta'=>'orcamento',
	);

?>
<div id="acessibilidade">
	Voc&ecirc; est&aacute; aqui: <a href="orcamento.php">Or&ccedil;amento</a> &rsaquo; Consultar
</div>

<div id="conteudo">
<style type="text/css">
	.aoLado {
		display: inline-block;
		vertical-align: top;
	}
	fieldset{
		padding: 10px;
		border: 1px solid #CCC;
	}
	input[type=submit]{
		color: #000;
		padding: 6px 6px 24px 6px;
		border-radius: 5px;
		margin-top: 60px;
	}
</style>
<div id="busca" class="adicionar">
	<h1>Listando Or&ccedil;amento</h1>
	<fieldset>
		<?php
			$inicio = $final = "";
			$dataAtual = date('d-m-Y');
			if(isset($_POST['periodoInicio']) and $_POST['periodoInicio'] != $dataAtual)
				$inicio = $_POST['periodoInicio'];
			else
				$inicio = date('d-m-Y');
			if(isset($_POST['periodoFinal']) and $_POST['periodoFinal'] != $dataAtual)
				$final = $_POST['periodoFinal'];
			else
				$final = date('d-m-Y');
		?>
		<div class="aoLado">
			<form method="post" action="orcamento.php" id="formBuscar" class="formBuscar" name="formBuscar">
			<b>Buscar</b><br>
			<b>Per&iacute;odo</b><br>
			<div class="aoLado data">
				<input type="data" name="periodoInicio" value="<?=$inicio?>" readonly="readonly" size="10" onfocus="this.className='focus';" onblur="this.className='';" class=""> <a href="javascript:abrirCalendario('', 'formBuscar', 'periodoInicio', 'date')"><img src="../img/calendario.gif" align="absmiddle"></a>
				<br> <span>In&iacute;cio</span>
			</div>
			<div class="aoLado data">
				<input type="data" name="periodoFinal" value="<?=$final?>" readonly="readonly" size="10" onfocus="this.className='focus';" onblur="this.className='';" class=""> <a href="javascript:abrirCalendario('', 'formBuscar', 'periodoFinal', 'date')"><img src="../img/calendario.gif" align="absmiddle"></a>
				<br> <span>Final</span>
			</div>
		</div>
		<div class="aoLado">
			<label>Nr. Or&ccedil;amento<br>
				<input type="text" name="nrOrcamento" value="<?php echo @$_POST['nrOrcamento']?>" />
			</label><br>
			<label>Primeiro Nome<br>
				<input type="text" name="primeiroNome" value="<?php echo @$_POST['primeiroNome']?>" />
			</label>
		</div>
		<div class="aoLado">
			<label>E-mail<br>
				<input type="text" name="email" value="<?php echo @$_POST['email']?>" />
			</label><br>
			<label>&Uacute;ltimo Nome<br>
				<input type="text" name="ultimoNome" value="<?php echo @$_POST['ultimoNome']?>" />
			</label>
		</div>
		<div class="aoLado">
			<input type="submit" value="Buscar" />
		</div>
	</fieldset>
</div>
<?
	# Imprimir Mensagem (se houver)
	include('../includes/Mensagem.php');




	// -----------------------------------------------------------------------------------------------------------
	// Listagem
	// -----------------------------------------------------------------------------------------------------------

	# Montando os campos
	$campos = array(
		#	0=>Tipo			1=>TÃ­tulo			2=>Fonte			3=>Url
		array('texto',		'C&Oacute;DIGO',	'id',				''),
		array('texto',		'CLIENTE',			'cliente',			''),
		array('texto',		'EMAIL',			'email',			''),
		array('texto',		'DATA DE ENVIO',	'data',				''),
		array('status',		'STATUS DO OR&Ccedil;AMENTO',	'status_envio',				''),

	);


	# Consulta SQL
	/*$SQL = "SELECT * FROM ".$Config['tabela']." WHERE 1 ".$busca." ORDER BY titulo ASC";*/
	$periodo = "";
	$nrOrcamento = "";
	$email = "";
	$primeiroNome = "";
	$ultimoNome = "";
	$dataAtual = date('d-m-Y');
	if(isset($_POST['periodoInicio']) and $_POST['periodoInicio'] != $dataAtual)
		$inicio = date('Y-m-d', strtotime($_POST['periodoInicio']));
	else
		$inicio = "";
	if(isset($_POST['periodoFinal']) and $_POST['periodoFinal'] != $dataAtual)
		$final = date('Y-m-d', strtotime($_POST['periodoFinal']));
	else
		$final = "";

	// if(isset($_POST['periodoInicio']) && isset($_POST['periodoFinal']))
	// 	$periodo = " and o.data between {$_POST['periodoInicio']} and {$_POST['periodoFinal']}";
	if(isset($_POST['nrOrcamento']) && $_POST['nrOrcamento'] != "")
		$nrOrcamento = "and o.id = ".$_POST['nrOrcamento'];
	if(isset($_POST['email']) && $_POST['email'] != "")
		$email = "and c.email = '%".$_POST['email']."%'";
	if(isset($_POST['primeiroNome']) && $_POST['primeiroNome'] != "")
		$primeiroNome = "and c.primeironome like '%".$_POST['primeiroNome']."%'";
	if(isset($_POST['ultimoNome']) && $_POST['ultimoNome'] != "")
		$ultimoNome = "and c.ultimonome like '%".$_POST['ultimoNome']."%'";
	if($inicio != "" && $final != "")
		$datas = "and o.data between '$inicio' and '$final'";
	$SQL = "
			select o.id, o.flag_status, DATE_FORMAT( o.data , '%d/%m/%Y %H:%i:%s' ) as data, 
			concat(primeironome, ' ',ultimonome) as cliente, c.email, o.status_envio
			from tborcamento o, tbclientes c
			 where o.id_cliente = c.id $periodo
			 $nrOrcamento $email $primeiroNome $ultimoNome $datas
			 order by o.id desc
		   ";
	
	
	

	# Processando os dados
	$total = mysql_num_rows(mysql_query($SQL));
	$Lista = new Consulta($SQL,$total,$PGATUAL);
	while ($linha = db_lista($Lista->consulta)) {
		$dados[] = $linha;
	}


	# Listando
	echo adminLista($campos,$dados,array('excluir', 'visualizar'),$Config,false);



	# Paginação
	//echo '<div class="paginacao">'.$Lista->geraPaginacao().'</div>';


?>
</div>
<script type="text/javascript">
	$(function(){
		$(".td-status").each(function(){
			if($(this).text() == 0){
				$(this).addClass("aguardando");
				$(this).text("Aguardando Resposta");
			}else if($(this).text() == 1){
				$(this).addClass("enviado");
				$(this).html("Or&ccedil;amento Enviado");
			}
		})
	})
</script>
<style type="text/css">
	.aguardando{
		background: #F74232 !important;
		color: #FFF;
		text-align: center !important;
		font-weight: bold;
	}
	.enviado{
		background-color: #66CC00 !important;
		color: #006600 !important;
		font-weight: bold;
		text-align: center !important;
	}
</style>
<? include('../includes/Rodape.php'); ?>