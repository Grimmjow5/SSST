<?php

namespace Almacen\Ssst\dbrepo\interfaces;




use Almacen\Ssst\dbrepo\models\MRegistro;

interface ICat_ConsultaRes{

    public function getAll();
    public function getRol();

    public function set_modelRes(MRegistro $model):bool;
    public function put_modelRes(MRegistro $model):bool;
}