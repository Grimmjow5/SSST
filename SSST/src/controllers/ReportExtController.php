<?php 

namespace Almacen\Ssst\controllers;
use Almacen\Ssst\dbrepo\Factory;
use Almacen\Ssst\dbrepo\GetReportsExt;
use Almacen\Ssst\dbrepo\models\MReportExt;
use Almacen\Ssst\dbrepo\ExtMain;
use Almacen\Ssst\utils\FormatExtPDF;
use DateTime;
use Exception;
use Flight;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportExtController extends Flight {

    private Factory $factory;
    private MReportExt $modelExtintor;
    private Options $opt;
    private FormatExtPDF $pdf;
    public function __construct()
    {
        $this->pdf = new FormatExtPDF();   
        $this->modelExtintor = new MReportExt();
        $this->factory = new Factory();
        $this->factory->getCatalogosEx(new ExtMain());
        $this->factory->getReportesExt(new GetReportsExt());
    }
      private function checkAdmin() {
        if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 1) {
            parent::halt(403, "Acceso denegado: Solo puede acceder personal autorizado .");
        }
    }

    public function index (){
          $this->checkAdmin();
        $this->factory->getCatEx->table = 'cat_areas';
        $this->factory->getCatEx->logic = "and";
        $areas = $this->factory->getCatEx->getAll();

        parent::render('ReportExt/index',['areas'=>$areas]);
    }
    private function ValidateRequest($request) :MReportExt {
            $this->modelExtintor->fecha = trim($request['fecha']);
            $this->modelExtintor->area = trim($request['area']);
        return $this->modelExtintor;   
    }
    public function GetReportsExt() {
        $this->checkAdmin();
         try{
           $this->ValidateRequest($_REQUEST);
            $reportE = $this->factory->reportesExt->GetReportsExt($this->modelExtintor);          
            parent::json(['data'=>$reportE]);
        
        }catch(Exception $ex){
            parent::json(['msg'=>$ex->getMessage()],400);
        } 
    }

    public function GenerateExtPDF() {

        $this->opt  = new Options();
        $this->opt->set('isHtml5ParserEnabled', true);
        $this->opt->set('enable_remote',true);
        $pdf = new Dompdf($this->opt);

        $pdf->setPaper('A4','landscape');

           $this->ValidateRequest($_REQUEST);
            $reportE = $this->factory->reportesExt->GetReportsExt($this->modelExtintor);        
            $title = $_REQUEST["title"];
            $pdf->loadHtml($this->pdf->HtmlContent($reportE,$title),'UTF-8');
            $pdf->render();

            $pdf->stream('decha.pdf',array("Attachment"=> false));


    }
    public function GenerateExtExcel(){
        $spreadSheet = new Spreadsheet();

        $headExcel = ['No','Fecha de Registro','Lugar designado','Acceso obstruido','Señalamiento Obstruido','Instrucciones Legibles','Sellos en condiciones','Rango Operable','Daño Fisico','Accesorios en buen estado','Altura','Peso','Fecha Ultima Recarga','Fecha Proxima Recarga'];
        $this->ValidateRequest($_REQUEST);
        $reportE = $this->factory->reportesExt->GetReportsExt($this->modelExtintor);
      
        //Insert por foreach
        $spreadSheet->getActiveSheet()->fromArray($headExcel,null,'A1');
        $spreadSheet->getActiveSheet()->fromArray($this->FormatDataExcel($reportE),null,'A2');
        
        //Header de tabla style
        $spreadSheet->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
        //Parte de la configuracion de para alinear el texto
        $spreadSheet->getActiveSheet()->getStyle('C2')->getAlignment()->setWrapText(true);
        //Redimencion de la celda 
        $spreadSheet->getActiveSheet()->getColumnDimension('C')->setWidth(80);
        
        $spreadSheet->getActiveSheet()->getStyle('F2')->getAlignment()->setWrapText(true);
        //Redimencion de la celda 
        $spreadSheet->getActiveSheet()->getColumnDimension('F')->setWidth(80);



        //Fecha para dar  nombre al archivo
            $date = new   DateTime();
            $hoy = $date->format('d-m-Y');
        //Configuration for save xlsx in PC
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=ReporteGenerado{$hoy}.xlsx");
        header('Cache-Control: max-age=0');
        
        $write =  \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadSheet,'Xlsx');
        $write->save('php://output');


        //parent::json(['msg'=>"MEnsajes"]);
    }
    private function FormatDataExcel(array $datos):array{
         $newArray = array();
        foreach ($datos as $key) {
           array_push($newArray,
                                [
                                    $key['id'],
                                    $this->pdf->dateFormat($key['fecha_reg']),
                                    $this->formatBitField($key['lugar_designado']),
                                    $this->formatBitField($key['acceso']),
                                    $this->formatBitField($key['senial']),
                                    $this->formatBitField($key['instrucciones']),
                                    $this->formatBitField($key['sellos']),
                                    $this->formatBitField($key['lecturas']),
                                    $this->formatBitField($key['danio']),
                                    $this->formatBitField($key['manijas']),
                                    $key['altura'],
                                    $key['peso'],
                                    $key['fecha_recarga'],
                                    $key['fecha_prox_recarga']
                                ]);
        }
        
        return $newArray;
    }

    private function formatBitField($value) {
        return $value ? 'Sí' : 'No';
    }

    public function dateFormat($fecha) {
        if (!empty($fecha)) {
            $jj = strtotime($fecha);
            return date("d-m-Y", $jj);
        }
        return " ";
    }
}