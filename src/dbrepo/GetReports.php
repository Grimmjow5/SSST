<?php 
namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\interfaces\IReports;
use Almacen\Ssst\dbrepo\models\MReportRiesgo;

class GetReports extends ConfigDb implements IReports {

    private string $dateRegistro;
    private string $idArea;
    private string $dateSolution;
    private string $statusSolution;

    public function GetReports(MReportRiesgo $model){
        //$sql = "SELECT * FROM mv_riesgos";
       //Rango de resgistro del riesgo
        $this->dateRegistro = $this->validateDateReg($model->fechaMin, $model->fechaMax);
        //Área
        $this->idArea = $model->area != 0 ?" AND id_area={$model->area}":" ";
        //Rango de solución 
        
        $sql = "SELECT * from mv_riesgos WHERE {$this->dateRegistro} {$this->idArea} ;";
        //return $sql;

        $stmt = parent::prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(parent::FETCH_ASSOC);
      
    } 

    private function validateDateReg(string $fechaMin,string $fechaMax):string{

        if(empty($fechaMin) &&  empty($fechaMax)){
            return " ";
        }
        
        if(!empty($fechaMin) &&  empty($fechaMax)){
            return "date(fechaRegistro) >= '{$fechaMin}'";
        }

        if(empty($fechaMin) &&  !empty($fechaMax)){
            return "date(fechaRegistro) <= '{$fechaMax}'";            
        }

        if(!empty($fechaMin) &&  !empty($fechaMax)){
            return "date(fechaRegistro) >= '{$fechaMin}' AND date(fechaRegistro) <= '{$fechaMax}' ";
        }


    
    }
}