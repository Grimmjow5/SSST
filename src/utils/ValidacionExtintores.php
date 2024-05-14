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
             
            if(empty($request['txtNumIn'])){
                throw new Exception("Ingresa el No. De Inventario");    
            }
            $this->idExtintor = $request['txtNumIn'];
             
             if(empty($request['txtPeso'])){
                throw new Exception("Ingresa el peso del extintor");
             }
             $this->pesoM = $request['txtPeso'];
        
             if(empty($request['txtAltura'])){
               throw new Exception("Ingresa la altura");
            }
            $this->pesoM = $request['txtAltura'];

                    
            $mo = new MExtintores();
            $mo = $this;
            return $mo;
}
}