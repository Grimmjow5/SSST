<?php
namespace Almacen\Ssst\utils;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use Error;
use Exception;
class ValMRiesgos extends MRiesgos{

    public function validate($request):MRiesgos
    {
    
    if(empty($request['area']) || $request['area'] == 0 ){
        throw new Exception("Error de area seleciona un area");
     }
     $this->idArea = $request['area'];
     
    if(empty($request['nRiesgo'])){
        throw new Exception("Ingresa el No. De Riesgo");    
    }
    $this->id_control = $request['nRiesgo'];
     
     if(empty($request['descripcion'])){
        throw new Exception("Ingresa descripción del riesgo");
     }
     $this->descripcion = $request['descripcion'];

     if(empty($request['estatus'])){
        throw new Exception("Ingresa el estatus");
     }
     $this->estatus = $request['estatus'];
     
     if(empty($request['prioridad'])){
        throw new Exception("Ingresa la prioridad");
     }
    $this->prioridad = $request['prioridad'];

     if(empty($request['solucion'])){
        throw new Exception("Ingresa la solucion del problema");
     }
     $this->solucion = $request['solucion'];


    //Este sera la condicion para crear un nuevo registro
    // if(empty($request['elId'])){
      //  throw new Exception("Error no hay un id quiere decir que es nuevo", 1);               
     //}
     $this->id = $request['elId'];
     
     $mo = new MRiesgos();
     $mo = $this;
     return $mo;
     

    }

    private function val_id(int $id){
        try {
            if(empty($id)){
            }
        } catch (\Throwable $th) {
            
            //throw $th;
        }        
    }

}