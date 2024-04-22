<?php

namespace Almacen\Ssst\dbrepo;


use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use stdClass;

interface ICat_Consultas{

    public function get_Cat();

    public function set_model(MRiesgos $model);

}