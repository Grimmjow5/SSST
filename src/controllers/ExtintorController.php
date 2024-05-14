<?php

namespace Almacen\Ssst\controllers;

use Flight;

use Almacen\Ssst\dbrepo\Factory;
use Almacen\Ssst\dbrepo\RepoMain;

use Almacen\Ssst\utils\ValidacionExtintores;
use Almacen\Ssst\dbrepo\models\MExtintores;
use DateTime;
use Exception;

class ExtintorController extends Flight{
  
    private ValidacionExtintores $extin;
    private MExtintores $model;
    private  $repoRiesgos;
    public function __construct()
    {        
        $this->model=new MExtintores();
        $this->repoRiesgos = new Factory();
        $this->repoRiesgos->getCatalogos(new RepoMain());
       // $this->prueba = new ValidacionExtintores();
    $this->extin= new ValidacionExtintores();
    }

    public function index (){

      
       $this->repoRiesgos->getCat->table = 'cat_areas';
       //$this->repoRiesgos->getCat->logic = "and";
       $areas = $this->repoRiesgos->getCat->getAll();
        parent::render('Extintores/index',['areas'=>$areas,'error'=>""]);
    }
}