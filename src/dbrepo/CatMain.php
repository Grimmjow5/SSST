<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_Cat;
use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MCatalogo; 
use DateTime;
use Exception;

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

            $sql = "CALL InsertCatExtintor(?, ?, ?, ?, ?)";
            $dateNow = new DateTime();

            $stmt = parent::prepare($sql);
            
            $stmt->bindValue(1, $catalogo->num_inventario, \PDO::PARAM_INT);
            $catalogo->fecha_registro = $dateNow->format("Y-m-d H:i");
            $stmt->bindValue(2, $catalogo->fecha_registro); 
            $stmt->bindValue(3, $catalogo->num_extintor, \PDO::PARAM_INT);
            $stmt->bindValue(4, $catalogo->estatus, \PDO::PARAM_BOOL);
            $stmt->bindValue(5, $catalogo->idArea, \PDO::PARAM_INT);

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
            $stmt->bindValue(5, $model->idArea, \PDO::PARAM_INT);

            $stmt->execute();
        } catch (Exception $ex) {
            return false;
        }
        return true;
    }
}
