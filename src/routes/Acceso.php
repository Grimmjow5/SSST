<?php

//Esta madre se puede ponser en un a clase de seguro es cosas qu7e lo haga de la manera conrrecta 
//use Almacen\Ssst\controllers\ControllerRiesgos;

/* require_once './controllers/Login.php';
require_once './controllers/RiesgosController.php';
//require_once './controllers/riesgos/ControllerRiesgos.php';
//use Almacen\Ssst\constrollers\Login;
// Luego define una ruta y asigna una función para manejar la solicitud.

$con = new Login();

Flight::route('GET /',[$con,'login'] );

Flight::route('POST /log',[$con,'setlogin'] );

Flight::route('GET /home',[$con,'RenderHome']);

//Vista de riesgo
$riesgos = new RiesgosController();

Flight::route('GET /riesgos',[$riesgos,'index']);

Flight::route('POST /riesgos',[$riesgos,'postRiesgo']);
 */
namespace Almacen\Ssst\routes;
use Flight;
use Almacen\Ssst\controllers\Login;
use Almacen\Ssst\controllers\RiesgosController;

class Acceso extends Flight{
    private $login;
function __construct()
{
    $this->login = new Login();
    parent::route('GET /',[$this->login,'login']);    
    parent::route('POST /log',[$this->login,'setlogin'] );

    parent::route('GET /home',[$this->login,'RenderHome']);
    
     parent::route('/logout',[$this->login,'logout']);
    //Vista de riesgo
    $riesgos = new RiesgosController();

    Flight::route('GET /riesgos',[$riesgos,'index']);

    Flight::route('POST /riesgos',[$riesgos,'postRiesgo']);

    Flight::route('GET /cat_riesgos',[$riesgos,'getRiesgos']);
    
   


}
}