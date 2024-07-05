<?php

namespace Almacen\Ssst\controllers;
use Almacen\Ssst\dbrepo\Factory;
use Almacen\Ssst\dbrepo\GetReports;
use Almacen\Ssst\dbrepo\models\MReportRiesgo;
use Almacen\Ssst\dbrepo\RepoMain;
use Almacen\Ssst\utils\FormatPDF;
use DateTime;
use Exception;
use Flight;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportsController extends Flight {

    private Factory $factory;
    private MReportRiesgo $modelRiesgo;
    private Options $opt;
    private FormatPDF $pdf;
    public function __construct()
    {
        $this->pdf = new FormatPDF();   
        $this->modelRiesgo = new MReportRiesgo();
        $this->factory = new Factory();
        $this->factory->getCatalogos(new RepoMain());
        $this->factory->getReportes(new GetReports());
    }
    public function index (){
        $this->checkAdmin();
        $this->factory->getCat->rowVal  = ["estatus"=>array(1)];
        $this->factory->getCat->table = 'cat_sub_areas';
        $this->factory->getCat->logic = "and";
        $subAreas = $this->factory->getCat->getAll();

        parent::render('Reports/index',['subarea'=>$subAreas]);
    }

    private function checkAdmin()
    {
        if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 1) {
            parent::halt(403, "Acceso denegado: Solo puede acceder personal autorizado .");
        }
    }
    private function ValidateRequest($request) :MReportRiesgo {
    
            $this->modelRiesgo->fechaMin = trim($request['fechaReport']);
            $this->modelRiesgo->fechaMax = trim($request['fechaMaxReport']);
            $this->modelRiesgo->subarea = trim($request['subarea']);
            $this->modelRiesgo->estatus = trim($request['estatus']);
            $this->modelRiesgo->fechaMinSolucion =trim($request['fechaMinSolucion']);
            $this->modelRiesgo->fechaMaxSolucion = trim($request['fechaMaxSolucion']);
        return $this->modelRiesgo;   
    }
    public function GetReports() {
      
         try{
           $this->ValidateRequest($_REQUEST);
            $report = $this->factory->reportes->GetReports($this->modelRiesgo);          
            parent::json(['data'=>$report]);
        
        }catch(Exception $ex){
            parent::json(['msg'=>$ex->getMessage()],400);
        } 
    }

    public function GeneratePDF() {
        $this->opt  = new Options();
        $this->opt->set('isHtml5ParserEnabled', true);
        $this->opt->set('enable_remote',true);
        $pdf = new Dompdf($this->opt);

        $pdf->setPaper('A4','landscape');

           $this->ValidateRequest($_REQUEST);
            $report = $this->factory->reportes->GetReports($this->modelRiesgo);        
           $title = $_REQUEST["title"];
        $pdf->loadHtml($this->pdf->HtmlContent($report,$title),'UTF-8');
        $pdf->render();

       $pdf->stream('decha.pdf',array("Attachment"=> false));


    }
    public function GenerateExcel(){
        $spreadSheet = new Spreadsheet();

        $headExcel = ['No','Fecha reportado','Descripción','Prioridad','Fecha de Solución','Descripcion de Solucion'];
        $this->ValidateRequest($_REQUEST);
        $report = $this->factory->reportes->GetReports($this->modelRiesgo);
      
        //Insert por foreach
        $spreadSheet->getActiveSheet()->fromArray($headExcel,null,'A1');
        $spreadSheet->getActiveSheet()->fromArray($this->FormatDataExcel($report),null,'A2');
        
        //Header de tabla style
        $spreadSheet->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
        //Parte de la configuracion de para alinear el texto
        $spreadSheet->getActiveSheet()->getStyle('C2')->getAlignment()->setWrapText(true);
        //Redimencion de la celda 
        $spreadSheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        
        $spreadSheet->getActiveSheet()->getStyle('F2')->getAlignment()->setWrapText(true);
        //Redimencion de la celda 
        $spreadSheet->getActiveSheet()->getColumnDimension('F')->setWidth(80);



        //Fecha para dar  nombre al archivo
            $date =new   DateTime();
            $hoy = $date->format('d-m-Y');
        //Configuration for save xlsx in PC
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=ReporteGenerado{$hoy}.xlsx");
        header('Cache-Control: max-age=0');
        
        $write =  \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadSheet,'Xlsx');
        $write->save('php://output');

    }
    private function FormatDataExcel(array $datos):array{
         $newArray = array();
        foreach ($datos as $key) {
           array_push($newArray,
                                [
                                    $key['id'],
                                    $this->pdf->dateFormat($key['fechaRegistro']),
                                    $key['text_Riesgo'],
                                    $key['prioridad'],
                                    $this->pdf->dateFormat($key['fecha_solucion']),
                                    $key['solucion']]);
        }
        return $newArray;
    }
}