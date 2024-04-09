<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';
?>

<div class="pt-5 mx-4 w-100" style="background-color: #eceff4;">
<!--Alerta de ingreso-->
<?php
  if(true){
    echo $error;
  }
?>
<!---->
  <h3 class="mb-6">Situaciones de riesgo</h3>
  <div class="w-100 bg-light shadow-lg  rounded p-4 mt-3">
    <form action="/riesgos" method="post" class="row" >
      <input type="hidden" name="elId" value="">
      <div class="col-md-6 mt-3">
        <label for="inputEmail4" class="form-label">Área</label>
        <select class="form-select" name="area">
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
        <input type="number" class="form-control" name="nRiesgo">
      </div>

      <div class="col-lg-12">
          <label class="form-label" for="exampleInput">Descripción de la situación de riesgo</label>          
          <textarea class="form-control" name="descripcion"></textarea>
          <!--<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Breve descripción de la situación de riesgo">-->
      </div>

      <!--Fecha de registros es de manera automatica-->
     <!-- <div class="col-lg-12">
          <label class="form-label" for="exampleInput">Fecha de registro</label>
          <input type="text" class="form-control" id="fecha_reg" name="fecha_reg">
      </div>-->
      <!--En dado caso de modifacion se añade si ya existe y se añade al registro de historico-->

      <div class="col-md-6 col-12 mt-3">
        <div class="form-group row">
          <label for="exampleSelect" class="col-sm-2 form-control-label">Prioridad</label>
          <div class="col-sm-12">
            <select id="prioridad" name="prioridad" class="form-control">
              <option>Alta</option>
              <option>Media</option>
              <option>Baja</option>
            </select>
          </div>
        </div>
      </div>
<!--
      <div class="col-lg-12">
        <div class="form-group row">
          <label for="exampleSelect" class="col-sm-2 form-control-label">Mes capturado</label>
          <div class="col-sm-12">
            <select id="id_mes_captura" name="id_mes_captura" class="form-control">
            </select>
          </div>
        </div>
      </div>
        -->
      <div class="col-md-6 col-12 mt-3">
        <div class="form-group row">
          <label for="exampleSelect" class="col-sm-2 form-control-label">Estatus</label>
          <div class="col-sm-12">
            <select id="estatus" name="estatus" class="form-control">
              <option value="0">Reportó</option>
              <option value="1">Solucionó</option>
            </select>
          </div>
        </div>
      </div>

      <!--Este componenete solo aparece cuando se soluciona el insidente-->
      <div class="col-md-12 my-3" id="textSolucion">
        <label class="form-label">Solución a la situacion de riesgo </label>
        <textarea class="form-control" name="solucion" placeholder="Escribe una descripción breve de la solución"></textarea>
        <!--<input type="text" class="form-control" name="textSolucion" id="">-->
      </div>

      <!--Insidente-->
      

      <button type="submit" class="btn btn-success">Guardar</button>
    </form>
  </div>
</div>

<!--Es parte del body -->
<div>

<script>

const optStatus = document.getElementById('estatus');
const showSolucion = document.getElementById('textSolucion');
  optStatus.addEventListener('change',()=>{
   toggleShow(); 
  });

  const toggleShow = ()=>{
    console.log(optStatus.value);
if(optStatus.value == 0 ){
  console.log("Ejecuta al cargar ");
    showSolucion.classList.add('d-none');
    }
    else{
      showSolucion.classList.remove('d-none');
    }
}
document.addEventListener('DOMContentLoaded',()=>toggleShow());

</script>
  <?php require 'public/views/components/Footer.php'; ?>