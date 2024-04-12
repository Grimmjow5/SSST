<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';

?>

<div  class="d-flex flex-column p-2 w-100">

<div class=" bg-light shadow-lg rounded p-4">
    <h4>Forma para genera Excel o PDF </h4>
        <form id="report"  class="row mt-4">
            <div class="col-12 col-md-6">                
                <label  class="form-label" >Fecha de Reporte</label>
                <input type="date" class="form-control" 
                    id="fechaReport" >
            </div>
            <div class="col-12 col-md-6 content-fluid">
                <label for="" class="form-label">Fecha de solución</label>
                <input type="date" class="form-control" id="fechaSolucion" disabled>
                <div class="form-check form-switch">
                   <input class="form-check-input" type="checkbox" role="switch" id="conSolucion">
                    <label class="form-check-label" for="conSolucion">¿Filtrar con fecha de solución?</label>
                </div>
            </div>

            <div class="col-12 col-md-6 mt-1">
                <label for="" class="form-label" >Área</label>
                <select name="" id="area"class="form-control">
                    <option value="0" >Selecciona un área</option>
                     <?php
          $opt = "";
          foreach ($areas as $item) {
            $opt .= "<option value='{$item["id_area"]}'>{$item["textArea"]}</option>";
          }
          echo $opt;
          ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-4">Generar</button>
        </form>

</div>
</div>
<!--Div parte del body-->
</div>
<?php require 'public/views/components/Footer.php'; ?>
<script src="../public/views/Reports/reports.js"></script>