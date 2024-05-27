<?php

use Almacen\Ssst\routes\Extintores;
use Almacen\Ssst\routes\Catalogo;
use Almacen\Ssst\routes\Riesgos;
use Almacen\Ssst\routes\Roles;


require '../vendor/autoload.php';


session_start();


$ll = new Riesgos();
$ee = new Extintores();
$ii = new Catalogo();
$ro = new Roles();
//$reports = new ReportsRiesgos();
// Finalmente, inicia el framework.
Flight::start();

