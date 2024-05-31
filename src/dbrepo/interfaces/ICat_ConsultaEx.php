<?php

namespace Almacen\Ssst\dbrepo\interfaces;



use Almacen\Ssst\dbrepo\models\MExtintores;


interface ICat_ConsultaEx{

    public function getAll();
    public function getExt();

    public function set_modelEx(MExtintores $model):bool;
    public function put_modelEx(MExtintores $model):bool;
}