$(function(){
	var posicaoAtual = $(window).scrollTop();
	var documentSize = $(document).height();
	var sizeWindow = $(window).height();
	var s = "";
	var busy = 0;
	var pesquisa = "";
	carregaProdutos(s);
	
	function carregaProdutos(x){
		$('#carregando').show();
		window.setTimeout(function(){
			if(busy == 0){
				busy = 1;
				$.ajax({
					url: "retornoProdutos.php?lastId="+ $(".produto:last").attr('id'),
					success: function(html) {
						if(html){		
							$("#produtos ul").append(html);
							$('#carregando').hide();
						}else{
							$("#produtos ul").append('<li class="clear" style="display: none;">');		
							$('#carregando img').replaceWith("<p>Você já visualizou todos os produtos</p>");
							$('#carregando').css('background-color','#CCC');
						}
						busy = 0;
					}
				});	
			}
		},500);
	}
	
	$(window).scroll(function () {
		posicaoAtual = $(window).scrollTop();
 		if($(window).scrollTop() >= $(document).height() - $(window).height()) {
 			var x = "";
 			carregaProdutos(x);	
			}
	});	
})