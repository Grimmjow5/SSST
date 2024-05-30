<?php

namespace Almacen\Ssst\utils;

class FormatExtPDF {

    public function HtmlContent(array $datos, string $title): string {
        // Config para logo
        $path = __DIR__ . "/../img/logo.png";
        $strinImg = file_get_contents($path);
        $base64 = "data:image/png;base64," . base64_encode($strinImg);
        $datoss = $this->AddRow($datos);

        $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
@font-face {
    font-family: 'Futura';
    font-style: normal;
    font-weight: normal;
    src: url("./futur.ttf") format('truetype');
}
@page {
    margin-left: 1rem;
    margin-top: 2rem;
    margin-right: 1rem;
}
body {
    font-family: Arial, sans-serif;
}
.header {
    width: 100%;
    border: 1px solid black;
    position: relative;
    padding-top: -10px;
    margin: 0;
    float: left;
}
.logo {
    display: block;
    width: 20%;
    border-right: 1px solid black;
    page-break-inside: avoid;
}
.title {
    display: block;
    float: left;
    margin-top: -4.5rem;
    font-size: 13px;
    margin-left: 20%;
    padding-left: 12px;
    width: 80%;
    text-align: center;
}
.img {
    width: 60px;
    padding-top: 2rem;
    margin-left: 1rem;
}
h1 {
    color: #9f2141;
    position: absolute;
}
.titleTable {
    text-align: center;
    border: 1px solid black;
    position: relative;
    margin-top: 6rem;
}
table {
    width: 100%;
    border-width: thin;
    border-spacing: 5px;
    border-style: none;
    border-color: white;
    border-collapse: collapse;
    background-color: transparent;
}
thead th {
    font-size: 14px;
    font-weight: bold;
}
th, td {
    font-size: 14px;
    font-weight: normal;
    border-width: 1px;
    padding: 0rem;
    border-style: solid;
    border-color: black;
    background-color: #e3e3e310;
    text-align: center; /* Center horizontally */
    vertical-align: middle; /* Center vertically */
}
</style>
</head>
<body>
    <div class="header">
        <!-- Header de Reporte -->
        <div class="logo">
            <img src="{$base64}" class="img">
            <h1>DIF</h1>
        </div>
        <div class="title">
            <h2>REPORTE DE EXTINTORES</h2>
        </div>
    </div>
    <!-- Header de table -->
    <div class="titleTable">
        <h4>$title</h4>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Fecha de Registro</th>
                <th>Lugar Designado</th>
                <th>Acceso Obstruido</th>
                <th>Señalamiento Obstruido</th>
                <th>Instrucciones Legibles</th>
                <th>Sellos en Condiciones</th>
                <th>Rango Operable</th>
                <th>Daño Físico</th>
                <th>Accesorios en Buen Estado</th>
                <th>Altura, Peso</th>
                <th>Fecha Ult Recarga, Fecha Próx Recarga</th>
            </tr>
        </thead>
        <tbody>
            $datoss
        </tbody>
    </table>
</body>
</html>
HTML;

        return $html;
    }

    private function AddRow(array $datos): string {
        $rows = "";
        foreach ($datos as $key) {
            $rows .= "<tr>
                <th>{$key['id']}</th>
                <th>{$this->dateFormat($key['fecha_reg'])}</th>
                <th>{$this->textFormat($key['lugar_designado'])}</th>
                <th>{$this->textFormat1($key['acceso'])}</th>
                <th>{$this->textFormat2($key['senial'])}</th>
                <th>{$this->textFormat3($key['instrucciones'])}</th>
                <th>{$this->textFormat4($key['sellos'])}</th>
                <th>{$this->textFormat5($key['lecturas'])}</th>
                <th>{$this->textFormat6($key['danio'])}</th>
                <th>{$this->textFormat7($key['manijas'])}</th>
                <th>{$key['altura']} <br> {$key['peso']}</th>
                <th>{$this->dateFormat($key['fecha_recarga'])} <br> {$this->dateFormat($key['fecha_prox_recarga'])}</th>
            </tr>";
        }
        return $rows;
    }
    public function textFormat (int $lugarD):string{
        return $lugarD == 0 ?"No":"Si";
    }
    public function textFormat1 (int $acceso):string{
        return $acceso == 0 ?"No":"Si";
    }
    public function textFormat2 (int $senial):string{
        return $senial == 0 ?"No":"Si";
    }
    public function textFormat3 (int $instr):string{
        return $instr == 0 ?"No":"Si";
    }
    public function textFormat4 (int $sellos):string{
        return $sellos == 0 ?"No":"Si";
    }
    public function textFormat5 (int $lecturas):string{
        return $lecturas == 0 ?"No":"Si";
    }
    public function textFormat6 (int $dano):string{
        return $dano == 0 ?"No":"Si";
    }
    public function textFormat7 (int $manijas):string{
        return $manijas == 0 ?"No":"Si";
    }

    public function dateFormat($fecha) {
        if (!empty($fecha)) {
            $jj = strtotime($fecha);
            return date("d-m-Y", $jj);
        }
        return " ";
    }
}
?>
