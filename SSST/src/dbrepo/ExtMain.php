<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_ConsultaEx;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MExtintores; 
use DateTime;
use Exception;
use PDO;


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

    public function getSubArea(){
        try {
            $idUsuario = $_SESSION["id_usuario"];
            
            // Usando sentencia preparada para la seguridad
            $condicion = empty($this->rowVal) ? "WHERE id_user = :idUsuario" : $this->generate($this->rowVal);
            
            $sql = "SELECT * FROM {$this->table} {$condicion}";
            
            $stmt = $this->prepare($sql);
            
            // Asignar el parámetro si es necesario
            if (empty($this->rowVal)) {
                $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            }
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Manejar el error de la base de datos
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
            // Puedes registrar el error, mostrar un mensaje al usuario, o cualquier otra acción necesaria
            return []; // Otra acción para manejar el fallo de la consulta
 // Otra acción para manejar el fallo de la consulta

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
                $sql = "CALL InsertarRegExtintor(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
                $dateNow = new DateTime();
    
                $stmt = parent::prepare($sql);
    
                $stmt->bindValue(1, $extintores->idExtintor);

                $stmt->bindValue(2, null); // id_direccion

                $extintores->idMes = $dateNow->format("m");
                $stmt->bindValue(3, $extintores->idMes);
    
                $stmt->bindValue(4, $extintores->lugarDesigando, \PDO::PARAM_BOOL); 

                $stmt->bindValue(5, $extintores->accesoM, \PDO::PARAM_BOOL);

                $stmt->bindValue(6, $extintores->senalM, \PDO::PARAM_BOOL);

                $stmt->bindValue(7, $extintores->instrucionM, \PDO::PARAM_BOOL); 

                $stmt->bindValue(8, $extintores->selloM, \PDO::PARAM_BOOL); 

                $stmt->bindValue(9, $extintores->lecturaM, \PDO::PARAM_BOOL); 

                $stmt->bindValue(10, $extintores->danoM, \PDO::PARAM_BOOL);

                $stmt->bindValue(11, $extintores->alturaM); 

                $stmt->bindValue(12, $extintores->manijasM, \PDO::PARAM_BOOL); 

                $stmt->bindValue(13, $extintores->pesoM);

                $stmt->bindValue(14, $extintores->fecha_UrecargaM); 

                $stmt->bindValue(15, $extintores->fecha_PrecargaM);
    
                $extintores->fechaRegistro = $dateNow->format("Y-m-d H:i");
                $stmt->bindValue(16, $extintores->fechaRegistro); 
                
                $extintores->idRegUser = $_SESSION["id_usuario"];
                $stmt->bindValue(17, $extintores->idRegUser); 
    
                $stmt->bindValue(18, null); // fecha_modificacion

                $stmt->bindValue(19, null); // resp_modificacion

                $stmt->bindValue(20, $extintores->idSubArea);
    
                $stmt->execute();
            }catch(Exception $ex){
                throw new Exception($ex);
            }
        return true;
    }
    
    //Actualizacion del modelo de extintores

    public function put_modelEx(MExtintores $extintores):bool{

       return true; 
    }
}