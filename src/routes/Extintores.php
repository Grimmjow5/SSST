<?php

namespace Almacen\Ssst\routes;

use Almacen\Ssst\controllers\ExtintorController;
use Almacen\Ssst\controllers\CatalogoController;
use Flight;
use Almacen\Ssst\controllers\Login;




class Extintores extends Flight{

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

       parent::route('POST /Extintores',[$extintores,'postExtintores']);
       
       parent::route('GET /registro_ext',[$extintores,'getExtintores']);

       /*$catalogo = new CatalogoController();
       parent::route('GET /cat_extintores',[$catalogo,'getCatalogo']);
       $catalogo = new CatalogoController();
       parent::route('GET /Catalogo',[$catalogo,'getCatalogo']);
       //parent::route('POST /Catalogo',[$catalogo,'postCatalogo']);*/
     
       

    }
}