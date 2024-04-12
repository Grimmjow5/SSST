<?php

use Almacen\Ssst\Acceso;
use Almacen\Ssst\routes\Riesgos;
use Almacen\Ssst\routes\ReportsRiesgos;

require '../vendor/autoload.php';


session_start();


$reports = new ReportsRiesgos();
$ll = new Riesgos();
// Finalmente, inicia el framework.
Flight::start();

