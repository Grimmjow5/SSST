<?php

use Almacen\Ssst\routes\Extintores;
use Almacen\Ssst\routes\Riesgos;
use Almacen\Ssst\routes\ReportsRiesgos;

require '../vendor/autoload.php';


session_start();


$ll = new Riesgos();
$ee=new Extintores();
//$reports = new ReportsRiesgos();
// Finalmente, inicia el framework.
Flight::start();

