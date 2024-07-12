<?php

use Almacen\Ssst\routes\Extintores;
use Almacen\Ssst\routes\Catalogo;
use Almacen\Ssst\routes\Riesgos;
use Almacen\Ssst\routes\Roles;
use Almacen\Ssst\routes\Registro;
use Almacen\Ssst\routes\Acceso;


session_start();
$a=new Acceso();
$rr = new Registro();
$ll = new Riesgos();
$ee = new Extintores();
$ii = new Catalogo();
$ro = new Roles();
//$reports = new ReportsRiesgos();
// Finalmente, inicia el framework.
Flight::start();

