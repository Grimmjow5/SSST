<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_Cat;
use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MCatalogo; 
use DateTime;
use Exception;


class CatMain extends ConfigDb implements ICat_Cat {
    
    public $table ;
    public $rowVal;
    public $logic;
    
    public function getAll( )
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
    public function set_modelCat(MCatalogo $catalogo):bool{
            try{
                $sql ="CALL InsertCatExtintor(?,?,?,?)";
                $dateNow = new DateTime();

                $stmt = parent::prepare($sql);
                
                $stmt->bindValue(1,$catalogo->num_inventario);

                $catalogo->fecha_registro = $dateNow->format("Y-m-d H:i");
                $stmt->bindValue(2,$catalogo->fecha_registro); 

                $stmt->bindValue(3,$catalogo->num_extintor);

                $stmt->bindValue(4,$catalogo->estatus, \PDO::PARAM_BOOL);
                
                $stmt->execute();
            }catch(Exception $ex){
                
                throw new Exception($ex);
            }
        return true;
    }
    
    //Actualizacion del modelo de extintores

    public function put_modelCat(Mcatalogo $model):bool{
        
        
        try {
            $sql = "CALL UpdateCatExtintor(?, ?, ?, ?)";

            $stmt = parent::prepare($sql);

            $stmt->bindValue(1, $model->id);

            $stmt->bindValue(2, $model->num_inventario);

            $stmt->bindValue(3, $model->num_extintor);
            
            $stmt->bindValue(4, $model->estatus, \PDO::PARAM_BOOL);

            $stmt->execute();

        } catch (\Throwable $th) {
            return false;
        }
       return true; 

    }
}