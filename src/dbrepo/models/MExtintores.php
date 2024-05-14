<?php

namespace Almacen\Ssst\dbrepo\models;

class MExtintores {

    #Datos que ingresara el ususario
    public $id;
    public $idExtintor;
    public $idArea;
    public $lugarDesigando;
    public $accesoM;
    public $senalM;
    public $instrucionM;
    public $selloM;
    public $lecturaM;
    public $danoM;
    public $manijasM;
    public $alturaM;
    public $pesoM;
    public $fecha_UrecargaM;
    public $fecha_PrecargaM;
    
    #Datos ingresados en automatico
    public $idDireccion;
    public $idMes;
    public $idRegUser;
    public $fechaRegistro;
    public $fechaModificacion;
    public $idUserMod;
    
}
