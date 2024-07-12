<?php

namespace Almacen\Ssst\routes;

use Almacen\Ssst\controllers\CatalogoController;
use Flight;
use Almacen\Ssst\controllers\Login;


class Catalogo extends Flight{

    private $login;
    function __construct()
    {
        $this->login = new Login();
        parent::route('GET /',[$this->login,'login']);    
        parent::route('POST /log',[$this->login,'setlogin'] );
        parent::route('GET /home',[$this->login,'RenderHome']);

       //vista Catalogo Extintores 
       $catalogo = new CatalogoController();

       parent::route('GET /Catalogo',[$catalogo,'index']);

       parent::route('POST /Catalogo',[$catalogo,'postCatalogo']);

       parent::route('GET /extintores_registrados',[$catalogo,'getCatalogo']);

    }
}