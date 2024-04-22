<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';

?>

<div  class="d-flex flex-column p-2 w-100">

<div class=" bg-light shadow-lg rounded p-4">
    <h4>Forma para genera Excel o PDF </h4>
    <small>Preguntar si tambien sera requerido tomar en cuanta solo si esta solucionado</small>
        <form id="report"  class="row mt-4">
            <div class="col-12 col-md-6">                
                <label  class="form-label" >Fecha  Minima de  Reporte</label>
                <input type="date" class="form-control" 
                    id="fechaMinReport" >
                    <small class="ms-5">* Es la fecha como minimo en la que se levanto el reporte </small>
            </div>
            <div class="col-12 col-md-6 content-fluid">
                <label for="" class="form-label">Fecha Máxima de Reporte </label>
                <input type="date" class="form-control" id="fechaMaxReport">
                    <small class="ms-5">* Es la fecha como máximo en la que se levanto el reporte </small>
               <!--  <div class="form-check form-switch">
                   <input class="form-check-input" type="checkbox" role="switch" id="conSolucion">
                    <label class="form-check-label" for="conSolucion">¿Filtrar con fecha de solución?</label>
                </div> -->
            </div>

            <div class="col-12 col-md-6 mt-1">
                <label for="" class="form-label" >Área</label>
                <select name="" id="area"class="form-control">
                    <option value="0" >Todas las Áreas</option>
                     <?php
          $opt = "";
          foreach ($areas as $item) {
            $opt .= "<option value='{$item["id_area"]}'>{$item["textArea"]}</option>";
          }
          echo $opt;
          ?>
                </select>
            </div>

            <div class="col-12 col-md-6">
                <label for="" class="form-label">Estatus</label>
                <select  id="estatus" class="form-control">
                    <option selected  value="all">Reportado y Solucionado</option>
                    <option value="0">Reportado</option>
                    <option value="1">Solucionado</option>
                </select>
            </div>
            <div class="col-12 col-md-6 mt-2">
                <label for="" class="form-label">Fecha Minima de Solución</label>
                <input type="date" id="fechaMinSolucion" class="form-control">                
            </div>
            <div class="col-12 col-md-6 mt-2">
                <label for="" class="form-label">Fecha Maxima de Solución</label>
                <input type="date" name="" id="fechaMaxSolucion" class="form-control">
            </div>
            <div class="d-flex justify-content-evenly">
                <button class="btn btn-primary mt-4 d-flex align-items-center" type="submit">
                    <i class="bi bi-table h4 me-2"></i>
                    <h4>Generar Reporte </h4>
                </button>
         <!--    <button type="submit" class="btn btn-success mt-4">
              <i class="bi bi-file-earmark-spreadsheet h4"></i>
                Excel
            </button>
            
            <button type="submit" class="btn btn-danger mt-4">
                <i class="bi bi-file-earmark-pdf h4"></i>    
            PDF</button>  -->
            </div>
            <small>La generacion de todos estos reportes seran en base a la fecha que se reporto el insidente</small>
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
            <th>No. Id</th>
            <th class="w-25">Descripción</th>
            <th>Fecha de Resgistro</th>
            <th>Prioridad</th>
            <th>Estatus</th>
            <th>Solución</th>
          </tr>
        </thead>
        <tfoot>
           <tr>    
            <th>No. Id</th>
            <th>Descripción</th>
            <th>Fecha de Resgistro</th>
            <th>Prioridad</th>
            <th>Estatus</th>
            <th>Solución</th>
          </tr>
        </tfoot>
      </table>

</div>
</div>
<!--Div parte del body-->
</div>
<?php require 'public/views/components/Footer.php'; ?>
<script src="../public/views/Reports/reports.js"></script>