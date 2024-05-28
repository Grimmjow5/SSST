<?php 
namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\interfaces\IReportsExt;
use Almacen\Ssst\dbrepo\models\MReportExt;


class GetReportsExt extends ConfigDb implements IReportsExt {
    
    private string $dateRegistro;
    private string $idArea;


    //En caso de que sea solucionado 
    private string $condicion;
    public function GetReportsExt(MReportExt $model){
       
       //Rango de resgistro del riesgo
        $this->dateRegistro = $this->validateDateReg($model->fecha);
        //Área
        $this->idArea = $model->area > 0 ?" AND id_area={$model->area}":" ";
        
        $sql = "SELECT * from reg_extintores WHERE {$this->dateRegistro} {$this->idArea} ;";
  

        $stmt = parent::prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(parent::FETCH_ASSOC);
      
    }
   
    private function validateDateReg(string $fecha):string{
   
        if(empty($fecha)){
            return " ";
        }
    
    }
}