<?php

namespace Almacen\Ssst\dbrepo\models;

class MRiesgos {

    #Datos que ingresara el ususario
    public $id;
    public $idArea;
    public $id_control;
    public $descripcion;
    public $prioridad;
    public $estatus;
    public $solucion;
    
    #Datos ingresados en automatico
    public $idMes;
    
}
