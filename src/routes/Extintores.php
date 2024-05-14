<?php

namespace Almacen\Ssst\routes;

use Almacen\Ssst\controllers\ExtintorController;
use Flight;
use Almacen\Ssst\controllers\Login;




class Riesgos extends Flight{

    private $login;
    function __construct()
    {
        $this->login = new Login();
        parent::route('GET /',[$this->login,'login']);    
        parent::route('POST /log',[$this->login,'setlogin'] );
        parent::route('GET /home',[$this->login,'RenderHome']);

       //vista Extintores 
       $extintores = new ExtintorController();
       parent::route('GET /Extintores',[$extintores,'index']);

    }
}