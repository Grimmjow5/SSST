<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\ICat_Consultas;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use Exception;
use stdClass;

class Riesgos extends ConfigDb implements ICat_Consultas {
    
    //Es para vista seleccion de área
    public function get_Cat()
    {
        $sql ="SELECT * FROM cat_areas WHERE activo=1;";
       $stmt = parent::prepare($sql);
        $stmt->execute();
       return $stmt->fetchAll();              
    }

    //Insert riesgo en Db 
    public function set_model(MRiesgos $riesgo):bool{
        $sql ="INSERT INTO  
        mv_riesgos(
            id_area, 
            id_mes_captura,
            id_usuario, 
            id_control, 
            descripcion, 
            solucion, 
            estatus, fecha, 
            prioridad, 
            fecha_captura, 
            resp_captura, 
            fecha_reg, 
            resp_reg, 
            anio_captura, 
            activo) VALUES
            (?,?,1,?,?,?,?,?,'01/01/01','x',?,'x','2024',b'1')";
            
            try{
                $stmt = parent::prepare($sql);
                //Preparet
                $stmt->bindValue(1,$riesgo->idArea);
                $stmt->bindValue(2,$riesgo->idMes); 
                $stmt->bindValue(3,$riesgo->id_control); 
                $stmt->bindValue(4,$riesgo->descripcion); 
                $stmt->bindValue(5,$riesgo->solucion); 
                $stmt->bindValue(6,$riesgo->solucion); 
                $stmt->bindValue(7,$riesgo->estatus); 
            /*     $stmt->bindValue(); 
                $stmt->bindValue(); 
                $stmt->bindValue(); 
                $stmt->bindValue(); 
                $stmt->bindValue(); 
                $stmt->bindValue(); 
                $stmt->bindValue(); */
                $stmt->execute();
            }catch(Exception $ex){
                throw new Exception("Error al insertar");
            }
        return true;
    }
    
    //Actualizacion del modelo de riesgo
    public function put_riesgo():bool {
       return true; 
    }
}