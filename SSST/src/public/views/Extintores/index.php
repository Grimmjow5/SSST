<?php
require 'public/views/components/Header.php';
require 'public/views/components/Nav.php';
?>

<div class="d-flex flex-column p-2 w-100">
    <div class="pt-2 mx-4" style="background-color: #eceff4;">
        <div class="w-100 bg-light shadow-lg rounded p-4 mt-3">
            <div class="d-flex justify-content-between">
                <div class="col-6">
                    <input type="hidden" id="idExtintor" value="0">
                    <h3 class="mb-6">Reporte de condición de extintor</h3>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <button class="btn btn-danger" onclick="clearForm()">
                        <i class="bi bi-arrow-repeat"></i>
                        Limpiar
                    </button>
                </div>
            </div>

            <div class="card-body">
                </br>
                <form id="newExtintor" class="row">
                    <div class="col-md-6 col-12 mt-1">
                        <label for="area" class="form-label">Area</label>
                        <select class="form-select" id="area" name="area" onchange="filterExtintoresByArea()">
                        <option value="0" selected>Selecciona un área</option>
                            <?php
                            $opt = "";
                            foreach ($areas as $item) {
                                $opt .= "<option value='{$item["id_area"]}' data-area='{$item["id_area"]}'>{$item["textArea"]}</option>";
                            }
                            echo $opt;
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 col-12 mt-1">
                        <label for="extintor" class="form-label">Numero de Extintor</label>
                        <select class="form-select" id="extintor" name="extintor">
                            <option value="0" selected>Selecciona un extintor</option>
                                <?php
                                $opt = "";
                                foreach ($extintores as $item) {
                                    $opt .= "<option value='{$item["id_extintor"]}' data-area='{$item["id_area"]}'>{$item["num_inventario"]}</option>";
                                }
                                echo $opt;
                                ?>
                        </select>
                    </div>

                    <div class="row mx-auto">
                        <!-- Preguntas -->
                        <div class="row">
                            <div class="col-6">
                                </br>
                                <label for="pregunta1_si" class="form-label">1.- El extintor está en el lugar designado</label>
                                </br>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta1" id="pregunta1_si" value="1">
                                    <label class="form-check-label" for="pregunta1_si">Si</label>
                                </div>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta1" id="pregunta1_no" value="0">
                                    <label class="form-check-label" for="pregunta1_no">No</label>
                                </div>
                                </br>
                                <label for="pregunta2_si" class="form-label">2.- El acceso al extintor está obstruido</label>
                                </br>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta2" id="pregunta2_si" value="1">
                                    <label class="form-check-label" for="pregunta2_si">Si</label>
                                </div>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta2" id="pregunta2_no" value="0">
                                    <label class="form-check-label" for="pregunta2_no">No</label>
                                </div>
                                </br>
                                <label for="pregunta3_si" class="form-label">3.- El señalamiento del extintor está obstruido</label>
                                </br>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta3" id="pregunta3_si" value="1">
                                    <label class="form-check-label" for="pregunta3_si">Si</label>
                                </div>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta3" id="pregunta3_no" value="0">
                                    <label class="form-check-label" for="pregunta3_no">No</label>
                                </div>
                                </br>
                                <label for="pregunta4_si" class="form-label">4.- Las instrucciones de operación sobre la placa del extintor son legibles</label>
                                </br>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta4" id="pregunta4_si" value="1">
                                    <label class="form-check-label" for="pregunta4_si">Si</label>
                                </div>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta4" id="pregunta4_no" value="0">
                                    <label class="form-check-label" for="pregunta4_no">No</label>
                                </div>
                                </br>
                            </div>
                            <div class="col-6">
                                </br>
                                <label for="pregunta5_si" class="form-label">5.- Las manijas, boquilla y manguera están en buen estado</label>
                                </br>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta5" id="pregunta5_si" value="1">
                                    <label class="form-check-label" for="pregunta5_si">Si</label>
                                </div>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta5" id="pregunta5_no" value="0">
                                    <label class="form-check-label" for="pregunta5_no">No</label>
                                </div>
                                </br>
                                <label for="pregunta6_si" class="form-label">6.- Los sellos de inviolabilidad están en buenas condiciones</label>
                                </br>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta6" id="pregunta6_si" value="1">
                                    <label class="form-check-label" for="pregunta6_si">Si</label>
                                </div>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta6" id="pregunta6_no" value="0">
                                    <label class="form-check-label" for="pregunta6_no">No</label>
                                </div>
                                </br>
                                <label for="pregunta7_si" class="form-label">7.- Las lecturas del manómetro están en el rango del operable. Cuando se trate de extintores sin manómetros, se debe determinar por peso si la carga es adecuada</label>
                                </br>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta7" id="pregunta7_si" value="1">
                                    <label class="form-check-label" for="pregunta7_si">Si</label>
                                </div>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta7" id="pregunta7_no" value="0">
                                    <label class="form-check-label" for="pregunta7_no">No</label>
                                </div>
                                </br>
                                <label for="pregunta8_si" class="form-label">8.- Se observa cualquier evidencia de daños físicos, como corrosión, escape de presión u obstrucción</label>
                                </br>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta8" id="pregunta8_si" value="1">
                                    <label class="form-check-label" for="pregunta8_si">Si</label>
                                </div>
                                <div class="form-check form-check-inline me-5 ms-5">
                                    <input class="form-check-input" type="radio" name="pregunta8" id="pregunta8_no" value="0">
                                    <label class="form-check-label" for="pregunta8_no">No</label>
                                </div>
                                </br>
                            </div>
                        </div>
                        <!-- joshua -->
                    </div>
                    </br>

                    <div class="row">
                        <div class="col-6">
                            </br>
                            <label for="txtPeso" class="form-label">Peso del extintor</label>
                            <input step="any" type="number" class="form-control" id="txtPeso" placeholder="Peso">
                        </div>
                        <div class="col-6">
                            </br>
                            <label for="txtAltura" class="form-label">Altura del extintor</label>
                            <input step="any" type="number" class="form-control" id="txtAltura" placeholder="Altura">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="fechaUltRec" class="form-label">Fecha de ultima recarga</label>
                            <input type="date" class="form-control" id="fechaUltRec">
                            <small class="ms-5">* Es la ultima fecha que se recargó el extintor</small>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="fechaProxRec" class="form-label">Fecha de próxima recarga</label>
                            <input type="date" class="form-control" id="fechaProxRec">
                            <small class="ms-5">* Es la fecha próxima a recargar el extintor (Se recarga cada año)</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-3" value="add">
                        <i class="bi bi-floppy"></i>
                        Guardar
                    </button>
                </form>
            </div>
        </div>
    </div>
                            
    </div>
</div>

<style>
    tr {
        cursor: pointer;
    }
    .ids {
        width: 4rem;
    }
    .estatus {
        width: 9rem;
    }
</style>

<?php require 'public/views/components/Footer.php'; ?>

<script src="../public/views/Extintores/extintor.js"></script>
