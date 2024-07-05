<?php

namespace Almacen\Ssst\routes;

use Almacen\Ssst\controllers\RegistroController;
use Flight;
use Almacen\Ssst\controllers\Login;

class Registro extends Flight{
    private $login;
    function __construct()
    {
        $this->login = new Login();
        parent::route('GET /',[$this->login,'login']);    
        parent::route('POST /log',[$this->login,'setlogin'] );
        parent::route('GET /home',[$this->login,'RenderHome']);


        $registro = new RegistroController();
        parent::route('GET /Registro',[$registro,'index']);
        parent::route('POST /Registro',[$registro,'postRegistro']);
        parent::route('GET /vista_usuario',[$registro,'getRegistro']);
    }
}