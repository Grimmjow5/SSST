<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';

?>
<div class="d-flex flex-column p-2 w-100" >
<div class="pt-2 mx-4 " style="background-color: #eceff4;">

<div class="w-100 bg-light shadow-lg rounded p-4 mt-3">


<div class="d-flex  justify-content-between">

  <div class="col-6">
  <h3 class="mb-6">Formulario de Reporte</h3> 
  </div>

  <div class="col-6 d-flex justify-content-end">
  <button class="btn btn-danger" onclick="clearForm()">
  <i class="bi bi-arrow-repeat"></i>
  Limpiar</button>
  </div>
</div>



<div class="card-body">
</br>
  <form  id="newExtintor"   class="row">
   
      <div class="col-md-6 col-12 mt-1">
        <label for="formGroupExampleInput" class="form-label">Area</label>

        <select class="form-select" id="area">
          <option value="0" selected>Selecciona un área</option>
          <?php
          $opt = "";
          foreach ($areas as $item) {
            $opt .= "<option value='{$item["id_area"]}'>{$item["textArea"]}</option>";
          }
          echo $opt;
          ?>
        </select>
      </div>

      

    <div class="row">
      <div class="col-md-6 col-12 mt-2">
        <div class="form-group row-6">
          <label for="exampleSelect" class="col-sm-2 form-control-label">Estatus</label>
          <div class="col-sm-12">
            <select id="estatus" id="estatus" class="form-control">
              <option value="2" selected>Seleccione el estatus</option>
              <option value="0">Reportó</option>
              <option value="1">Solucionó</option>
            </select>
          </div>
        </div>
      </div>
    

      <div class="col-md-6 col-12 mt-1" >
        <label for="formGroupExampleInput" class="form-label">Numero de Extintor</label>
        
        <select class="form-select" id="extintor">
          <option value="0" selected>Selecciona un extintor</option>
          <!--<?php
          /*$opt = "";
          foreach ($extintores as $item) {
            $opt .= "<option value='{$item["id_extintor"]}'>{$item["num_extintor"]}</option>";
          }
          echo $opt;*/
          ?>-->
        </select>
      </div> 
    </div>

    <div class="row mx-auto" style="width: 30rem; "> 
    <!-- Joshua-->
    <div class="col-12 text-center" >
      </br>
      </br>
        <label for="pregunta1" class="form-label">1.-El extintor está en el lugar designado</label>
      </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta1" id="pregunta1_si" value="1">
          <label class="form-check-label " for="pregunta1_si">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta1" id="pregunta1_no" value="0">
          <label class="form-check-label" for="pregunta1_no">No</label>
        </div>
        </br>
        
        <label for="pregunta2" class="form-label">2.-El acceso al extintor está obstruido  </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta2" id="pregunta2_si" value="1">
          <label class="form-check-label " for="pregunta2_si">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta2" id="pregunta2_no" value="0">
          <label class="form-check-label" for="pregunta2_no">No</label>
        </div>
        </br>
        <label for="pregunta3" class="form-label">3.-El señalamiento del extintor está obstruido</label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta3" id="pregunta3" value="1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta3" id="pregunta3" value="0">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta4" class="form-label">4.-Las instruciones de operación sobre la placa del extintor son legibles</label>
        </br>
        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta4" id="pregunta4" value="1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta4" id="preegunta4" value="0">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta5" class="form-label">5.-Las manijas, boquilla y manguera están en buen estado </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta5" id="pregunta5" value="1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta5" id="pregunta5" value="0">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>

        </br>
        <label for="pregunta6" class="form-label">6.-Los sellos de inviolabilidad están en buenas codiciones</labe>
        </br>
        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta6" id="pregunta6" value="1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta6" id="pregunta6" value="0">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta7" class="form-label">7.-Las lecturas del manómetro están en el rango del operable. Cuando se trate de extintores sin manómetros, se debe determinar por peso si la carga es adecuada    </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta7" id="pregunta7" value="1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta7" id="pregunta7" value="0">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta8" class="form-label">8.-Se observa cualquier envidencia de daños físico, como corrosíon, escape de presíon u obtrucción </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta8" id="pregunta8" value="1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta8" id="pregunta8" value="0">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>  
      </div>
      <!-- joshua -->
        </div>
        </br> 
        

        <div class="row">
          <div class="col-6">
            
              </br>
              <label for="formGroupExampleInput" class="form-label">Peso del extintor</label>
              <input step="any" type="number" class="form-control" id="txtPeso" placeholder="Peso">
          </div>

          <div class="col-6">
          </br>
            <label for="formGroupExampleInput" class="form-label">Altura del extintor</label>
                <input step="any" type="number" class="form-control" id="txtAltura" placeholder="Altura">
          </div>
          <div class="col-12 col-md-6">                
                <label  class="form-label" >Fecha de ultima recarga</label>
                <input type="date" class="form-control" 
                    id="fechaUltRec" >
                    <small class="ms-5">* Es la ultima fecha que se recargo el extintor</small>
          </div>
          <div class="col-12 col-md-6">                
              <label  class="form-label" >Fecha de proxima recarga</label>
              <input type="date" class="form-control" 
                  id="fechaProxRec" >
                <small class="ms-5">* Es la fecha proxima a recargar el extintor (Se recarga cada año)</small>
          </div>
      </div>

      <button type="submit" class="btn btn-success mt-3"  value ="add">
        <i class="bi bi-floppy"></i>  
        Guardar
    </button>
        
  </form>
  </div>
</div>
</div>
  <div class="pt-3 mt-2 mx-4">
    <div class="bg-light p-4 shadow-lg">
      <!--Se mostrara la tabla de extintores-->
      <h4 class="my-1">Informacion sobre extintores con reporte</h4>
      <small>Estos reportes son unicamente por una sola area</small>

      </br>

      <button type="button" id="generatePDF" class="btn btn-danger mt-4">
        <i class="bi bi-file-earmark-pdf h4"></i>PDF
      </button>
      <button type="submit" class="btn btn-success mt-4" id="generateExcel">
          <i class="bi bi-file-earmark-spreadsheet h4"></i> Excel
      </button>
      

      <table id="tablaRegExt" class="display w-100" >
        <thead>
          <tr>    
            <th>No. Id</th>
            <th>Lugar.Des</th>
            <th>Acceso.Obs</th>
            <th>Señal</th>
            <!--<th>Instrucciones</th>
            <th>Sellos</th>
            <th>Lecturas</th>
            <th>Daño</th>
            <th>Manijas</th>-->
            <th>Altura</th>
            <th>Peso</th>
            <!--<th>Mes</th>-->
            <!--<th>Estatus</th>-->
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<!--Aqui
  <div class="col-6 col-12 mt-4">
        <label for="" class="form-label" >Área</label>
          <select name="" id="areaR"class="form-control">
            <option value="0" >Todas las Áreas</option>
              <?php
                /*$opt = "";
                foreach ($areas as $item) {
                  $opt .= "<option value='{$item["id_area"]}'>{$item["textArea"]}</option>";
                }
          echo $opt;*/
          ?>
          </select>
      </div>
           
      <div class="d-flex justify-content-evenly">
        <button class="btn btn-primary mt-4 d-flex align-items-center" type="submitR">
          <i class="bi bi-table h4 me-2"></i>
          <h4>Generar Reporte </h4>
        </button>
      </div>-->

  <style>
  tr{
    cursor: pointer;
  }
  .ids{
    width: 4rem;
  }
  .estatus{
    width: 9rem;
  }
</style>



      <?php require 'public/views/components/Footer.php'; ?>
      <script src="../public/views/Extintores/extintor.js"></script>

