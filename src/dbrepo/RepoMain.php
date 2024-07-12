<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_Consultas;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use DateTime;
use Exception;
use PDO;


class RepoMain extends ConfigDb implements ICat_Consultas {
    
    public $table ;
    public $rowVal;
    public $logic;
    //Es para vista seleccion de área
    public function getAll( )
    {
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
        $conditions = [];
        foreach ($rowval as $key => $values) {
            $subConditions = [];
            foreach ($values as $index => $value) {
                if ($index > 0) {
                    $subConditions[] = "{$key} = {$value}";
                } else {
                    $subConditions[] = "{$key} = {$value}";
                }
            }
            $conditions[] = "(" . implode(" {$this->logic} ", $subConditions) . ")";
        }
        return "WHERE " . implode(" AND ", $conditions);
    }
    
    //Insert riesgo en Db 
    public function set_model(MRiesgos $riesgo):bool{
            try{
                $sql ="INSERT INTO
                    `mv_riesgos` (`id`, `id_mes`, `text_Riesgo`, `id_userReg`, `fechaRegistro`, `fechaModificacion`, `id_userModificacion`, `estatus`,`prioridad`, `fecha_solucion` ,`solucion`, `id_sub`)
                        VALUES   (NULL,      ?,         ?,         ?,             ?,                     NULL,                 NULL,             b?,        ?,              ?,            ?    ,      ?)";
                 $dateNow = new DateTime();

                $stmt = parent::prepare($sql);
                //Preparet
                $riesgo->idMes = $dateNow->format("m");
                $stmt->bindValue(1,$riesgo->idMes); 
                $stmt->bindValue(2,$riesgo->descripcion); 

                $riesgo->idRegUser = $_SESSION["id_usuario"];
                $stmt->bindValue(3,$riesgo->idRegUser); 
                //Dar el valor del registro

                $riesgo->fechaRegistro = $dateNow->format("Y-m-d H:i");
                $stmt->bindValue(4,$riesgo->fechaRegistro); 
               
                $stmt->bindValue(5, $riesgo->estatus);
                $stmt->bindValue(6,$riesgo->prioridad);

                if ($riesgo->estatus) {
                    $this->table = "mv_riesgos";
                    $this->rowVal = array("id" => array($riesgo->id));
                    $registros = $this->getAll(); // Devuelve un array de registros
                    
                    $fechaSolucionAsignada = false;
                    
                    foreach ($registros as $registro) {
                        if (array_key_exists('estatus', $registro)) {
                            if (($registro['estatus'] == 1) && $riesgo->estatus == 1) {
                                $riesgo->fechaSolucion = $registro['fecha_solucion'];
                                $riesgo->solucion = null;
                                $fechaSolucionAsignada = true;
                                break; // Salir del bucle si se encuentra la condición
                            }
                        }
                    }
                    
                    if (!$fechaSolucionAsignada) {
                        $riesgo->fechaSolucion = $dateNow->format("Y-m-d H:i");
                    }
                } else {
                    $riesgo->fechaSolucion = null;
                }
                
                
                $stmt->bindValue(7,$riesgo->fechaSolucion);
              
                $stmt->bindValue(8, $riesgo->solucion);
                
                $stmt->bindValue(9, $riesgo->idSubArea);

                $stmt->execute();
            }catch(Exception $ex){
                throw new Exception($ex);
            }
        return true;
    }
    
    //Actualizacion del modelo de riesgo
    public function put_model(MRiesgos $model):bool{
        // UPDATE `mv_riesgos` SET `id_area` = '12', `id_mes` = '5', `text_Riesgo` = 'Nueva con la fecha de solucionfsdf', `fechaModificacion` = '2024-04-11 12:33:14', `id_userModificacion` = '2', `solucion` = 'la solucion de todo nueva con la fechasds' WHERE `mv_riesgos`.`id` = 13;
        $fech = new DateTime();
        $sql = "UPDATE `mv_riesgos` 
                SET  `text_Riesgo` = ?, `fechaModificacion` = ?, `id_userModificacion` = ?, estatus= b?, prioridad= ?, fecha_solucion=?, `solucion` = ?, `id_sub` = ?  WHERE `mv_riesgos`.`id` = ?;";
        
        try {
            $stmt = parent::prepare($sql);
            
            //Preguntar que show con el mes 
            $stmt->bindValue(1, $model->descripcion) ;

            $model->fechaModificacion = $fech->format("Y-m-d H:i");
            $stmt->bindValue(2,$model->fechaModificacion);

            $model->idUserMod = $_SESSION["id_usuario"];

            $stmt->bindValue(3,$model->idUserMod); 

            $stmt->bindValue(4,$model->estatus);

            $stmt->bindValue(5,$model->prioridad);
            ///Aqui vas bien tendria que comparar en la base de datos para que se haga la correcta modificacion de fecha 
            if($model->estatus == 1){
                $model->fechaSolucion = $fech->format("Y-m-d H:i");
                
            }
            $stmt->bindValue(6,$model->fechaSolucion);
            //Necesito verificar bien para que se boore en caso que se cambie el estatus del riesgo 
            $stmt->bindValue(7,$model->solucion);

            $stmt->bindValue(8, $model->idSubArea);
            
            $stmt->bindValue(9, $model->id);
            
            $stmt->execute();
        } catch (\Throwable $th) {
            return false;
        }
       return true; 
    }
}