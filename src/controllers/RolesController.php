<?php

namespace Almacen\Ssst\controllers;


use Almacen\Ssst\dbrepo\RolesMain;
use Flight;
use Almacen\Ssst\dbrepo\Factory;

use Almacen\Ssst\utils\ValMRoles;
use Almacen\Ssst\dbrepo\models\MRoles;
use Exception;

class RolesController extends Flight{
  
    private ValMRoles $rol;
    private MRoles $model;
    //private $repoExt;
    private  Factory $Roles;
    public function __construct()
    {        
        $this->model = new MRoles();
        $this->Roles = new Factory();
        $this->Roles->getCatalogosRol(new RolesMain());
        $this->rol= new ValMRoles();
    }

    public function index (){
        //etse es el principio
        parent::render('Roles/index');
    }

    public function postRoles(){
        
      try{
        
            $this->model = $this->rol->validate($_REQUEST);
            $save = false;
            if(empty($this->model->id) || $this->model->id == 0 ){

                $save = $this->Roles->getCatRol->set_modelRol($this->model);
            }else{
                $save = $this->Roles->getCatRol->put_modelRol($this->model);
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

    public function getRoles(){
        
        $this->Roles->getCatRol->table = "roles";
        $resul = $this->Roles->getCatRol->getAll();
        parent::json(['data'=>$resul]);
        
    }
 

}