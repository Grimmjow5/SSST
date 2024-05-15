<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';

?>
<div class="d-flex flex-column" >
<div class="pt-2 mx-4 " style="background-color: #eceff4;">

<div class="w-100 bg-light shadow-lg rounded p-4 mt-3">


<div class="row mt-4 ms-2 me-2">

  <div class="col-6">
  <h3 class="mb-6">Extintores</h3> 
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
   
      <div class="col-6">
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

      <div class="col-6" >
        <label for="formGroupExampleInput" class="form-label">Nu. De inventario</label>
        <input type="text" class="form-control" id="txtNumIn" placeholder="Nu.De inventario">
      </div>

    

    <div class="row mx-auto" style="width: 30rem; "> 

    <div class="col-12 text-center" >
      </br>
      </br>
        <label for="pregunta1" class="form-label">1.-El extintor está en el lugar designado</label>
      </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta1" id="inlineRadio1" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta1" id="inlineRadio1" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta2" class="form-label">2.-El acceso al extintor está obstruido  </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta2" id="inlineRadio1" value="option4">
          <label class="form-check-label " for="inlineRadio4">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta2" id="inlineRadio1" value="option3">
          <label class="form-check-label" for="inlineRadio3">No</label>
        </div>
        </br>
        <label for="pregunta3" class="form-label">3.-El señalamiento del extintor está obstruido</label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta3" id="inlineRadio5" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta3" id="inlineRadio6" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta4" class="form-label">4.-Las instruciones de operación sobre la placa del extintor son legibles</label>
        </br>
        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta4" id="inlineRadio7" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta4" id="inlineRadio8" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta5" class="form-label">5.-Las manijas, boquilla y manguera están en buen estado </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta5" id="inlineRadio9" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta5" id="inlineRadio10" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>

        </br>
        <label for="pregunta6" class="form-label">6.-Los sellos de inviolabilidad están en buenas codiciones</labe>
        </br>
        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta6" id="inlineRadio11" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta6" id="inlineRadio12" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta7" class="form-label">7.-Las lecturas del manómetro están en el rango del operable. Cuando se trate de extintores sin manómetros, se debe determinar por peso si la carga es adecuada    </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta7" id="inlineRadio13" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta7" id="inlineRadio14" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta8" class="form-label">8.-Se observa cualquier envidencia de daños físico, como corrosíon, escape de presíon u obtrucción </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta8" id="inlineRadio15" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta9" id="inlineRadio16" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br> 

        
      </div>
        </div>
        </br> 
        

        <div class="row">
        <div class="col-6">
          
            </br>
            <label for="formGroupExampleInput" class="form-label">Peso del extintor</label>
            <input type="text" class="form-control" id="txtPeso" placeholder="Peso">
        </div>

        <div class="col-6">
        </br>
        <label for="formGroupExampleInput" class="form-label">Altura del extintor</label>
            <input type="text" class="form-control" id="txtAltura" placeholder="Altura">
      </div>
      </div>

      <div class="col-12 mt-2 ms-2 me-2">
        <button type="submit" class="btn btn-success col-12">Guardar</button>
      </div>
  </form>
      </div>

      <?php require 'public/views/components/Footer.php'; ?>
      <script src="../public/views/Extintores/extintor.js"></script>

