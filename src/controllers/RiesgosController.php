<?php

namespace Almacen\Ssst\controllers;

use Almacen\Ssst\dbrepo\Factory;
use Flight;
use Almacen\Ssst\dbrepo\RepoMain;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use Almacen\Ssst\utils\ValMRiesgos;
use DateTime;
use Exception;

class RiesgosController extends Flight{

    private ValMRiesgos $mriesgos;
    private MRiesgos $model;
    private Factory $repoRiesgos;
    
    public function __construct()
    {        
        $this->model = new MRiesgos();
        $this->repoRiesgos = new Factory();
        $this->repoRiesgos->getCatalogos(new RepoMain());
        $this->mriesgos = new ValMRiesgos();
    }
    

    public function index (){
        
       
       $this->repoRiesgos->getCat->rowVal = ["estatus"=>array(1)];
       $this->repoRiesgos->getCat->table = 'cat_areas';
       if ($this->repoRiesgos->getCat->table == 'cat_areas') {
        // Si la tabla es 'cat_areas', no añadir la condición 'estatus'
            $this->repoRiesgos->getCat->rowVal = [];
        }
       $this->repoRiesgos->getCat->logic = "and";
       $areas = $this->repoRiesgos->getCat->getAll();
       $this->repoRiesgos->getCat->table = 'asignar_view';
       $subArea = $this->repoRiesgos->getCat->getSubArea();

       parent::render('riesgos/index',['areas'=> $areas, 'error'=>"",'subArea'=> $subArea]);
    }

    public function postRiesgo(){
        
      try{
         
        
             $this->model = $this->mriesgos->validate($_REQUEST);
            $save = false;
            if(empty($this->model->id) || $this->model->id == 0 ){

                $save = $this->repoRiesgos->getCat->set_model($this->model);
            }else{
                $save = $this->repoRiesgos->getCat->put_model($this->model);
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
    public function getRiesgos(){
        
        $userId = $_SESSION["id_usuario"];
        $mes = new DateTime();
        $this->repoRiesgos->getCat->table = "repo_riesgo";
        $this->repoRiesgos->getCat->logic = "or";
            

        $this->repoRiesgos->getCat->rowVal = [
            "id_mes"=> [$mes->format("m")-1,  $mes->format("m")],'id_userReg' => [$userId]
        ];
        $resul = $this->repoRiesgos->getCat->getAll();
        parent::json(['data'=>$resul]);
    }
}