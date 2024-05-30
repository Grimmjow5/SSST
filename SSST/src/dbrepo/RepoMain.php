<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_Consultas;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use DateTime;
use Exception;


class RepoMain extends ConfigDb implements ICat_Consultas {
    
    public $table ;
    public $rowVal;
    public $logic;
    //Es para vista seleccion de área
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
        $index =1;
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
    //Insert riesgo en Db 
    public function set_model(MRiesgos $riesgo):bool{
            try{
                $sql ="INSERT INTO
                    `mv_riesgos` (`id`, `id_area`, `id_mes`, `text_Riesgo`, `id_userReg`, `fechaRegistro`, `fechaModificacion`, `id_userModificacion`, `estatus`,`prioridad`, `fecha_solucion` ,`solucion`)
                        VALUES   (NULL,      ?,         ?,         ?,             ?,             ?,                 NULL,                 NULL,             b?,        ?,              ?,            ?    )";
                 $dateNow = new DateTime();

                $stmt = parent::prepare($sql);
                //Preparet
                $stmt->bindValue(1,$riesgo->idArea);
                $riesgo->idMes = $dateNow->format("m");
                $stmt->bindValue(2,$riesgo->idMes); 
                $stmt->bindValue(3,$riesgo->descripcion); 

                $riesgo->idRegUser = $_SESSION["id_usuario"];
                $stmt->bindValue(4,$riesgo->idRegUser); 
                //Dar el valor del registro

                $riesgo->fechaRegistro = $dateNow->format("Y-m-d H:i");
               $stmt->bindValue(5,$riesgo->fechaRegistro); 

               
                $stmt->bindValue(6, $riesgo->estatus);
                $stmt->bindValue(7,$riesgo->prioridad);

                if($riesgo->estatus){               
                    $this->table = "mv_riesgos";
                    $this->rowVal = array("id"=>array($riesgo->id));//
                    $registr = $this->getAll(); 

                    if( ($registr['estatus'] == 1) && $riesgo->estatus == 1){
                        $riesgo->fechaSolucion  = $registr['fecha_solucion'];
                        $riesgo->solucion = null;
                    }else{
                    $riesgo->fechaSolucion = $dateNow->format("Y-m-d H:i");                
                    }
                }else{
                    $riesgo->fechaSolucion = null;
                }
                $stmt->bindValue(8,$riesgo->fechaSolucion);
              
                $stmt->bindValue(9, $riesgo->solucion);
                //$stmt->bindValue(6,$riesgo->fechaModificacion); 

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
        $sql = "UPDATE `mv_riesgos` SET `id_area` = ? ,  `text_Riesgo` = ?, `fechaModificacion` = ?, `id_userModificacion` = ?, estatus= b?, prioridad= ?, fecha_solucion=?, `solucion` = ? WHERE `mv_riesgos`.`id` = ?;";
        
        try {
            $stmt = parent::prepare($sql);
            
            $stmt->bindValue(1, $model->idArea);
            //Preguntar que show con el mes 
            $stmt->bindValue(2, $model->descripcion) ;

            $model->fechaModificacion = $fech->format("Y-m-d H:i");
            $stmt->bindValue(3,$model->fechaModificacion);

            $model->idUserMod = $_SESSION["id_usuario"];

            $stmt->bindValue(4,$model->idUserMod); 
            $stmt->bindValue(5,$model->estatus);
            $stmt->bindValue(6,$model->prioridad);
            ///Aqui vas bien tendria que comparar en la base de datos para que se haga la correcta modificacion de fecha 
            if($model->estatus == 1){
                $model->fechaSolucion = $fech->format("Y-m-d H:i");
                
            }
            $stmt->bindValue(7,$model->fechaSolucion);
            //Necesito verificar bien para que se boore en caso que se cambie el estatus del riesgo 
            $stmt->bindValue(8,$model->solucion);
            
            $stmt->bindValue(9, $model->id);
            

            $stmt->execute();
        } catch (\Throwable $th) {
            return false;
        }
       return true; 
    }
}