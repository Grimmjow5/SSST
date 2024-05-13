<?php

namespace Almacen\Ssst\controllers;

use Flight;
use Almacen\Ssst\dbrepo\RepoMain;
use Almacen\Ssst\utils\ValMRiesgos;
use DateTime;
use Exception;

class ExtintorController extends Flight{
    public function __construct()
    {        
       
    
    }

    public function index (){
        parent::render('Extintores/index');
    }
}