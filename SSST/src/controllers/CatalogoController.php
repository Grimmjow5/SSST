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
    

    public function index (){

        
        $this->Catalogo->getCatCat->rowVal = [];
        $this->Catalogo->getCatCat->table = "cat_areas";
        $areas = $this->Catalogo->getCatCat->getAll();
        $this->Catalogo->getCatCat->table = 'asignar_view';
        $subArea = $this->Catalogo->getCatCat->getSubArea();
        
       
        //este es el principio
        parent::render('Catalogo/index',['areas'=>$areas,'erro'=>"",'subArea' => $subArea]);
    }

    public function postCatalogo(){
       
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
        
        $userId = $_SESSION["id_usuario"]; 
        $this->Catalogo->getCatCat->table = "cat_extintores";
        $this->Catalogo->getCatCat->rowVal = [
            'resp_reg' => [$userId]  // Filtrar por el ID del usuario
        ];

        $resul = $this->Catalogo->getCatCat->getAll();
        parent::json(['data'=>$resul]);
        
    }
 

}