<?php

namespace Almacen\Ssst\dbrepo\interfaces;

use Almacen\Ssst\dbrepo\models\MRiesgos;

interface ICat_Consultas{

    public function getAll();
    public function getSubArea();

    public function set_model(MRiesgos $model):bool;
    public function put_model(MRiesgos $model):bool;
}