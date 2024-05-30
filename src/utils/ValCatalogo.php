<?php
namespace Almacen\Ssst\utils;

use Almacen\Ssst\dbrepo\models\MCatalogo;
use Exception;

class ValCatalogo extends MCatalogo{
    
    
   public function validate($request) : MCatalogo {
               
               
         if(empty($request['nExtintor'])){
            throw new Exception("Ingresa el numero de extintor");
         }
         $this->num_extintor = $request['nExtintor']; 

         if(empty($request['area']) || $request['area'] == 0 ){
            throw new Exception("Error de área, seleciona una");
      }
       $this->idArea = $request['area'];

         if($request['estatus'] != 0 && $request['estatus'] != 1){
            throw new Exception("Error de estatus");
         }
         $this->estatus = $request['estatus'];

         if(empty($request['nInventario'])){
            throw new Exception("Ingresa el numero de inventario");
         }
         $this->num_inventario = $request['nInventario'];

         $this->id = $request['idExtintor'];
                   
         $mo = new MCatalogo();
         $mo = $this;
         return $mo;
   }
}