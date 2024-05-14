<?php

namespace Almacen\Ssst\dbrepo;

use Almacen\Ssst\dbrepo\interfaces\ICat_ConsultasM;

use Almacen\Ssst\config\ConfigDb;
use Almacen\Ssst\dbrepo\models\MRiesgos;
use Almacen\Ssst\dbrepo\models\MExtintores; 
use DateTime;
use Exception;


class ExtMain extends ConfigDb implements ICat_ConsultasM {
    
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
    public function set_modelE(MExtintores $riesgo):bool{
            try{
                $sql ="INSERT INTO
                    `reg_extintores` (`id`, `id_extintor`, `id_area`, `id_mes_captura`, `lugar_designado`, `acceso`, `senial`, `instrucciones`, `sellos`,`lecturas`, `danio` ,`altura`, `manijas`, `peso`, `fecha_recarga`, `fecha_prox_recarga`, `fecha_reg', `resp_reg','fecha_modificacio', `resp_modificacion)
                        VALUES       ( NULL,      ?,            ?,           ?,               ?,             ? ,        ?,           ?,           ?,         ?,        ?,        ?,         ?,       ?,          ?,                    ?,              ?,           ?,            NULL,                   NULL        )";
                 $dateNow = new DateTime();

                $stmt = parent::prepare($sql);
                //Preparet
                $stmt->bindValue(1,$riesgo->idExtintor);
                $stmt->bindValue(2,$riesgo->idArea);
                $riesgo->idMes = $dateNow->format("m");
                $stmt->bindValue(3,$riesgo->idMes); 
                $stmt->bindValue(4,$riesgo->lugarDesigando); 

                $stmt->bindValue(5, $riesgo->accesoM); 
                $stmt->bindValue(7,$riesgo->senalM);
                $stmt->bindValue(8, $riesgo->instrucionM); 
                $stmt->bindValue(9,$riesgo->selloM); 
                $stmt->bindValue(10, $riesgo->lecturaM); 
                $stmt->bindValue(11,$riesgo->danoM);
                $stmt->bindValue(12, $riesgo->alturaM); 
                $stmt->bindValue(14, $riesgo->manijasM); 
                $stmt->bindValue(15,$riesgo->pesoM);
                $stmt->bindValue(16,$riesgo->fecha_UrecargaM); 
                $stmt->bindValue(17,$riesgo->fecha_PrecargaM);


                $riesgo->idRegUser = $_SESSION["id_usuario"];
                $stmt->bindValue(18,$riesgo->idRegUser); 
                //Dar el valor del registro

                $riesgo->fechaRegistro = $dateNow->format("Y-m-d H:i");
                $stmt->bindValue(19,$riesgo->fechaRegistro); 
                //$stmt->bindValue(6,$riesgo->fechaModificacion); 

                $stmt->execute();
            }catch(Exception $ex){
                throw new Exception($ex);
            }
        return true;
    }
    
    //Actualizacion del modelo de riesgo
}