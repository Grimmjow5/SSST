<?php

namespace Almacen\Ssst\routes;


use Flight;
use Almacen\Ssst\controllers\Login;
use Almacen\Ssst\controllers\ReportExtController;
use Almacen\Ssst\controllers\ExtintorController;



class Extintores extends Flight{

    private $login;
    function __construct()
    {
        $this->login = new Login();
        parent::route('GET /',[$this->login,'login']);    
        parent::route('POST /log',[$this->login,'setlogin'] );
        parent::route('GET /home',[$this->login,'RenderHome']);

       //vista Extintores 
       $extintores = new ExtintorController();
       parent::route('GET /Extintores',[$extintores,'index']);

       parent::route('POST /Extintores',[$extintores,'postExtintores']);
       
       parent::route('GET /repo_ext',[$extintores,'getExtintores']);
       
       parent::route('DELETE /reg_extintores',[$extintores,'deleteExtintores']);

        //Reportes
       $reportE = new ReportExtController();
       //Vista en la que se mostrara el lformulario para genera los reportes de riesgos 
       parent::route('GET /ReportExt',[$reportE,'index']); 

       parent::route('GET /Extintores/reports',[$reportE,'GetReportsExt']);

       parent::route('GET /EXCELex',[$reportE,'GenerateExtExcel']);

       parent::route('GET /PDFex',[$reportE,'GenerateExtPDF']);
     
       

    }
}