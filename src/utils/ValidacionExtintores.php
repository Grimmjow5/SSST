<?php
namespace Almacen\Ssst\utils;

use Almacen\Ssst\dbrepo\models\MExtintores;
use Exception;

class ValidacionExtintores extends MExtintores {
    
    public function __construct() {
        // No necesitas un constructor vacío si no haces nada en él
    }

    public function validate($request): MExtintores {
        if (isset($request['delete']) && $request['delete'] == true) {
            // No hacer ninguna validación si es una solicitud de eliminación
            return new MExtintores(); // Devolver un objeto vacío o mínimo necesario para el delete
      }

        // Validación para otros casos (no es eliminación)
        if (empty($request['subarea']) || $request['subarea'] == 0) {
            throw new Exception("Error de Subarea, selecciona una");
        }
        $this->idSubArea = $request['subarea'];

        if (empty($request['extintor']) || $request['extintor'] == 0) {
            throw new Exception("Error de extintor, selecciona uno");
        }
        $this->idExtintor = $request['extintor'];

        // Validación de preguntas
        for ($i = 1; $i <= 8; $i++) {
            $pregunta = 'pregunta' . $i;
            if (empty($request[$pregunta]) && $request[$pregunta] !== '0') {
                throw new Exception("Contesta la pregunta $i");
            }
        }
        $this->lugarDesigando = $request['pregunta1'];
        $this->accesoM = $request['pregunta2'];
        $this->senalM = $request['pregunta3'];
        $this->instrucionM = $request['pregunta4'];
        $this->manijasM = $request['pregunta5'];
        $this->selloM = $request['pregunta6'];
        $this->lecturaM = $request['pregunta7'];
        $this->danoM = $request['pregunta8'];

        // Validación de otros campos
        if (empty($request['txtPeso'])) {
            throw new Exception("Ingresa el peso del extintor");
        }
        $this->pesoM = $request['txtPeso'];

        if (empty($request['txtAltura'])) {
            throw new Exception("Ingresa la altura");
        }
        $this->alturaM = $request['txtAltura'];

        if (empty($request['fechaUltRec'])) {
            throw new Exception("Ingresa la fecha de ultima recarga");
        }
        $this->fecha_UrecargaM = $request['fechaUltRec'];

        if (empty($request['fechaProxRec'])) {
            throw new Exception("Ingresa la fecha de la proxima recarga");
        }
        $this->fecha_PrecargaM = $request['fechaProxRec'];

        return $this; // Devuelve el objeto ValidacionExtintores configurado con los datos validados
    }
}
?>
