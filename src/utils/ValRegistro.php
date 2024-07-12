<?php
namespace Almacen\Ssst\utils;
use Almacen\Ssst\dbrepo\models\MRegistro;
use Exception;

class ValRegistro extends MRegistro {
     public function validate($request):MRegistro{

         if(empty($request['txtNombre'])){
               throw new Exception("Ingresa tu nombre");
            }
            $this->Nombre = $request['txtNombre'];

         
            if(empty($request['txtApellP'])){
               throw new Exception("Ingresa tu apellidoP");
            }
            $this->ApellP = $request['txtApellP'];


            if(empty($request['txtUsuario'])){
               throw new Exception("Ingresa tu usuario");
            }
            $this->Usuario = $request['txtUsuario'];

            if($request['estatus'] != 0 && $request['estatus'] != 1){
               throw new Exception("Error de estatus");
         }
            $this->Estatus = $request['estatus'];
            

            if(empty($request['rol']) || $request['rol'] == 0 ){
               throw new Exception("Error de rol, seleciona una");
            }
            $this->idRol = $request['rol'];

            /*if(empty($request['area']) || $request['area'] == 0){
               throw new Exception("Error de area, seleciona una");
            }*/
            
            if(empty($request['correo'])){
               throw new Exception(("ingresa tu correo"));
         
               if (!filter_var($this->Correo, FILTER_VALIDATE_EMAIL) || !preg_match("/@gmail\.com$/", $this->Correo)) {
                  throw new Exception("Ingresa un correo electrónico válido de Gmail");
            }
            }
            $this->Correo = $request['correo'];

            if(empty($request['password'])){
               throw new Exception("Ingresa la contraseña");
            }
            $this->Password = $request['password'];

            if(empty($request['subarea'] || $request['subarea'] == 0)){
               throw new Exception("Ingresa la supArea");
            }
            $this->SubArea = $request['subarea'];

      $mo = new MRegistro();
      $mo = $this;
      return $mo;
   }
    


    

}

