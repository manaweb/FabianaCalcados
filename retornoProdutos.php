<?php
	include("php/config/config.php");
	include("painel/includes/BancoDeDados.php");
	$conexao = db_conectar();
	$lastId = $_GET['lastId'];
	$categoria = isset($_GET['categoria']) ? "and id_categoria = ".$_GET['categoria'] : "";
	$pesquisar = isset($_GET['pesquisar']) ? "and (upper(nome) like upper('%".$_GET['pesquisar']."%') or upper(descricao) like upper('%".$_GET['pesquisar']."%'))" : ""; 
	$sql = ("SELECT p.* from tbprodutos p");
	$sqlProdutosRelacionados = "select * from tbprodutos where id < $lastId $categoria $pesquisar order by id desc limit 6";
	$result = mysql_query($sqlProdutosRelacionados);
	$html = "";
	while ($dados2 = mysql_fetch_array($result)) {
		$html.= "
			<li class='li-produto' id='{$dados2['id']}'>
				<a href='verproduto.php?id={$dados2['id']}'><img src='painel/arquivos/produtos/{$dados2['foto1']}' class='img-produto'>
					<img src='img/lupa.png' alt='' class='lupa-colecao lupa-produto'>
				</a>
			</li>
		";
	} 
	echo $html;
	
?>