<?php include "topo.php"; ?>
	<div class="section quem-somos" id="corpoTodo">
        <div class="container">
          <div class="row">
            <div class="fundo-title">
              <h3 class="title-section col-lg-12">Coleção</h3>
            </div>
          </div>
          <div class="row">
          	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 adoteJa">
              <fieldset>
                <h2>Encontre o produto que deseja visualizar!</h2>
                <label for="pesquisar">Pesquisar por:</label>
                <form>
                  <input type="text" value="<?php echo isset($_GET['pesquisar']) ? $_GET['pesquisar'] : ""?>" name="pesquisar" id="pesquisar" class="search-input" />
                  <input type="submit" value="" class="submitProdutos"/>
                </form>
              </fieldset>
              <div>
              <?php
                $ul = '';
                $final = '';
                $q = mysql_query("SELECT * FROM tbprodutos_colecao");
                while ($dados = mysql_fetch_assoc($q)) {
                  $final = '';
                  $id = $dados['id_colecao'];
                  $qq = mysql_query("SELECT * FROM tbprodutos_categoria WHERE id_colecao = '$id'");
                  while ($dados2 = mysql_fetch_assoc($qq))
                    $final .= '<li id="'.$dados2['id_categoria'].'"><a href="colecao.php?categoria='.$dados2['id_categoria'].'">'.utf8_encode($dados2['nome']).'</a></li>';
                  $ul .= '<ul><li><h3><a href="javascript:void(0)" class="show-hide">'.utf8_encode($dados['nome']).'</a></h3><ul>'.$final.'</ul></li></ul>';
                  
                }
                echo $ul;
              ?> 
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 center-block">
              <ul class="no-padding" id="ul-produtos">
                <?php 

                 ?>
                <li class="li-produto" id="9999999999999999999999999999999999" style="display: none"><a href="#"><img src="img/produto1.jpg" class="img-produto"><img src="img/lupa.png" alt="" class="lupa-colecao lupa-produto"></a></li>
                <!-- <li class="li-produto"><a href="#"><img src="img/produto1.jpg" class="img-produto"><img src="img/lupa.png" alt="" class="lupa-colecao lupa-produto"></a></li>
                <li class="li-produto"><a href="#"><img src="img/produto1.jpg" class="img-produto"><img src="img/lupa.png" alt="" class="lupa-colecao lupa-produto"></a></li>
                <li class="li-produto"><a href="#"><img src="img/produto1.jpg" class="img-produto"><img src="img/lupa.png" alt="" class="lupa-colecao lupa-produto"></a></li>
                <li class="li-produto"><a href="#"><img src="img/produto1.jpg" class="img-produto"><img src="img/lupa.png" alt="" class="lupa-colecao lupa-produto"></a></li>
                <li class="li-produto"><a href="#"><img src="img/produto1.jpg" class="img-produto"><img src="img/lupa.png" alt="" class="lupa-colecao lupa-produto"></a></li> -->
              </ul>
              <div id="carregando" class="carregando clear col-lg-12 text-center"><img style="width: 50px; height: auto;" src='img/loader.gif' alt='Loading' class="imgCarregando" /></div>
            </div>
          </div>
        </div> <!-- /container -->
      </div> <!-- /section destaque -->
<?php include "scripts.php"; ?>
<script>
    $(function(){
      var posicaoAtual = $(window).scrollTop();
      var documentSize = $(document).height();
      var sizeWindow = $(window).height();
      var c = "";
      var p = "";
      var busy = 0;
      <?php
      echo isset($_GET['categoria'])? "c = '&categoria=".$_GET['categoria']."';\n $('#".$_GET['categoria']."').parents('li').children('ul').slideToggle('slow');\n" : "";
      echo isset($_GET['pesquisar'])? "p = '&pesquisar=".$_GET['pesquisar']."';\n" : ""; 
      ?>
      carregaProdutos(c);
      
      function carregaProdutos(x){
        $('#carregando').show();
        window.setTimeout(function(){
          if(busy == 0){
            busy = 1;
            $.ajax({
              url: "retornoProdutos.php?lastId="+ $(".li-produto:last").attr('id') + c + p,
              success: function(html) {
                if(html){   
                  $("#ul-produtos").append(html);
                  $('#carregando').hide();
                }else{
                  $("#ul-produtos").append('<li class="clear" style="display: none;">');    
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
      
      $('.show-hide').click(function() {
        $(this).parents('li').children('ul').slideToggle('slow');
      });
      
    });
  </script>
<?php include "rodape.php" ?>