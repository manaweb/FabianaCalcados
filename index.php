<?php include "topo.php"; ?>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
          <ul class="bx-slider">
            <?php 
            $result = mysql_query("select * from banner_secundario order by id desc");
            while($dados = mysql_fetch_assoc($result)){
              echo "<li><a href='{$dados['destino']}'><img src='painel/arquivos/banner_secundario/{$dados['arquivo']}' class='img-responsive' alt='{$dados['titulo']}'></a></li>";
            }
            ?>
          </ul>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="sociais">
            <h3>Redes</h3> 
            <span class="spanSociais">Sociais</span>
            <p>Se conecte à Fabiana Calçados</p>
            <div class="text-center links-sociais">
              <a href="#facebook" class="fundo-face"></a>
              <a href="#instagram" class="fundo-insta"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="section destaque" id="destaque">
        <div class="container">
          <div class="row">
            <div class="fundo-title">
              <h3 class="title-section col-lg-12">Destaque da semana</h3>
            </div>
          </div>
          <div class="row fotos-destaque">
            <ul class="bxslider bx-destaque no-padding">
              <?php
              $result = mysql_query("seelct * from destaque order by id desc");
              while($dados = mysql_fetch_assoc($result)){
                echo '
                <li>
                  <div class="hm">
                    <img src="painel/arquivos/destaque/{$dados["arquivo"]}" alt="{$dados["titulo"]}" class="img-responsive">
                  </div>
                </li>';
              }
              ?>
              <li>
                <div class="hm">
                  <img src="img/teste1d.jpg" class="img-responsive">
                </div>
              </li>
              <li>
                <div class="wm">
                  <img src="img/teste2d.jpg" class="img-responsive">
                </div>
              </li>
              <li>
                <div class="hm">
                  <img src="img/teste3d.jpg" class="img-responsive">
                </div>
              </li>
              <li>
                <div class="hm">
                  <img src="img/teste1d.jpg" class="img-responsive">
                </div>
              </li>
              <li>
                <div class="wm">
                  <img src="img/teste2d.jpg" class="img-responsive">
                </div>
              </li>
              <li>
                <div class="hm">
                  <img src="img/teste3d.jpg" class="img-responsive">
                </div>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-lg-12 destaques-controls outside">
              <span class="control-destaque-left-d"></span>
              <span class="control-destaque-right-d"></span>
            </div>
          </div>
        </div> <!-- /container -->
      </div> <!-- /section destaque -->

      <div class="section produtos">
        <div class="container">
          <div class="row">
            <div class="fundo-title">
              <h3 class="title-section col-lg-12">Produtos</h3>
            </div>
          </div>
          <div class="row fotos-destaque">
            <ul class="bx-slider bx-produtos-1 no-padding" id="bx-produtos-1">
              <?php
                $result = mysql_query("select * from tbprodutos");
                $qtd_produtos = mysql_num_rows($result);
                for($i = 0; $i < ($qtd_produtos/2); $i++){
                  $dadosProduto = mysql_fetch_assoc($result);
              ?>
                <li class="li-produto"><a href="verproduto.php?id=<?=$dadosProduto['id']?>"><img src="painel/arquivos/produtos/<?=$dadosProduto['foto1']?>" alt="<?=$dadosProduto['nome']?>"><img src="img/lupa.png" alt="" class="lupa-produto"></a></li>
              <?php } ?>
            </ul>

            <ul class="bx-slider bx-produtos-2 no-padding" id="bx-produtos-2">
              <?php
              for($i = 1; $i < ($qtd_produtos/2); $i++){
                  $dadosProduto = mysql_fetch_assoc($result);
              ?>
                <li class="li-produto"><a href="verproduto.php?id=<?=$dadosProduto['id']?>"><img src="painel/arquivos/produtos/<?=$dadosProduto['foto1']?>" alt="<?=$dadosProduto['nome']?>"><img src="img/lupa.png" alt="" class="lupa-produto"></a></li>
              <?php } ?>
            </ul>
          </div>
          <div class="row">
            <div class="col-lg-12 destaques-controls outside">
              <span class="control-destaque-left-p"></span>
              <span class="control-destaque-right-p"></span>
            </div>
          </div>
        </div> <!-- /container -->
      </div> <!-- /section produtos -->
      <?php 
        $page = "index";
        include "scripts.php"; 
      ?>
      <script src="js/jquery.bxslider.min.js"></script>
      <script>
        $(function(){
          $('.bx-destaque').bxSlider({
            minSlides: 1,
            maxSlides: 3,
            slideWidth: 360,
            slideMargin: 10,
            nextSelector: '.control-destaque-right-d',
            prevSelector: '.control-destaque-left-d',
            nextText: '',
            prevText: '',
            pager: false,
            infiniteLoop: false,
            useCSS: false,
            moveSlides: 3
          });

          $('.bx-slider').bxSlider({
            minSlides: 1,
            maxSlides: 1,
            slideWidth: 706,
            pager: false,
            controls: false
          });

          $('.bx-produtos-1, .bx-produtos-2').bxSlider({
            minSlides: 1,
            maxSlides: 3,
            slideWidth: 360,
            slideMargin: 10,
            nextSelector: '.control-destaque-right-p',
            prevSelector: '.control-destaque-left-p',
            nextText: '',
            prevText: '',
            pager: false,
            moveSlides: 1,
            touchEnabled: false,
            infiniteLoop: false,
          });
        $(".control-destaque-left-p a:first-child").click(function(){
          $(".control-destaque-left-p a:nth-child(2)").trigger('click');
        });

        $(".control-destaque-right-p a:first-child").click(function(){
          $(".control-destaque-right-p a:nth-child(2)").trigger('click');
        });
      });
      </script>
      
    <?php include "rodape.php" ?>
