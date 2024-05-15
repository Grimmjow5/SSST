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
        $this->extin= new ValidacionExtintores();
    }

    public function index (){

      
       $this->repoRiesgos->getCat->table = 'cat_areas';
       //$this->repoRiesgos->getCat->logic = "and";
       $areas = $this->repoRiesgos->getCat->getAll();
        parent::render('Extintores/index',['areas'=>$areas,'error'=>""]);
    }

    public function postExtintores(){
        
      try{
        
             $this->model = $this->extin->validate($_REQUEST);
            $save = false;
            if(empty($this->model->id) || $this->model->id == 0 ){

                $save = $this->repoRiesgos->getCatEx->set_modelEx($this->model);
            }else{
                $save = $this->repoRiesgos->getCatEx->put_modelEx($this->model);
            }
     
            if($save){
                parent::json(["OK"],200);
            }else{
                parent::json(["F"],400);
            }
        
        }catch(Exception $ex){
            //parent::view()->set('error', $ex->getMessage());
            //echo $ex->getMessage();
            //$areas = $this->repoRiesgos->getCat->get_Cat();
            parent::json(['res'=> $ex->getMessage()],422);
        }
    }
   
 

}