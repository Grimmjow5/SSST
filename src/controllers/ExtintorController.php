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
        $this->Extintor->getCatEx->roVal=[];
        $this->Extintor->getCatEx->table='cat_extintores';
        $extintores=$this->Extintor->getCatEx->getExt();
        $this->Extintor->getCatEx->table = 'asignar_view';
        $subArea = $this->Extintor->getCatEx->getSubArea();
        parent::render('Extintores/index',['extintores'=>$extintores,'subArea'=>$subArea]);
       
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
        
        $userId = $_SESSION["id_usuario"]; 
        $this->Extintor->getCatEx->table = "repo_ext";
        $this->Extintor->getCatEx->rowVal = [
            'resp_reg' => [$userId]  // Filtrar por el ID del usuario
        ];
        
        $resul = $this->Extintor->getCatEx->getAll();
        parent::json(['data'=>$resul]);
        
    }

    public function deleteExtintores(){
        try {

            $id = $_REQUEST['id']; // Asegúrate de sanitizar y validar este valor
            
            $this->model->id = $id; // Suponiendo que 'id' es el nombre de la propiedad en MExtintores
            
            $deleted = $this->Extintor->getCatEx->delete_modelEx($this->model);

            // Manejar la respuesta según el resultado de la eliminación
            if ($deleted) {
                parent::json(["OK"], 200);
            } else {
                parent::json(["F"], 400);
            }
            
        } catch (Exception $ex) {
            parent::json(['res' => $ex->getMessage()], 422);
        }
    }
    

}