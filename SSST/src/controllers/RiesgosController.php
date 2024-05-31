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
    private function checkAdmin() {
        if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 1  && $_SESSION['rol'] !==2) {
            parent::halt(403, "Acceso denegado: Solo los administradores pueden acceder.");
        }
    }   

    public function index (){
             $this->checkAdmin();   
       
      // $arr = array("valor"=>"valores");
       $this->repoRiesgos->getCat->rowVal = ["estatus"=>array(1)];
       $this->repoRiesgos->getCat->table = 'cat_areas';
       $this->repoRiesgos->getCat->logic = "and";
       $areas = $this->repoRiesgos->getCat->getAll();
       parent::render('riesgos/index',['areas'=> $areas, 'error'=>""]);
    }

    public function postRiesgo(){
        
      try{
        $this->checkAdmin();   
        
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
            //parent::view()->set('error', $ex->getMessage());
            //echo $ex->getMessage();
            //$areas = $this->repoRiesgos->getCat->get_Cat();
            parent::json(['res'=> $ex->getMessage()],422);
        }
    }
    public function getRiesgos(){
        
        $mes = new DateTime();
        $this->repoRiesgos->getCat->table = "mv_riesgos";
        $this->repoRiesgos->getCat->logic = "or";
                
        $this->repoRiesgos->getCat->rowVal = array(
        "id_mes"=>array($mes->format("m")-1,  $mes->format("m") )); 
        $resul = $this->repoRiesgos->getCat->getAll();
        parent::json(['data'=>$resul]);
    }
}