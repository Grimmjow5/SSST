<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';

?>

<div  class="d-flex flex-column p-2 w-100">

<div class=" bg-light shadow-lg rounded p-4">
    <h4>Forma para genera Excel o PDF </h4>
        <form id="report"  class="row mt-4">
            <div class="col-12 col-md-12">
                <label for="" class="form-label" >Subarea</label>
                <select name="" id="subarea"class="form-control">
                    <option value="0" >Todas las Subreas</option>
                        <?php
                            $opt = "";
                            foreach ($subarea as $item) {
                              $opt .= "<option value='{$item["id_subarea"]}'>{$item["textArea"]}</option>";
                            }
                            echo $opt;
                        ?>
                </select>
            </div>

            <div class="col-6 col-md-6 mt-2">                
                <label  class="form-label" >Fecha Minima de los Registros</label>
                <input type="date" class="form-control" 
                    id="fecha" >
                    <small class="ms-5">* Es la fecha como minima en la que se levanto el reporte </small>
            </div> 

            <div class="col-6 col-md-6 mt-2">
                <label for="" class="form-label">Fecha Máxima de los Reportes </label>
                <input type="date" class="form-control" 
                    id="fechaMaxReport">
                    <small class="ms-5">* Es la fecha como máximo en la que se levanto el reporte </small>
            </div>


            <div class="d-flex justify-content-evenly">
                <button class="btn btn-primary mt-4 d-flex align-items-center" type="submit">
                    <i class="bi bi-table h4 me-2"></i>
                    <h4>Generar Reporte </h4>
                </button>
            </div>
            <small>La generacion de todos estos reportes seran en base a la fecha y subarea</small>
        </form>

</div>
<div class="w-100 col-12 bg-light rounded mt-4 p-4">
    <button type="button" id="generatePDF"class="btn btn-danger mt-4">
        <i class="bi bi-file-earmark-pdf h4"></i>    PDF
    </button>
    <button type="submit" class="btn btn-success mt-4" id="generateExcel">
        <i class="bi bi-file-earmark-spreadsheet h4"></i> Excel
    </button>


<h5 id="textTitle" ></h5>
<!--Tabla que mostrara los datos a exportar -->
<table id="tableReport" class="display w-100" >
        <thead>
          <tr>    
            <th>No</th>
            <th>Fecha Reg</th>
            <th>Lugar Des</th>
            <th>Accs Obst</th>
            <th>Señal Obst</th>
            <th>Inst Leg</th>
            <th>Sellos</th>
            <th>Rango Oper</th>
            <th>Daño F</th>
            <th>Acces</th>
            <th>Altura</th>
            <th>Peso</th>
            <th>Fech Ult Rec</th>
            <th>Fech Prox Rec</th>
          </tr>
        </thead>
      </table>

</div>
</div>
<!--Div parte del body-->
</div>
<?php require 'public/views/components/Footer.php'; ?>
<script src="../public/views/ReportExt/reports.js"></script>