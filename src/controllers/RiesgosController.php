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
        $this->mriesgos = new ValMRiesgos();
    }

    public function index (){
                
       
      // $arr = array("valor"=>"valores");
       $areas = $this->repoRiesgos->getCatalogos(new RepoMain());
       $arre = $this->repoRiesgos->getCat->getAll();
       parent::render('riesgos/index',['areas'=> $areas, 'error'=>""]);
    }

    public function postRiesgo(){
        
        try{
        $model = $this->mriesgos->validate($_REQUEST);
        
        
        }catch(Exception $ex){
            parent::view()->set('error', $ex->getMessage());
            echo $ex->getMessage();
            
            $areas = $this->repoRiesgos->getCat->getAll();

            parent::render('riesgos/index',['areas'=>$areas]);
        }
    }

}