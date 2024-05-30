<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';

?>
<div id="loading" style="display: none;">Cargando...</div>
<div class="d-flex flex-column">
<div class="pt-2 mx-4 " style="background-color: #eceff4;">
<!---->
  <div class="w-100 bg-light shadow-lg  rounded p-4 mt-3">
  <div class="row mt-4 ms-2 me-2">

<div class="d-flex  justify-content-between">
  <h3 class="mb-6">Situaciones de riesgo</h3> 
  <button class="btn btn-danger" onclick="clearForm()">
  <i class="bi bi-arrow-repeat"></i>
  Limpiar</button>
</div>

<div class="card-body">
<form id="newRegistro"  class="row" >


<div class="col-12 col-md-6">
            <label for="formGroupExampleInput" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Nombre">
          </div>

          <div class="col-12 col-md-6" >
            <label for="formGroupExampleInput" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="txtApellP" placeholder="A.paterno">
          </div>
         
          
       
          <div class="col-12 col-md-6" >
            <label for="formGroupExampleInput" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="txtUsuario" placeholder="N.Usuario">
          </div>
 
  

  
  <div class="col-12 col-md-6">
          <label for="exampleSelect" class="col-sm-2 form-control-label">Estatus</label>
          <div class="col-sm-12">
            <select id="estatus" id="estatus" class="form-control">
              <option value="2" selected>Seleccione el estatus</option>
              <option value="0">No activo</option>
              <option value="1">Activo</option>
            </select>
          </div>
        </div>


  <div class="col-12 col-md-6">
        <label for="inputEmail4" class="form-label">Rol</label>
        <select class="form-select" id="rol">
          <option value="0" selected>Selecciona un rol</option>
          <?php
          $opt = "";
          foreach ($roles as $item) {
            $opt .= "<option value='{$item["id_rol"]}'>{$item["text_Rol"]}</option>";
          }
          echo $opt;
          ?>
        </select>
      </div>

      <div class="col-12 col-md-6" >
            <label for="formGroupExampleInput" class="form-label">Correo</label>
            <input type="email" id="correo" class="form-control" placeholder="@gmail.com">
  </div>

          <div class="col-12 col-md-6" >
            <label for="formGroupExampleInput" class="form-label">Contraseña</label>
            <input type="password" id="password" class="form-control" aria-describedby="passwordHelpInline">
  </div>
  </div>
          <div class="col-12 mt-2 ms-2 me-2">
            <button type="submit" class="btn btn-success col-12" value = "add" >Guardar</button>
          </div>
          </div>
          </div>
          </br> 
</form>

<div class="pt-3 mt-2 mx-4">
            <div class="bg-light p-4 shadow-lg">
              
              <h4 class="my-1">Roles actuales</h4>
              <small>*Roles registrados uicamente por el personal autorizado</small>

              <table id="tableUsuarios" class="display w-100" >
                <thead>
                  <tr>    
                    <th>No. Id</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
                    <th>Fecha de registro</th>
                    <th>Rol</th>
                    <th>Estatus</th>
                  </tr>
                </thead>
              </table>
            </div>
      </div>
</div>
  </div>
</div>
</div>
</div>
<?php require 'public/views/components/Footer.php'; ?>
<script src="../public/views/Registro/registro.js"></script>