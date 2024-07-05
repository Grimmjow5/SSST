<nav class="navbar navbar-light bg-light shadow-sm">
  <div class="container-fluid">

    <div class="d-flex align-items-center" >
         <a class="navbar-brand" href="#">
            <img src=<?="../public/img/logo.png" ?> alt="" width="120" height="60" class="d-inline-block align-text-top">
        </a>
        <button type="button" class="btn btn-outline-light text-black" id="toggle" style="height: 2rem;width: 2rem;">
                <i class="bi bi-list h3"></i>
        </button>
    </div>  
    <a class="text-black" href="/logout">
        <i class="bi bi-box-arrow-left "></i>
        Cerrar Sesión
    </a>
  </div>
</nav>

<div class="d-flex h-100" style="background-color: #eceff4;">
<div class="shadow-lg bg-light h-100" style="width: 20rem;" id="slide">
    <h6 class="text-secondary mt-3 ms-3">Inicio</h6>
    <ul>
        <li class="my-3">
            <a href="/riesgos" class="text-black" >Situaciones de riesgo</a>
        </li>
        
        <li>
            <a href="/Catalogo" class="text-black">Alta de extintores</a>
        </li>
        <!--Aqui cambiamos la ruta ya que se agrego una opcion en la lista del nav-->
</br>
        <li>
            <a href="/Extintores" class="text-black">Reporte de condición de extintor</a>
        </li>
        <!--termina-->
    </ul>
    <hr>
    <ul>
        <li>
            <a href="/riesgos/report" class="text-black">Resportes de Riesgos</a>
        </li>
<!--Se modifico por la de arriba-->
        <li class="my-3">
            <a href="/Extintores/reportE" class="text-black">Reportes de Extintores</a>
        </li>
        </br>
        </br>
        </br>
        </br>
        </br>
        <hr>
        <li class="my-3">
            <a href="/Roles" class="text-black">Roles</a>
        </li>
        <li class="my-3">
            <a href="/Registro" class="text-black">Registro</a>
        </li>
    </ul>
</div>


