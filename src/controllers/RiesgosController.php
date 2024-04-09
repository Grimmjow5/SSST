<?php

namespace Almacen\Ssst\controllers;
use Flight;
use Almacen\Ssst\dbrepo\Riesgos;
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
        $this->repoRiesgos = new Riesgos();
        $this->mriesgos = new ValMRiesgos();
    }

    public function index (){
                
       
      // $arr = array("valor"=>"valores");
       $areas = $this->repoRiesgos->get_Cat();
       parent::render('riesgos/index',['areas'=> $areas, 'error'=>""]);
    }

    public function postRiesgo(){
        
        try{
        $model = $this->mriesgos->validate($_REQUEST);
        
        
        }catch(Exception $ex){
            parent::view()->set('error', $ex->getMessage());
            echo $ex->getMessage();
            
            $areas = $this->repoRiesgos->get_Cat();

            parent::render('riesgos/index',['areas'=>$areas]);
        }
    }

}