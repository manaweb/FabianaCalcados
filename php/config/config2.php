<?php

error_reporting(0);

include 'php/classes/header.class.php';

session_start();

define('DB_SERVIDOR','localhost');
define('DB_USUARIO','f25026_radio');
define('DB_SENHA','fm1017');
define('DB_BANCO','f25026_site');
define('CONF_EMAIL', 'suporte@manaweb.com.br');

define ('DOMAIN','http://101fm.com.br/novosite/');
define ('CSS_DIRECTORY',DOMAIN.'css/');
define ('JS_DIRECTORY',DOMAIN.'js/');
define ('IMG_DIRECTORY',DOMAIN.'img/');
