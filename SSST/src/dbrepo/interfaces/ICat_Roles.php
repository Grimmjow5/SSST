<?php

namespace Almacen\Ssst\dbrepo\interfaces;



use Almacen\Ssst\dbrepo\models\MRoles;


interface ICat_Roles{

    public function getAll();

    public function set_modelRol(MRoles $model):bool;
    public function put_modelRol(MRoles $model):bool;
}