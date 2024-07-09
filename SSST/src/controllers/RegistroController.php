<?php

namespace Almacen\Ssst\controllers;

use Almacen\Ssst\dbrepo\Factory;
use Almacen\Ssst\dbrepo\models\MRegistro;
use Almacen\Ssst\dbrepo\ReMain;
use Almacen\Ssst\utils\ValRegistro;
use Exception;
use Flight;

class RegistroController extends Flight
{
    private ValRegistro $re;
    private MRegistro $model;
    private Factory $Registro;

    public function __construct()
    {
        $this->model = new MRegistro();
        $this->re = new ValRegistro();
        $this->Registro = new Factory();
        $this->Registro->getCatalogosRe(new ReMain());
    }

    private function checkAdmin()
    {
        if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 1) {
            parent::halt(403, "Acceso denegado: Solo puede acceder personal autorizado .");
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $this->Registro->getCatRe->rowVal = [];
        $this->Registro->getCatRe->table = 'roles';
        $this->Registro->getCatRe->logic = "and";
        $roles = $this->Registro->getCatRe->getRol();
        $this->Registro->getCatRe->table = 'cat_areas';
        $area = $this->Registro->getCatRe->getArea();
        $this->Registro->getCatRe->table = 'cat_sub_areas';
        $subArea = $this->Registro->getCatRe->getSubArea();

        parent::render('Registro/index', ['roles' => $roles, 'area' => $area, 'subArea' => $subArea]);
    }

    public function postRegistro()
    {
        $this->checkAdmin();

        try {
            $this->model = $this->re->validate($_REQUEST);

            // Decodificar el campo SubArea de JSON a array
            if (isset($_REQUEST['subarea'])) {
                $this->model->SubArea = json_decode($_REQUEST['subarea'], true);
                
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception("Error al decodificar SubArea: " . json_last_error_msg());
                }

                if (!is_array($this->model->SubArea)) {
                    throw new Exception("El campo SubArea debe ser un arreglo. Tipo recibido: " . gettype($this->model->SubArea));
                }
            }

            $save = false;
            if (empty($this->model->id) || $this->model->id == 0) {
                $save = $this->Registro->getCatRe->set_modelRes($this->model);
            } else {
                $save = $this->Registro->getCatRe->put_modelRes($this->model);
            }

            if ($save) {
                parent::json(["OK"], 200);
            } else {
                parent::json(["F"], 400);
            }
        } catch (Exception $ex) {
            parent::json(['res' => $ex->getMessage()], 422);
        }
    }

    public function getRegistro()
    {
        $this->Registro->getCatRe->table = "vista_usuario";
        $resul = $this->Registro->getCatRe->getAll();
        parent::json(['data' => $resul]);
    }
}
