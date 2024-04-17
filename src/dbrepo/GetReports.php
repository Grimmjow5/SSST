<?php 
namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\interfaces\IReports;
use Almacen\Ssst\dbrepo\models\MReportRiesgo;

class GetReports extends ConfigDb implements IReports {


    public function GetReports(MReportRiesgo $model){
        //$sql = "SELECT * FROM mv_riesgos";
        //Para ingresar la fecha de conclusion en dado de que si ingresar el string para crear una nueva consulta de entre 

        $commandSolucion =" ";

        if($model->estatus== '1'){
            //si viene vacio entonces no ejecutar consulta con las condiciones
            if(!empty($model->fechaMax) ){

                 $commandSolucion ="AND date(fechaRegistro)<= '{$model->fechaMax}'"; 
            }
        }else{
            $commandSolucion =" ";
        }
        //En esta opcion se pueden dat tres opcion
        //1, reportado, 2. Solucionado y 3. Todos los dos juntos
        switch($model->estatus){
                    case 1:
                $estatus ='AND estatus =1';
                break;
            case 0:
                $estatus = 'AND estatus=0';
                break;
            default:
            $estatus =" ";
        }
        
        $area = $model->area != 0  ? " AND id_area={$model->area}": " ";
            
        $whereSolution = "";
        if(!empty($model->fechaMinSolucion)){
            $whereSolution.= " AND fecha_solucion >= { $model->fechaMinSolucion}";
        }
        if(!empty($model->fechaMaxSolucion)){
            $whereSolution .= " AND fecha_solucion <={$model->fechaMaxSolucion}";
        }

        $sql = "SELECT * from mv_riesgos WHERE date(fechaRegistro) >= '{$model->fechaMin}' {$commandSolucion} {$area}  {$estatus} ";
        $stmt = parent::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(parent::FETCH_ASSOC);
      
    } 
}