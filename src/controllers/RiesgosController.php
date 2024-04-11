<?php

namespace Almacen\Ssst\controllers;
use Flight;
use Almacen\Ssst\dbrepo\RepoMain;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use Almacen\Ssst\utils\ValMRiesgos;
use Exception;

class RiesgosController extends Flight{

    private ValMRiesgos $mriesgos;
    private MRiesgos $model;
    private $repoRiesgos;
    public function __construct()
    {        
        $this->model = new MRiesgos();
        $this->repoRiesgos = new RepoMain();
        $this->mriesgos = new ValMRiesgos();
    }

    public function index (){
                      
       // $arr = array("valor"=>"valores");
       $this->repoRiesgos->row = "estatus";
       $this->repoRiesgos->table = 'cat_areas';
       $areas = $this->repoRiesgos->getAll(1);
       parent::render('riesgos/index',['areas'=> $areas]);
    }

    public function postRiesgo(){
        try{

             $this->model = $this->mriesgos->validate($_REQUEST);
            $save = false;
            if(empty($this->model->id) || $this->model->id == 0 ){
                $save = $this->repoRiesgos->set_model($this->model);
            }else{
                $save = $this->repoRiesgos->put_model($this->model);
            }
        
            if($save){
                parent::json(["OK"],200);
            }else{
                parent::json(["F"],400);
            }

        }catch(Exception $ex){
            //parent::view()->set('error', $ex->getMessage());
            //echo $ex->getMessage();
            //$areas = $this->repoRiesgos->get_Cat();
            parent::json(['res'=> $ex->getMessage()],422);
        }
    }
  public function getRiesgos(){

    $this->repoRiesgos->table = "mv_riesgos";
    
    $resul = $this->repoRiesgos->getAll();
    parent::json(['data'=>$resul]);

  }

}