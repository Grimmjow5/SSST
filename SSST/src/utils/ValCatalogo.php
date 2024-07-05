<?php
namespace Almacen\Ssst\utils;

use Almacen\Ssst\dbrepo\models\MCatalogo;
use Exception;

class ValCatalogo extends MCatalogo{
    
    
   public function validate($request) : MCatalogo {
               
         if(empty($request['subarea']) || $request['subarea'] == 0 ){
            throw new Exception("Error de Subrea, seleciona una");
         }
         $this->idSubArea = $request['subarea'];

         if(empty($request['nExtintor'])){
            throw new Exception("Ingresa el numero de extintor");
         }
         $this->num_extintor = $request['nExtintor']; 

         if($request['estatus'] != 0 && $request['estatus'] != 1){
            throw new Exception("Error de estatus");
         }
         $this->estatus = $request['estatus'];

         if(empty($request['nInventario'])){
            throw new Exception("Ingresa el numero de inventario");
         }
         $this->num_inventario = $request['nInventario'];

         $this->id = $request['idExtintor'];

         $this->idSubArea = $request['subarea'];
                   
         $mo = new MCatalogo();
         $mo = $this;
         return $mo;
   }
}