<?php
	include("php/config/config.php");
	include("painel/includes/BancoDeDados.php");
	$conexao = db_conectar();

	$email = $_POST['email'];
	$primeiroNome = $_POST['firstName'];
	$ultimoNome = $_POST['lastName'];
	$celular = $_POST['celular'];
	$telefone = $_POST['telefone'];
	$cep = $_POST['cep'];
	$logradouro = $_POST['logradouro'];
	$numero = $_POST['numero'];
	$bairro = $_POST['bairro'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];

	$sqlCadastro = "select * from tbclientes where email = '".$email."'";
	$result = mysql_query($sqlCadastro);
	$numRows = mysql_num_rows($result);
	if($numRows == 0){
		$sql = "insert into tbclientes (email, primeironome, ultimonome, celular, telefone, cep, logradouro, numero, bairro, cidade, estado) 
				values 
				('$email', '".utf8_decode($primeiroNome)."', '".utf8_decode($ultimoNome)."', '".utf8_decode($celular)."', 
				'".utf8_decode($telefone)."', '$cep', '".utf8_decode($logradouro)."', '$numero', '".utf8_decode($bairro)."','".utf8_decode($cidade)."','$estado')";
		mysql_query($sql);
	}
	$sql = "select id from tbclientes where email = '$email'";
	$dados = mysql_fetch_assoc(mysql_query($sql));
	header("Location: enviarOrcamento.php?id=".$dados['id']);
?>