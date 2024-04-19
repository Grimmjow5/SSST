<?php

namespace Almacen\Ssst\controllers;
use Almacen\Ssst\dbrepo\Factory;
use Almacen\Ssst\dbrepo\GetReports;
use Almacen\Ssst\dbrepo\models\MReportRiesgo;
use Almacen\Ssst\dbrepo\RepoMain;
use DateTime;
use Exception;
use Flight;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Dompdf\Dompdf;

class ReportsController extends Flight {

    private Factory $factory;
    private MReportRiesgo $modelRiesgo;
    public function __construct()
    {
        
        $this->modelRiesgo = new MReportRiesgo();
        $this->factory = new Factory();
       $this->factory->getCatalogos(new RepoMain());
       $this->factory->getReportes(new GetReports());
    }
    public function index (){
        $this->factory->getCat->rowVal  = ["estatus"=>array(1)];
        $this->factory->getCat->table = 'cat_areas';
        $this->factory->getCat->logic = "and";
        $areas = $this->factory->getCat->getAll();

        parent::render('Reports/index',['areas'=>$areas]);
    }
    public function GetReports() {
      
         try{
            $this->modelRiesgo->fechaMin = trim($_REQUEST['fechaReport']);
            $this->modelRiesgo->fechaMax = trim($_REQUEST['fechaMaxReport']);
            $this->modelRiesgo->area = trim($_REQUEST['area']);
            $this->modelRiesgo->estatus = trim($_REQUEST['estatus']);
            $this->modelRiesgo->fechaMinSolucion =trim($_REQUEST['fechaMinSolucion']);
            $this->modelRiesgo->fechaMaxSolucion = trim($_REQUEST['fechaMaxSolucion']);
            $report = $this->factory->reportes->GetReports($this->modelRiesgo);
            parent::json(['data'=>$report]);
        
        }catch(Exception $ex){
            parent::json(['msg'=>$ex->getMessage()],400);
        } 
    }

    public function GeneratePDF() {
      $pdf = new Dompdf();
        $pdf->setPaper('A4','landscape');
        $html =  <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet" />
<style>

body {
    font-family: 'Montserrat';
}


</style>
</head>
<body>
    <div style="border:1p solid red;">
        <div style="border:1p solid green;width:100px;">
            <h2>jj</h2>
        </div>
        <div style="border:1p solid blue; width:200px;">
            <p class="h1">2</p>
        </div>
    </div>
   
</body>
</html>
HTML
        ;
        $pdf->loadHtml($html);
        $pdf->render();

        $pdf->stream('decha.pdf',array("Attachment"=> false));


    }
    public function GenerateExcel(){
       
        //$dir = __DIR__."\Repoddr.xlsx";
         
        $spreadSheet = new Spreadsheet();
      
        
        $set = ['val1','val2','val3'];
        $sett = [['val1','val2','val3','vsdlkjflskdjhflsjkhdflkjhsdlkjfhsldkj   fhslkjdhfskljdflksjhdfskhjalksaljdñljkashldkjah lskjdhalskhjdlakjsdhlaksjhdlakjsdhlakjsdhlakjshdlakjshld kjashlkdhalksjdhljk1','val2','val3'],['val1','val2','val3']];
        //Insert por foreach
        $spreadSheet->getActiveSheet()->fromArray($set,null,'A1');
        $spreadSheet->getActiveSheet()->fromArray($sett,null,'A2');
        
        //Header de tabla style
        $spreadSheet->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        //Parte de la configuracion de para alinear el texto
        $spreadSheet->getActiveSheet()->getStyle('D2')->getAlignment()->setWrapText(true);
        //Redimencion de la celda 
        $spreadSheet->getActiveSheet()->getColumnDimension('D')->setWidth(80);


        //Fecha para dar  nombre al archivo
            $date =new   DateTime();
            $hoy = $date->format('d-m-Y');
        //Configuration for save xlsx in PC
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=ReporteGenerado{$hoy}.xlsx");
        header('Cache-Control: max-age=0');
        
        $write =  \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadSheet,'Xlsx');
        $write->save('php://output');


        //parent::json(['msg'=>"MEnsajes"]);
    }
}