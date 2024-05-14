<?php

namespace Almacen\Ssst\controllers;

use Flight;

use Almacen\Ssst\dbrepo\Factory;
use Almacen\Ssst\dbrepo\RepoMain;
use Almacen\Ssst\dbrepo\models\MExtintores;
use Almacen\Ssst\utils\ValMRiesgos;
use DateTime;
use Exception;

class ExtintorController extends Flight{

    private MExtintores $model;
    private  $repoRiesgos;
    public function __construct()
    {        
        $this->model = new MExtintores();
        $this->repoRiesgos = new Factory();
        $this->repoRiesgos->getCatalogos(new RepoMain());
    }

    public function index (){

      
       $this->repoRiesgos->getCat->table = 'cat_areas';
       //$this->repoRiesgos->getCat->logic = "and";
       $areas = $this->repoRiesgos->getCat->getAll();
        parent::render('Extintores/index',['areas'=>$areas,'error'=>""]);
    }
}