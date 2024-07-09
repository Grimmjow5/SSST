<?php 
namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\interfaces\IReports;
use Almacen\Ssst\dbrepo\models\MReportRiesgo;


class GetReports extends ConfigDb implements IReports {
    
    private string $dateRegistro;
    private string $idSubArea;
    private string $dateSolution;
    private string $statusSolution;

    //En caso de que sea solucionado 
    private string $condicion;
    public function GetReports(MReportRiesgo $model){
        //$sql = "SELECT * FROM mv_riesgos";
       //Rango de resgistro del riesgo
        $this->dateRegistro = $this->validateDateReg($model->fechaMin, $model->fechaMax);
        //Rango de solución 
        $this->dateSolution = $this->validateDateSolution($model->fechaMinSolucion, $model->fechaMaxSolucion,$model->estatus);
        //Área
        $this->idSubArea = $model->subarea > 0 ?" AND id_sub={$model->subarea}":" ";
        //Estatus resportado o solucionado 
        $this->statusSolution = $model->estatus == 1 || $model->estatus == 0 ? "AND estatus={$model->estatus}":" ";

        $sql = "SELECT * from mv_riesgos WHERE {$this->dateRegistro}  {$this->dateSolution} {$this->statusSolution} {$this->idSubArea} ;";
  
        $stmt = parent::prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(parent::FETCH_ASSOC);
      
    }
    private function validateDateSolution(string $fechaMin,string $fechaMax,string $estatus ):string{
        //Si el estatus es solucionado == 1 => AND
         if($estatus == 1){
            $this->condicion = "AND";
         }else{
            $this->condicion="OR";
         }   
         if(empty($fechaMin) &&  empty($fechaMax)){
            return " ";
        }
        
        if(!empty($fechaMin) &&  empty($fechaMax)){
            return "{$this->condicion} date(fecha_solucion) >= '{$fechaMin}'";
        }

        if(empty($fechaMin) &&  !empty($fechaMax)){
            return "{$this->condicion} date(fecha_solucion) <= '{$fechaMax}'";            
        }

        if(!empty($fechaMin) &&  !empty($fechaMax)){
            return "{$this->condicion} date(fecha_solucion) >= '{$fechaMin}' {$this->condicion} date(fecha_solucion) <= '{$fechaMax}' ";
        }
        
    }
    private function validateDateReg(string $fechaMin,string $fechaMax):string{
   
        if(empty($fechaMin) &&  empty($fechaMax)){
            return " ";
        }
        
        if(!empty($fechaMin) &&  empty($fechaMax)){
            return " date(fechaRegistro) >= '{$fechaMin}'";
        }

        if(empty($fechaMin) &&  !empty($fechaMax)){
            return " date(fechaRegistro) <= '{$fechaMax}'";            
        }

        if(!empty($fechaMin) &&  !empty($fechaMax)){
            return " date(fechaRegistro) >= '{$fechaMin}' AND date(fechaRegistro) <= '{$fechaMax}' ";
        }
    
    }
}