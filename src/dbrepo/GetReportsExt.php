<?php 
namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\interfaces\IReportsExt;
use Almacen\Ssst\dbrepo\models\MReportExt;


class GetReportsExt extends ConfigDb implements IReportsExt {
    
    private string $dateMRegistro;
    private string $idSubArea;


    public function GetReportsExt(MReportExt $model){
       
       //Rango de resgistro del riesgo
        $this->dateMRegistro = $this->validateDateReg($model->fechaM, $model->fechaMax);
        //Área
        $this->idSubArea = $model->subarea > 0 ?" AND id_subarea={$model->subarea}":" ";
        
        $sql = "SELECT * from repo_ext WHERE {$this->dateMRegistro} {$this->idSubArea} ;";
  
        $stmt = parent::prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(parent::FETCH_ASSOC);
      
    }
   
    private function validateDateReg(string $fechaM, string $fechaMax):string{
   
        if (empty($fechaM) &&  empty($fechaMax)) {
            return " ";
        }
        if (!empty($fechaM) &&  empty($fechaMax)) {
            return " date(fecha_reg) >= '{$fechaM}'";
        }
        if(empty($fechaM) &&  !empty($fechaMax)){
            return " date(fecha_reg) <= '{$fechaMax}'";            
        }

        if(!empty($fechaM) &&  !empty($fechaMax)){
            return " date(fecha_reg) >= '{$fechaM}' AND date(fecha_reg) <= '{$fechaMax}' ";
        }
        
    
    }
}