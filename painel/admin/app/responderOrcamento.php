<?php
	include "../../../php/config/config.php";
	include "../../../painel/includes/BancoDeDados.php";
	include '../../../orcamento/checkout/actioncheckout.class.php';
	$conexao = db_conectar();
	extract($_POST);


	mysql_query("update tborcamento set status_envio = true where id = ".$id_orcamento);
	
	date_default_timezone_set('America/Sao_Paulo');
	//criando e inserindo um novo orçamento

	$headers = "";

	$header .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: Fabiana Calçados <contato@fabianacalcados.com.br>\r\n";

	$msg = $descricao;

	$opts = array(

		'assunto' => 'Resposta de Orcamento',
		'remetente' => 'vendas@fabianacalcados.com.br',
		'nomeRemetente' => 'Fabiana Calcados',
		'destino' => array('Cliente' => $email),
		'corpo' => $msg

	);
	$Act = new ActionCheckout;
	$Act->sendConfirm($opts);

	header("location: ../sys/orcamento.php");

	/*if (mail($email, utf8_decode("Orçamento realizado no site RF Casa e Cia"),$msg,$headers)) {

		echo "True";
	} else {
		echo "False";
	}*/
?>

