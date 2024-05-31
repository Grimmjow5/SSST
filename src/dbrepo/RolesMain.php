<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_Roles;
use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MRoles; 
use DateTime;
use Exception;


class RolesMain extends ConfigDb implements ICat_Roles {
    
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
    public function set_modelRol(MRoles $roles):bool{
            try{
                $sql = "CALL InsertRol(?, ?, ?, ?)";
                $dateNow = new DateTime();

                $stmt = parent::prepare($sql);
                
                $roles->idUser = $_SESSION["id_usuario"];
                $stmt->bindValue(1, $roles->idUser);

                $roles->fecha_registro = $dateNow->format("Y-m-d H:i:s");
                $stmt->bindValue(2, $roles->fecha_registro); 

                $stmt->bindValue(3, $roles->textRol);

                $stmt->bindValue(4, $roles->estatus, \PDO::PARAM_BOOL);
                    
                $stmt->execute();
            }catch(Exception $ex){
                
                throw new Exception($ex);
            }
        return true;
    }
    
    //Actualizacion del modelo de roles

    public function put_modelRol(MRoles $model):bool{
        
        try {
            $sql = "CALL UpdateRol(?, ?, ?)";
            $stmt = parent::prepare($sql);
            
            $stmt->bindValue(1, $model->id);
            $stmt->bindValue(2, $model->textRol);
            $stmt->bindValue(3, $model->estatus, \PDO::PARAM_BOOL);
            
            $stmt->execute();
        } catch (\Throwable $th) {
            return false;
        }
       return true; 
    }
}