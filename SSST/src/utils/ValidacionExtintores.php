<?php
namespace Almacen\Ssst\utils;

use Almacen\Ssst\dbrepo\models\MExtintores;
use Exception;

class ValidacionExtintores extends MExtintores{
    
    public function __construct()
    {

    }
public function validate($request) : MExtintores {
    
            if(empty($request['area']) || $request['area'] == 0 ){
                  throw new Exception("Error de área, seleciona una");
            }
             $this->idArea = $request['area'];

           
           
             if(empty($request['extintor']) || $request['extintor'] == 0 ){
               throw new Exception("Error de área, NuExtintor");
            }
            $this->idExtintor=$request['extintor'];

           
            if (empty($request['pregunta1']) && $request['pregunta1'] !== '0'){
               throw new Exception("Contesta la pregunta 1");

            }
            $this->lugarDesigando = $request['pregunta2'];
         
            if (empty($request['pregunta2']) && $request['pregunta2'] !== '0'){
                  throw new Exception("Contesta la pregunta 2");
            }
            $this->accesoM = $request['pregunta2'];

            if (empty($request['pregunta3']) && $request['pregunta3'] !== '0'){
                  throw new Exception("Contesta la pregunta 3");
            }
            $this->senalM = $request['pregunta3'];

            if (empty($request['pregunta4']) && $request['pregunta4'] !== '0'){
                  throw new Exception("Contesta la pregunta 4");
            }
            $this->instrucionM = $request['pregunta4'];

            if (empty($request['pregunta5']) && $request['pregunta5'] !== '0'){
                  throw new Exception("Contesta la pregunta 5");
            }
            $this->manijasM = $request['pregunta5'];

            if (empty($request['pregunta6']) && $request['pregunta6'] !== '0'){
                  throw new Exception("Contesta la pregunta 6");
            }
            $this->selloM = $request['pregunta6'];

            if (empty($request['pregunta7']) && $request['pregunta7'] !== '0'){
                  throw new Exception("Contesta la pregunta 7");
            }
            $this->lecturaM = $request['pregunta7'];

            if (empty($request['pregunta8']) && $request['pregunta8'] !== '0'){
                  throw new Exception("Contesta la pregunta 8");
            }
            $this->danoM = $request['pregunta8'];
            //Fin de validacion de preguntas

            if(empty($request['txtPeso'])){
               throw new Exception("Ingresa el peso del extintor");
            }
            $this->pesoM = $request['txtPeso'];
        
            if(empty($request['txtAltura'])){
               throw new Exception("Ingresa la altura");
            }
            $this->alturaM = $request['txtAltura'];

            if(empty($request['fechaUltRec'])){
                throw new Exception("Ingresa la fecha de ultima recarga");
            }
            $this->fecha_UrecargaM = $request['fechaUltRec'];

            if(empty($request['fechaProxRec'])){
                throw new Exception("Ingresa la fecha de la proxima recarga");
            }
            $this->fecha_PrecargaM = $request['fechaProxRec'];

                    
            $mo = new MExtintores();
            $mo = $this;
            return $mo;
}
}