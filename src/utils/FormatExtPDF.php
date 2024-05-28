<?php

namespace Almacen\Ssst\utils;

class FormatExtPDF{

 public function HtmlContent(array  $datos, string $title):string  {

      //Config para logo
    $path = __DIR__."\..\img\logo.png";
    $strinImg = file_get_contents($path);
    $base64 = "data:image/png;base64,".base64_encode($strinImg);
    $datoss = $this->AddRow($datos);

            $html =  <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>

@font-face {
    font-family: 'Futura';
    font-style:normal;
    font-weight:normal;
src: url("./futur.ttf") format('truetype');
}
@page{
    margin-left:1rem;
    margin-top:2rem;
    margin-right:1rem;
}
body {
 font-family: Arial, sans-serif;    

}
.header{
    width:100%;
    border:1px solid black;
    position: relative;
    padding-top:-10px;
    margin:0;
float:left;

}
.logo{
    display: block;
        width: 20%;
    border-right:1px solid black;
        top:40;
 
        page-break-inside: avoid;

}
.title{
  display: block;
    float:left;
    margin-top:-4.5rem;
    font-size: 13px;
    margin-left: 20%;
    padding-left: 12px;
    width: 80%;
    text-align:center;
}

.img{
    width:60px;
    padding-top:2rem;
    margin-left:1rem;
}
h1{
    color:#9f2141;
    position:absolute;
}
.titleTable{
    text-align:center;
    border:1px solid black;
    position: relative;
    margin-top:6rem;
}

table{
    width:100%;
  	border-width: thin;
	border-spacing: 5px;
	border-style: none;
	border-color: white;
	border-collapse: collapse;
	background-color: transparent;  
}
thead th{
    font-size:14px;
    font-weight:bold;
}

th{
    font-size:14px;
    font-weight:normal;
    border-width: 1px;
	padding: 1rem;
	border-style: solid;
	border-color: black;

	background-color: #e3e3e310;
}

</style>
</head>
<body>
    <div class="header" >
<!--header de Reporte -->
        <div  class="logo">
            <img src="{$base64}" class="img">
            <h1>DIF</h1>
        </div>
        
        <div  class="title">
            <h2>REPORTE DE EXTINTORES</h2>
        </div>
    </div>
   <!--Header de table -->
   <div class="titleTable">
            <h4>$title</h4>
   </div>
   <table>
    <thead>
        <tr>
            <!--No','Fecha de Registro','Lugar designado','Acceso obstruido','Señalamiento Obstruido','Instrucciones Legibles','Sellos en condiciones','Rango Operable','Daño Fisico','Accesorios en buen estado','Altura','Peso','Fecha Ultima Recarga','Fecha Proxima Recarga','Estatus-->
            <th>No</th>
            <th>Fecha de Registro</th>
            <th>Lugar Desigando</th>
            <th>Acceso obstruido</th>
            <th>Señalamiento Obstruido</th>
            <th>Instrucciones Legibles</th>
            <th>Sellos en condiciones</th>
            <th>Rango Operable</th>
            <th>Daño Fisico</th>
            <th>Accesorios en buen estado</th>
            <th>Altura</th>
            <th>Peso</th>
            <th>Fecha Ultima Recarga</th>
            <th>Fecha Proxima Recarga</th>
            <th>Estatus</th>
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
private function AddRow(array $datos) :string{
    $rows = ""; 
    foreach ($datos as $key ) {
    
       $rows .= " <tr>
            <th>{$key['id']}</th>
            <th>{$this->dateFormat($key['fecha_reg'])}</th>
            <th>{$key['lugar_designado']}</th>
            <th>{$key['acceso']}</th>
            <th>{$key['senial']}</th>
            <th>{$key['instruciones']}</th>
            <th{$key['sellos']}</th>
            <th>{$key['lecturas']}</th>
            <th>{$key['danio']}</th>
            <th>{$key['manijas']}</th>
            <th>{$key['altura']}</th>
            <th>{$key['peso']}</th>
            <th>{key['fecha_recarga']}</th>
            <th>{$key['fecha_prox_recarga']}</th>
            <th>{$key['prioridad']}</th>
            <th>{$this->textFormat($key['estatus'])} </th>
        </tr>";
    }
    return $rows;
}
public function textFormat (int $status):string{
    return $status == 0 ?"Reportado":"Solucionado";
}
public function dateFormat($fecha){
 if(!empty($fecha)){
    $jj = strtotime($fecha);
 return   date("d-m-Y",$jj);
 }
 return " ";
 
}

}