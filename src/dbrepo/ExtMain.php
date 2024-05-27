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
    public function set_modelEx(MExtintores $extintores):bool{
            try{
                $sql ="INSERT INTO
                    `reg_extintores` (`id`, `id_extintor`, `id_area`, `id_direccion`, `id_mes_captura`, `lugar_designado`, `acceso`, `senial`, `instrucciones`, `sellos`,`lecturas`, `danio` ,`altura`, `manijas`, `peso`, `fecha_recarga`, `fecha_prox_recarga`, `fecha_reg`, `resp_reg`,`fecha_modificacion`, `resp_modificacion`, `estatus`)
                        VALUES       ( NULL,      NULL,         ?,           NULL,            ?,                b?,            b?,       b?,         b?,            b?,       b?,       b?,       ?,        b?,       ?,          ?,                 ?,                 ?,         ?,             NULL,                  NULL,           b?   )";
                $dateNow = new DateTime();

                $stmt = parent::prepare($sql);
                
                //$stmt->bindValue(1,$extintores->idExtintor);
                $stmt->bindValue(1,$extintores->idArea);
                $extintores->idMes = $dateNow->format("m");
                $stmt->bindValue(2,$extintores->idMes); 

                $stmt->bindValue(3, $extintores->lugarDesigando); 
                $stmt->bindValue(4, $extintores->accesoM);
                $stmt->bindValue(5,$extintores->senalM);
                $stmt->bindValue(6, $extintores->instrucionM); 
                $stmt->bindValue(7,$extintores->selloM); 
                $stmt->bindValue(8, $extintores->lecturaM); 
                $stmt->bindValue(9,$extintores->danoM);
                $stmt->bindValue(10,$extintores->alturaM); 
                $stmt->bindValue(11, $extintores->manijasM); 
                $stmt->bindValue(12,$extintores->pesoM);
                $stmt->bindValue(13,$extintores->fecha_UrecargaM); 
                $stmt->bindValue(14,$extintores->fecha_PrecargaM);

                $extintores->fechaRegistro = $dateNow->format("Y-m-d H:i");
                $stmt->bindValue(15,$extintores->fechaRegistro); 

                $extintores->idRegUser = $_SESSION["id_usuario"];
                $stmt->bindValue(16,$extintores->idRegUser); 

                $stmt->bindValue(17,$extintores->estatus);

                
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