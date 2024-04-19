<?php

namespace Almacen\Ssst\routes;
use Flight;
use Almacen\Ssst\controllers\Login;

use Almacen\Ssst\controllers\ReportsController;

use Almacen\Ssst\controllers\RiesgosController;



class Riesgos extends Flight{

    private $login;
    function __construct()
    {
        $this->login = new Login();
        parent::route('GET /',[$this->login,'login']);    
        parent::route('POST /log',[$this->login,'setlogin'] );
        parent::route('GET /home',[$this->login,'RenderHome']);
    
        //Vista de riesgo
        $riesgos = new RiesgosController();
        //En esta ruta solo envia la vista al navegador para que el usuario ingrese los riesgos y muestre los ingresados 
        parent::route('GET /riesgos',[$riesgos,'index']);
        //Insert y Put de riesgos, recibe el modelo
        parent::route('POST /riesgos',[$riesgos,'postRiesgo']);
        //Lista de riesgos para la tabla donde se generan los reportes
        parent::route('GET /cat_riesgos',[$riesgos,'getRiesgos']);


        $report = new ReportsController();
    //Vista en la que se mostrara el lformulario para genera los reportes de riesgos 
       parent::route('GET /riesgos/report',[$report,'index']);   
       parent::route('GET /riesgos/reports',[$report,'GetReports']);
       parent::route('GET /rr',[$report,'GenerateExcel']);
       parent::route('GET /PDF',[$report,'GeneratePDF']);


    }
}