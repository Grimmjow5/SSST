<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';

?>
<div class="d-flex flex-column">
<div class="pt-2 mx-4 " style="background-color: #eceff4;">
<!---->
  <div class="w-100 bg-light shadow-lg  rounded p-4 mt-3">
<div class="d-flex  justify-content-between">
  <h3 class="mb-6">Situaciones de riesgo</h3> 
  <button class="btn btn-danger" onclick="clearForm()">
  <i class="bi bi-arrow-repeat"></i>
  Limpiar</button>
</div>
    <form id="newRiesgo"  class="row" >
      <input type="hidden" id="idRiesgo" value="0">
      <div class="col-md-6 mt-3">
        <label for="inputEmail4" class="form-label">Área</label>
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
            <!--Verificar que este número no exista en la base de datos-->
      <div class="col-md-6 mt-3">
        <label class="form-label">Número de riesgo</label>
        <input type="number" class="form-control" id="nRiesgo">
      </div>

      <div class="col-lg-12">
          <label class="form-label" for="exampleInput">Descripción de la situación de riesgo</label>          
          <textarea class="form-control" id="descripcion" ></textarea>
      </div>
      <div class="col-md-6 col-12 mt-3">
        <div class="form-group row">
          <label for="exampleSelect" class="col-sm-2 form-control-label">Prioridad</label>
          <div class="col-sm-12">
            <select id="prioridad" class="form-control">
            <option value="0" selected>Seleccione Prioridad</option>
              <option value="Baja">Baja</option>
              <option value="Media">Media</option>
              <option value="Alta">Alta</option>
            </select>
          </div>
        </div>
      </div>
     
      <div class="col-md-6 col-12 mt-3">
        <div class="form-group row">
          <label for="exampleSelect" class="col-sm-2 form-control-label">Estatus</label>
          <div class="col-sm-12">
            <select id="estatus" id="estatus" class="form-control">
              <option value="0">Reportó</option>
              <option value="1">Solucionó</option>
            </select>
          </div>
        </div>
      </div>

      <!--Este componenete solo aparece cuando se soluciona el insidente-->
      <div class="col-md-12 my-3" id="boxSolucion">
        <label class="form-label">Solución a la situacion de riesgo </label>
        <textarea class="form-control" id="solucion" placeholder="Escribe una descripción breve de la solución"></textarea>
        <!--<input type="text" class="form-control" id="textSolucion" id="">-->
      </div>
      <!--Insidente-->
      <button type="submit" class="btn btn-success mt-3"  value="add">
        <i class="bi bi-floppy"></i>  
        Guardar
    </button>
    </form>
  </div>
</div>

<div class="pt-3 mt-2 mx-4">
    <div class="bg-light p-5 shadow-lg">
      <!--Se mostrara la tabla de insidentes-->
      <h4 class="my-4">Riesgos pendientes y Solucionados del Mes pasado</h4>
      <table id="tableRiesgos" class="display w-100" >
        <thead>
          <tr>
    
            <th>No. Id</th>
            <th>Descripción</th>
            <th>Fecha de Resgistro</th>
            <th>Prioridad</th>
            <th>Estatus</th>
            <th>Solución</th>
          </tr>
        </thead>
        
     
      </table>
    </div>
</div>
</div>
<!--Es parte del body -->
<div>

<?php require 'public/views/components/Footer.php'; ?>
<script src="public/views/riesgos/riesgos.js"></script>