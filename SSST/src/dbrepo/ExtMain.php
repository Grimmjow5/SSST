<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_ConsultaEx;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MExtintores; 
use DateTime;
use Exception;


class ExtMain extends ConfigDb implements ICat_ConsultaEx {
    
    public $table ;
    public $rowVal;
    public $logic;


    public function getExt(){
        $condicion = empty($this->rowVal) ? " WHERE estatus = 1" : "{$this->generate($this->rowVal)} AND estatus = 1";
        $sql = "SELECT * FROM {$this->table} {$condicion};";
        $stmt = parent::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(parent::FETCH_ASSOC);    
    }
    
    public function getAll()
    {
        $condicion = empty($this->rowVal) ? " " : "{$this->generate($this->rowVal) }";
        $sql ="SELECT * FROM {$this->table}  {$condicion};";
        $stmt = parent::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(parent::FETCH_ASSOC);              
    }
    private function generate(array  $rowval):string{
        $stringSql = "WHERE ";
        $index = 1;
        foreach ($rowval as  $key => $value) {
            $arrPrincipal = $value;       
            foreach ($arrPrincipal as $idValor) {
                if( $index == count($arrPrincipal)){

                $stringSql .= " {$key} = {$idValor}";
                }else{
                    $stringSql .= " {$key} = {$idValor} {$this->logic}";
                }
                $index++;
            }  
        }
        return $stringSql;
    }
    //Insert extintores
    public function set_modelEx(MExtintores $extintores):bool{
            try{
                $sql = "CALL InsertarRegExtintor(
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                )";
    
                $dateNow = new DateTime();
    
                $stmt = parent::prepare($sql);
    
                $stmt->bindValue(1, $extintores->idExtintor);
                $stmt->bindValue(2, $extintores->idArea);
                $stmt->bindValue(3, null); // id_direccion
                $extintores->idMes = $dateNow->format("m");
                $stmt->bindValue(4, $extintores->idMes);
    
                $stmt->bindValue(5, $extintores->lugarDesigando); 
                $stmt->bindValue(6, $extintores->accesoM);
                $stmt->bindValue(7, $extintores->senalM);
                $stmt->bindValue(8, $extintores->instrucionM); 
                $stmt->bindValue(9, $extintores->selloM); 
                $stmt->bindValue(10, $extintores->lecturaM); 
                $stmt->bindValue(11, $extintores->danoM);
                $stmt->bindValue(12, $extintores->alturaM); 
                $stmt->bindValue(13, $extintores->manijasM); 
                $stmt->bindValue(14, $extintores->pesoM);
                $stmt->bindValue(15, $extintores->fecha_UrecargaM); 
                $stmt->bindValue(16, $extintores->fecha_PrecargaM);
    
                $extintores->fechaRegistro = $dateNow->format("Y-m-d H:i");
                $stmt->bindValue(17, $extintores->fechaRegistro); 
    
                $extintores->idRegUser = $_SESSION["id_usuario"];
                $stmt->bindValue(18, $extintores->idRegUser); 
    
                $stmt->bindValue(19, null); // fecha_modificacion
                $stmt->bindValue(20, null); // resp_modificacion
    
                $stmt->execute();
            }catch(Exception $ex){
                throw new Exception($ex);
            }
        return true;
    }
    
    //Actualizacion del modelo de extintores

    public function put_modelEx(MExtintores $model):bool{
         
       return true; 
    }
}