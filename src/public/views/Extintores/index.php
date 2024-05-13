<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';

?>
<div class="d-flex flex-column"style="width: 50rem;">
<div class="pt-2 mx-4 " style="background-color: #eceff4;">

<div class="w-100 bg-light shadow-lg  rounded p-4 mt-3">


<div class="row  mt-4 ms-2 me-2">

  <div class="col-md-6   ">
  <h3 class="mb-6">Situaciones de riesgo</h3> 
  </div>

  <div class="col-md-6   d-flex justify-content-end ">
  <button class="btn btn-danger" onclick="clearForm()">
  <i class="bi bi-arrow-repeat"></i>
  Limpiar</button>
  </div>
</div>



<div class="card-body">
  
  <form class="row g-3">

    <div class="col-md-3" class="container mt-5">
      
      <div class="form-group">
        <label for="monthpicker">Mes</label>
        <input type="text" class="form-control monthpicker" id="monthpicker" placeholder="MM">
      </div>    
    </div>

    <script>
      // Inicializar el datepicker con la opción para mostrar solo meses
      $( function() {
        $(".monthpicker").datepicker({
          dateFormat: 'MM', // Formato de fecha (solo el nombre del mes)
          changeMonth: true,
          changeYear: false,
          showButtonPanel: true,
          onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            $(this).val($.datepicker.formatDate('MM', new Date(0, month, 1)));
          }
        });
      });
    </script>

    <div class="row">

      <div class="col-md-6">
        <label for="formGroupExampleInput" class="form-label">Area</label>
        <select class="form-select" aria-label="Default select example">
          <option selected>area</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>

      <div class="col-md-6">
        <label for="formGroupExampleInput" class="form-label">Nu. De inventario</label>
        <input type="text" class="form-control" id="txtNumIn" placeholder="Nu.De inventario">
      </div>

    </div>

    <div class="row"> 

      <div class="col-md-6 text-center">
      </br>
      </br>
        <label for="pregunta1" class="form-label">El extintor está en el lugar designado</label>
      </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta1" id="inlineRadio1" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta1" id="inlineRadio2" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta2" class="form-label">El acceso al extintor está obstruido  </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta2" id="inlineRadio3" value="option4">
          <label class="form-check-label " for="inlineRadio4">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta2" id="inlineRadio4" value="option3">
          <label class="form-check-label" for="inlineRadio3">No</label>
        </div>
        </br>
        <label for="pregunta3" class="form-label">El señalamiento del extintor está obstruido</label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta3" id="inlineRadio1" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta3" id="inlineRadio2" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta4" class="form-label">Las instruciones de operación sobre la placa del extintor son legibles</label>
        </br>
        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta4" id="inlineRadio1" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta4" id="inlineRadio2" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta5" class="form-label">Las manijas, boquilla y manguera están en buen estado </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta5" id="inlineRadio1" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta5" id="inlineRadio2" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>

        </br>
      </div>


      <div class="col-md-6 text-center">
      </br>
      </br>
        <label for="pregunta6" class="form-label">Los sellos de inviolabilidad están en buenas codiciones</labe>
      </br>
        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta6" id="inlineRadio1" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta6" id="inlineRadio2" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta7" class="form-label">Las lecturas del manómetro están en el rango del operable. Cuando se trate de extintores sin manómetros, se debe determinar por peso si la carga es adecuada    </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta7" id="inlineRadio1" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta7" id="inlineRadio2" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br>
        <label for="pregunta8" class="form-label">Se observa cualquier envidencia de daños físico, como corrosíon, escape de presíon u obtrucción </label>
        </br>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta8" id="inlineRadio1" value="option1">
          <label class="form-check-label " for="inlineRadio1">Si</label>
        </div>

        <div class="form-check form-check-inline me-5 ms-5">
          <input class="form-check-input" type="radio" name="pregunta9" id="inlineRadio2" value="option2">
          <label class="form-check-label" for="inlineRadio2">No</label>
        </div>
        </br> 
      </div>

      <div class="row">
        <div class="col-md-6">
          <label for="formGroupExampleInput" class="form-label">Altura del extintor</label>
            <input type="text" class="form-control" id="txtNumIn" placeholder="Altura">
            </br>
            <label for="formGroupExampleInput" class="form-label">Peso del extintor</label>
            <input type="text" class="form-control" id="txtNumIn" placeholder="Altura">
        </div>

        <div class="col-md-6">
          <label for="formGroupExampleInput" class="form-label">Tipo de polvo</label>
          <select class="form-select" aria-label="Default select example">
            <option selected>area</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-6" class="container mt-5">
          <div class="form-group">
            <label for="datepicker2">Ultima recarga</label>
            <input type="text" class="form-control datepicker" id="datepicker2" placeholder="DD/MM/YY">
          </div>  
        </div>

        <div class="col-md-6" class="container mt-5">
          <div class="form-group">
            <label for="datepicker3">Proxima recarga</label>
            <input type="text" class="form-control datepicker" id="datepicker3" placeholder="DD/MM/YY">
          </div>  
        </div>
      </div>

      <script>
      $( function() {
        $(".datepicker").datepicker({
          dateFormat: 'yy-mm-dd', // Formato de fecha
          onSelect: function(dateText) {
            // Mostrar la fecha seleccionada en el campo de texto
            $(this).val(dateText);
          }
        });
      });
      </script>


      <div class="col-12 mt-2 ms-2 me-2">
        <button type="submit" class="btn btn-success col-12">Guardar</button>
      </div>
    </div>
</form>
</div>

</div>
</div>


<style>
  tr{
    cursor: pointer;
  }
  .ids{
    width: 4rem;
  }
  .descri{
    width: 40%;
     }
  .fechaRe{
    width: 6rem;
  }
  .prioridad{
width: 6rem;
    }
  .estatus{
    width: 9rem;
}
</style>

<?php require 'public/views/components/Footer.php'; ?>

