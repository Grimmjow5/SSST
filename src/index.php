<?php


use Almacen\Ssst\routes\Riesgos;
use Almacen\Ssst\routes\ReportsRiesgos;

require '../vendor/autoload.php';


session_start();


$ll = new Riesgos();
//$reports = new ReportsRiesgos();
// Finalmente, inicia el framework.
Flight::start();

