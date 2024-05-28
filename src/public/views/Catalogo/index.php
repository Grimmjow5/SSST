<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';

?>
<div class="d-flex flex-column p-2 w-100" >
  <div class="pt-2 mx-4 " style="background-color: #eceff4;">

    <div class="w-100 bg-light shadow-lg rounded p-4 mt-3">


      <div class="d-flex  justify-content-between">

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
        <form  id="newExtintorCat"   class="row">
        <input type="hidden" id="idExtintor" value="0">
          <div class="col-12" >
            <label for="formGroupExampleInput" class="form-label">Numero de Extintor</label>
            <input type="number" class="form-control" id="nExtintor" placeholder="Numero de Extintor">
          </div>  

          <div class="col-md-6 col-12 mt-4">
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
          
          <div class="col-md-6 col-12 mt-3">
            <label for="formGroupExampleInput" class="form-label">Numero de inventario</label>
            <input type="number" class="form-control" id="nInventario" placeholder="Numero de Inventario">
          </div>
          
          
          <button type="submit" class="btn btn-success mt-3"  value ="add">
              <i class="bi bi-floppy"></i>  
              Guardar
          </button>
          </br> 
        </form>
      </div>
    </div><!--aqui--> 
  </div>
<!--aqui-->
      <div class="pt-3 mt-2 mx-4">
        <div class="bg-light p-4 shadow-lg">
          
          <h4 class="my-1">Extintores registrados</h4>
          <small>Extintores registrados hasta la fecha</small>

          <table id="tableExtintores" class="display w-100" >
            <thead>
              <tr>    
                <th>No. Id</th>
                <th>Numero Extintoristro</th>
                <th>Numero Inventario</th>
                <th>Estatus</th>
              </tr>
            </thead>
          </table>
        </div>
      </div><!--aqui-->
</div>
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
<script src="../public/views/Catalogo/catalogo.js"></script>

