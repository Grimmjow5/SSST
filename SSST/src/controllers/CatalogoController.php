<?php

namespace Almacen\Ssst\controllers;


use Almacen\Ssst\dbrepo\CatMain;
use Flight;
use Almacen\Ssst\dbrepo\Factory;

use Almacen\Ssst\utils\ValCatalogo;
use Almacen\Ssst\dbrepo\models\MCatalogo;
use Exception;

class CatalogoController extends Flight{
  
    private ValCatalogo $cat;
    private MCatalogo $model;
    //private $repoExt;
    private  Factory $Catalogo;


    public function __construct()
    {        
        $this->model = new MCatalogo();
        $this->Catalogo = new Factory();
        $this->Catalogo->getCatalogosCat(new CatMain());
        $this->cat= new ValCatalogo();
    }
 private function checkAdmin() {
        if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 1  && $_SESSION['rol'] !==2) {
            parent::halt(403, "Acceso denegado: Solo los administradores pueden acceder.");
        }
    }
    public function index (){
            $this->checkAdmin();
        $this->Catalogo->getCatCat->rowVal = [];
        $this->Catalogo->getCatCat->table = "cat_areas";
     
        $areas = $this->Catalogo->getCatCat->getAll();
        
       
        
        //etse es el principio
        parent::render('Catalogo/index',['areas'=>$areas,'erro'=>""]);
    }

    public function postCatalogo(){
            $this->checkAdmin();
      try{
        
            $this->model = $this->cat->validate($_REQUEST);
            $save = false;
            if(empty($this->model->id) || $this->model->id == 0 ){

                $save = $this->Catalogo->getCatCat->set_modelCat($this->model);
            }else{
                $save = $this->Catalogo->getCatCat->put_modelCat($this->model);
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

    public function getCatalogo(){
        
        $this->Catalogo->getCatCat->table = "cat_extintores";
        $resul = $this->Catalogo->getCatCat->getAll();
        parent::json(['data'=>$resul]);
        
    }
 

}