<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Argentina/Buenos_Aires');//Problemas en mi mac, no me sente a ver poque require eso

require_once __DIR__ . '/core/autoload.php';

$app = new \core\App();

$app->run();

?>
