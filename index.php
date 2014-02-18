<?php include "topo.php"; ?>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
          <img src="img/banner2.jpg" alt="" class="img-responsive">
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
      <div class="section destaque">
        <div class="container">
          <div class="row">
            <div class="fundo-title">
              <h3 class="title-section col-lg-12">Destaque da semana</h3>
            </div>
          </div>
          <div class="row fotos-destaque">
            <ul class="bxslider bx-destaque no-padding">
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
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ul>
            <ul class="bx-slider bx-produtos-2 no-padding" id="bx-produtos-2">
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
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
      <?php include "scripts.php"; ?>
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
      }
      </script>
      
    <?php include "rodape.php" ?>
