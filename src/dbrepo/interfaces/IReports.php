<?php
namespace Almacen\Ssst\dbrepo\interfaces;

use Almacen\Ssst\dbrepo\models\MReportRiesgo;

interface IReports{
public function GetReports(MReportRiesgo $model);

}