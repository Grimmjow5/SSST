<?php
require 'src/public/views/components/Header.php';
require 'src/public/views/components/Nav.php';

?>
<div class="d-flex flex-column p-2 w-100" >
  <div class="pt-2 mx-4 " style="background-color: #eceff4;">

    <div class="w-100 bg-light shadow-lg rounded p-4 mt-3">


      <div class="d-flex  justify-content-between">

        <div class="col-6">
          <h3 class="mb-6">Agregar Roles</h3> 
        </div>

        <div class="col-6 d-flex justify-content-end">
          <button class="btn btn-danger" onclick="clearForm()">
          <i class="bi bi-arrow-repeat"></i>
            Limpiar</button>
         </div>
      </div>

      <div class="card-body">
      </br>
        <form  id="newRol"   class="row">
        <input type="hidden" id="idRol" value="0">
          <div class="col-md-6 col-12 mt-3" >
            <label for="formGroupExampleInput" class="form-label">Nombre del Rol</label>
            <input type="text" class="form-control" id="nomRol" placeholder="Nombre">
          </div>  

          <div class="col-md-6 col-12 mt-4">
            <div class="form-group row-6">
              <label for="exampleSelect" class="col-sm-2 form-control-label">Estatus</label>
              <div class="col-sm-12">
                <select id="estatus" id="estatus" class="form-control">
                <option value="2" selected>Seleccione el estatus</option>
                  <option value="0">Inactivo</option>
                  <option value="1">Activado</option>
                </select>
              </div>
            </div>
          </div>
          
          <button type="submit" class="btn btn-success mt-3"  value ="add">
              <i class="bi bi-floppy"></i>  
              Guardar
          </button>
          </br> 
        </form>
      </div>
    </div>
  </div>

      <div class="pt-3 mt-2 mx-4">
            <div class="bg-light p-4 shadow-lg">
              
              <h4 class="my-1">Roles actuales</h4>
              <small>*Roles registrados uicamente por el personal autorizado</small>

              <table id="tableRoles" class="display w-100" >
                <thead>
                  <tr>    
                    <th>No. Id</th>
                    <th>Usuario de registro</th>
                    <th>Fecha de registro</th>
                    <th>Rol</th>
                    <th>Estatus</th>
                  </tr>
                </thead>
              </table>
            </div>
      </div>
</div><!--primer div-->

<?php require 'src/public/views/components/Footer.php'; ?>
<script src="../src/public/views/Roles/roles.js"></script>

