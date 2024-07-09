<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_Cat;
use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MCatalogo; 
use DateTime;
use Exception;
use PDO;

class CatMain extends ConfigDb implements ICat_Cat {
    
    public $table;
    public $rowVal;
    public $logic;
    
    public function getAll() {
        $condicion = empty($this->rowVal) ? " " : "{$this->generate($this->rowVal)}";
        $sql = "SELECT * FROM {$this->table} {$condicion};";
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
            // Puedes registrar el error, mostrar un mensaje al usuario, o cualquier otra acción necesaria
            return []; // Otra acción para manejar el fallo de la consulta
        }
   
    }

    private function generate(array $rowval): string {
        $stringSql = "WHERE ";
        $index = 1;
        foreach ($rowval as $key => $value) {
            $arrPrincipal = $value;       
            foreach ($arrPrincipal as $idValor) {
                if ($index == count($arrPrincipal)) {
                    $stringSql .= " {$key} = {$idValor}";
                } else {
                    $stringSql .= " {$key} = {$idValor} {$this->logic}";
                }
                $index++;
            }  
        }
        return $stringSql;
    }

    public function set_modelCat(MCatalogo $catalogo): bool {
        try {
            if ($this->checkNumExtintorExists($catalogo->num_inventario)) {
                throw new Exception("El número de inventario ya existe.");
            }

            $sql = "CALL InsertCatExtintor(?, ?, ?, ?, ?, ?)";
            $dateNow = new DateTime();

            $stmt = parent::prepare($sql);
            
            $stmt->bindValue(1, $catalogo->num_inventario, \PDO::PARAM_INT);
            $catalogo->fecha_registro = $dateNow->format("Y-m-d H:i");
            $stmt->bindValue(2, $catalogo->fecha_registro); 
            $stmt->bindValue(3, $catalogo->num_extintor, \PDO::PARAM_INT);
            $stmt->bindValue(4, $catalogo->estatus, \PDO::PARAM_BOOL);
            $catalogo->idRegUser = $_SESSION["id_usuario"];
            $stmt->bindValue(5, $catalogo->idRegUser); 
            $stmt->bindValue(6, $catalogo->idSubArea, \PDO::PARAM_INT);

            $stmt->execute();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
        return true;
    }

    private function checkNumExtintorExists(int $num_extintor): bool {
        $sql = "CALL CheckNumExtintorExists(?)";
        $stmt = parent::prepare($sql);
        $stmt->bindValue(1, $num_extintor, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(parent::FETCH_ASSOC);

        return $result['extintor_count'] > 0;
    }
    
    public function put_modelCat(MCatalogo $model): bool {
        try {
            $sql = "CALL UpdateCatExtintor(?, ?, ?, ?, ?)";

            $stmt = parent::prepare($sql);

            $stmt->bindValue(1, $model->id, \PDO::PARAM_INT);

            $stmt->bindValue(2, $model->num_inventario, \PDO::PARAM_INT);

            $stmt->bindValue(3, $model->num_extintor, \PDO::PARAM_INT);
            
            $stmt->bindValue(4, $model->estatus, \PDO::PARAM_BOOL);
            
            $stmt->bindValue(5, $model->idSubArea, \PDO::PARAM_INT);

            $stmt->execute();
        } catch (Exception $ex) {
            return false;
        }
        return true;
    }
}