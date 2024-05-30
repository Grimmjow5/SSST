<?php

namespace Almacen\Ssst\dbrepo\interfaces;



use Almacen\Ssst\dbrepo\models\MCatalogo;


interface ICat_Cat{

    public function getAll();

    public function set_modelCat(MCatalogo $model):bool;
    public function put_modelCat(MCatalogo $model):bool;
}