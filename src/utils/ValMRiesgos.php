<?php
namespace Almacen\Ssst\utils;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use Exception;

class ValMRiesgos extends MRiesgos{
//Para poder regresar el tipo de objweto me pide que lo erede ;v 
    public function validate($request):MRiesgos
    {
    
    if(empty($request['area']) || $request['area'] == 0 ){
        throw new Exception("Error de área, seleciona una");
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

     if($request['estatus'] != 0 && $request['estatus'] != 1){
        throw new Exception("Error de estatus");
     }
     $this->estatus = $request['estatus'];
     
     if(empty($request['prioridad']) || $request['prioridad'] == 0){
        throw new Exception("Ingresa la prioridad");
     }
    $this->prioridad = $request['prioridad'];

    if($this->estatus == 1){
     if(empty($request['solucion'])){
        throw new Exception("Ingresa la solucion del problema");
     }
     $this->solucion = $request['solucion'];
    }
     $this->id = $request['idRiesgo'];
     
     $mo = new MRiesgos();
     $mo = $this;
     return $mo;
     

    }

   
}