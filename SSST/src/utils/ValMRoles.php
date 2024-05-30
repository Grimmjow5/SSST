<?php
namespace Almacen\Ssst\utils;

use Almacen\Ssst\dbrepo\models\MRoles;
use Exception;

class ValMRoles extends MRoles{
    
    
   public function validate($request) : MRoles {
               
               
         if(empty($request['nomRol'])){
            throw new Exception("Ingresa el nombre del rol nuevo");
         }
         $this->textRol = $request['nomRol']; 

         if($request['estatus'] != 0 && $request['estatus'] != 1){
            throw new Exception("Error de estatus");
         }
         $this->estatus = $request['estatus'];

         $this->id = $request['idRol'];
                   
         $mo = new MRoles();
         $mo = $this;
         return $mo;
   }
}