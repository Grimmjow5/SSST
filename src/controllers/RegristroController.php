<?php

namespace Almacen\Ssst\controllers;
use Almacen\Ssst\dbrepo\Factory;
use Almacen\Ssst\dbrepo\models\MRegistro;
use Almacen\Ssst\dbrepo\ReMain;
use Almacen\Ssst\utils\ValRegistro;
use Exception;
use Flight;




 class RegristroController extends Flight{
    private ValRegistro $re;
    private MRegistro $model;
    private Factory $Registro;
 
    public function __construct()
    {
        $this->model=new MRegistro();
        $this->re=new ValRegistro();
        $this->Registro= new Factory();
       $this->Registro->getCatalogosRe(new ReMain());
        
        

    }

    private function checkAdmin() {
        if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 1) {
            parent::halt(403, "Acceso denegado: Solo puede acceder personal autorizado .");
        }
    }
    public function index(){
        $this->checkAdmin();
        $this->Registro->getCatRe->rowVal = [];
        $this->Registro->getCatRe->table = 'roles';
       $this->Registro->getCatRe->logic = "and";
       $roles = $this->Registro->getCatRe->getAll();


        parent::render('Registro/index',['roles'=>$roles,'error'=>""]);
    }

    


    public function postRegistro(){
        $this->checkAdmin(); 
        
        try{
          
              $this->model = $this->re->validate($_REQUEST);
              $save = false;
              if(empty($this->model->id) || $this->model->id == 0 ){
  
                  $save = $this->Registro->getCatRe->set_modelRes($this->model);
              }else{
                  $save = $this->Registro->getCatRe->put_modelRes($this->model);
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

      public function getRegistro(){
        
        $this->Registro->getCatRe->table = "vista_usuario";
        $resul = $this->Registro->getCatRe->getAll();
        parent::json(['data'=>$resul]);
        
    }
     
 }