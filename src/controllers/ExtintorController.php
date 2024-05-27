<?php

namespace Almacen\Ssst\controllers;

use Almacen\Ssst\dbrepo\ExtMain;
use Flight;

use Almacen\Ssst\dbrepo\Factory;

use Almacen\Ssst\utils\ValidacionExtintores;
use Almacen\Ssst\dbrepo\models\MExtintores;

use Exception;

class ExtintorController extends Flight{
  
    private ValidacionExtintores $extin;
    private MExtintores $model;
    private  $Extintor;
    private $Registro;
    public function __construct()
    {        
        $this->model=new MExtintores();
        $this->Extintor = new Factory();
        $this->Extintor->getCatalogosEx(new ExtMain());
        $this->extin= new ValidacionExtintores();
    }

    public function index (){
      
        $this->Extintor->getCatEx->table = 'cat_areas';
       //$this->repoRiesgos->getCat->logic = "and";
        $areas = $this->Extintor->getCatEx->getAll();
        parent::render('Extintores/index',['areas'=>$areas,'error'=>""]);
        /*aqui empieze-primero
        $this->Registro->getCatEx->table = 'cat_extintores';
        $extintores = $this->Registro->getCatEx->getAll();
        parent::render('Extintores/index',['extintores'=>$extintores,'error'=>""]);*/
    }

    public function postExtintores(){
        
      try{
        
            $this->model = $this->extin->validate($_REQUEST);
            $save = false;
            if(empty($this->model->id) || $this->model->id == 0 ){

                $save = $this->Extintor->getCatEx->set_modelEx($this->model);
            }else{
                $save = $this->Extintor->getCatEx->put_modelEx($this->model);
            }
     
            if($save){
                parent::json(["OK"],200);
            }else{
                parent::json(["F"],400);
            }
        
        }catch(Exception $ex){
            
            parent::json(['res'=> $ex->getMessage()],422);
        }
    }
   
    public function getExtintores(){
        
        $this->Extintor->getCatEx->table = "reg_extintores";
        $resul = $this->Extintor->getCatEx->getAll();
        parent::json(['data'=>$resul]);
        
    }
 
 

}