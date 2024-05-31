<?php

namespace Almacen\Ssst\dbrepo\interfaces;


use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use stdClass;

interface ICat_Consultas{

    public function getAll();

    public function set_model(MRiesgos $model):bool;
    public function put_model(MRiesgos $model):bool;
}