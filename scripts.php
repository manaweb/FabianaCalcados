<script src="js/vendor/jquery-1.10.1.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script>
<?php 
	if (!isset($page) || $page != "index"){
		echo "scrollToID('#corpoTodo',100);\n";
	}
?>
</script>