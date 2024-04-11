<?php

use Almacen\Ssst\Acceso;

require '../vendor/autoload.php';

require_once './routes/Acceso.php';

session_start();



$ll = new Acceso();
// Finalmente, inicia el framework.
Flight::start();

