<?php
  include("php/config/config.php");
  include("painel/includes/BancoDeDados.php");
  $conexao = db_conectar();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
        <!-- <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css"> -->

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
    <div class="navbar">
      <div class="container topo">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="img/logo.jpg" alt="Fabiana Calçados"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Inicial</a></li>
            <li><a href="empresa.php">Quem Somos</a></li>
            <li><a href="colecao.php">Coleção</a></li>
            <li><a href="#destaque" class="goTo">Destaque</a></li>
            <li><a href="#">Notícias</a></li>
            <li><a href="#contato" class="goTo">Fale Conosco</a></li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron hidden-sm hidden-xs">
      <div id="banner-principal" class="carousel slide" data-ride="carousel">
        <!-- Indicators 
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
        <?php 
          $sql = "select * from tbpublicidade";
            $result = mysql_query($sql);
            $qtdBanners = mysql_num_rows($result);
            $active = 'active';
            while($dadosBanner = mysql_fetch_assoc($result)){
         ?>
              <div class="item <?php echo $active ?>">
                <img src="painel/arquivos/banner/<?php echo $dadosBanner['arquivo'] ?>" alt="<?php echo $dadosBanner['titulo'] ?>">
              </div>
          <?php 
              $active = "";
            } 
          ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#banner-principal" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#banner-principal" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
    </div>