document.addEventListener('DOMContentLoaded', function() {
    const subArea = document.getElementById('subarea');
    const extintor = document.getElementById('extintor');
    const peso = document.getElementById('txtPeso');
    const altura = document.getElementById('txtAltura');
    const ultRec = document.getElementById('fechaUltRec');
    const proxRec = document.getElementById('fechaProxRec');
    const radioGroup = document.getElementById('newExtintor');
    const Id = document.getElementById('id');

    function filterExtintoresBySubArea() {
        const selectedSubArea = subArea.value;
        const extintoresOptions = extintor.getElementsByTagName("option");

        // Restablecer el valor del extintor seleccionado cuando se cambie de área o se seleccione "Seleccionar área"
        if (selectedSubArea === "0") {
            extintor.value = "0";
        }

        // Ocultar todos los extintores
        for (let i = 0; i < extintoresOptions.length; i++) {
            extintoresOptions[i].style.display = "none";
        }

        // Mostrar solo los extintores que pertenecen al área seleccionada
        if (selectedSubArea !== "0") {
            for (let i = 0; i < extintoresOptions.length; i++) {
                const extintorSubArea = extintoresOptions[i].getAttribute("data-subarea");
                if (extintorSubArea === selectedSubArea || extintoresOptions[i].value === "0") {
                    extintoresOptions[i].style.display = ""; // Mostrar el extintor
                }
            }
        }
    }

    const toggleShow = () => {
        console.log(subArea.value);
        if (subArea.value == 0) {
            console.log("Ejecuta al cargar ");
        }
    }

    const tabla = new DataTable('#tableReportE', {
        ajax: '/SSST/repo_ext',
        colReorder: true,
        pageLength: 25,
        language: {
            lengthMenu: 'Mostrar  _MENU_ _ENTRIES_',
            entries: {
                _: ' Catalogo',
            }
        },

        select: true,
        columns: [{
                data: "id",
                className: "ids text-center"
            },
            {
                data: "fecha_reg",
                className: "ids text-center",
                render: function(fecha) {
                    let full = fecha.split(" ")[0].split("-");
                    let reverse = full.reverse();
                    let format = reverse.join("-");
                    return format;
                }
            },
            {
                data: "lugar_designado",
                className: "ids text-center",
                render: function(item) {
                    if (item == 1) {
                        return '<i class="bi bi-check-circle-fill  text-success h4 mx-1"></i>';
                    } else {
                        return '<i class="bi bi-x-circle-fill text-warning h4 mx-1"></i>';
                    }
                }
            },
            {
                data: "acceso",
                className: 'ids text-center',
                render: function(item) {
                    if (item == 1) {
                        return '<i class="bi bi-check-circle-fill  text-success h4 mx-1"></i>';
                    } else {
                        return '<i class="bi bi-x-circle-fill text-warning h4 mx-1"></i>';
                    }
                }
            },
            {
                data: "senial",
                className: 'ids text-center',
                render: function(item) {
                    if (item == 1) {
                        return '<i class="bi bi-check-circle-fill  text-success h4 mx-1"></i>';
                    } else {
                        return '<i class="bi bi-x-circle-fill text-warning h4 mx-1"></i>';
                    }
                }
            },
            {
                data: "instrucciones",
                className: 'ids text-center',
                render: function(item) {
                    if (item == 1) {
                        return '<i class="bi bi-check-circle-fill  text-success h4 mx-1"></i>';
                    } else {
                        return '<i class="bi bi-x-circle-fill text-warning h4 mx-1"></i>';
                    }
                }
            },
            {
                data: "sellos",
                className: 'ids text-center',
                render: function(item) {
                    if (item == 1) {
                        return '<i class="bi bi-check-circle-fill  text-success h4 mx-1"></i>';
                    } else {
                        return '<i class="bi bi-x-circle-fill text-warning h4 mx-1"></i>';
                    }
                }
            },
            {
                data: "lecturas",
                className: 'ids text-center',
                render: function(item) {
                    if (item == 1) {
                        return '<i class="bi bi-check-circle-fill  text-success h4 mx-1"></i>';
                    } else {
                        return '<i class="bi bi-x-circle-fill text-warning h4 mx-1"></i>';
                    }
                }
            },
            {
                data: "danio",
                className: 'ids text-center',
                render: function(item) {
                    if (item == 1) {
                        return '<i class="bi bi-check-circle-fill  text-success h4 mx-1"></i>';
                    } else {
                        return '<i class="bi bi-x-circle-fill text-warning h4 mx-1"></i>';
                    }
                }
            },
            {
                data: "manijas",
                className: 'ids text-center',
                render: function(item) {
                    if (item == 1) {
                        return '<i class="bi bi-check-circle-fill  text-success h4 mx-1"></i>';
                    } else {
                        return '<i class="bi bi-x-circle-fill text-warning h4 mx-1"></i>';
                    }
                }
            },
            {
                data: "altura",
                className: 'ids text-center'
            },
            {
                data: "peso",
                className: 'ids text-center'
            },
            {
                data: "fecha_recarga",
                className: 'ids text-center',
                render: function(fecha) {
                    let full = fecha.split(" ")[0].split("-");
                    let reverse = full.reverse();
                    let format = reverse.join("-");
                    return format;
                }
            },
            {
                data: "fecha_prox_recarga",
                className: 'ids text-center',
                render: function(fecha) {
                    let full = fecha.split(" ")[0].split("-");
                    let reverse = full.reverse();
                    let format = reverse.join("-");
                    return format;
                }
            },
            {
                data: "id_sub",
                className: 'ids text-center'
            },
            {
                data: null,
                className: "ids text-center",
                render: function(data, type, row) {
                    const hoy = new Date();
                    const rowDate = new Date(row.fecha_reg);
                    const MesActual = hoy.getMonth() === rowDate.getMonth() && hoy.getFullYear() === rowDate.getFullYear();
                    if (MesActual) {
                        return '<button class="btn btn-danger btnDelete" data-id="' + row.id + '">Eliminar</button>';
                    } else {
                        return '';
                    }
                }
            }
            /*{
                data: "id_area",
                className: 'ids text-center'
            }*/

        ]
    });

    $('#tableReportE tbody').on('click', 'tr', async function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tabla.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');

            let dates = tabla.row('.selected').data();
            console.log(dates);
            //await selectRow(dates);
        }

    });

    toggleShow();

    // Agregar un controlador de eventos para el cambio en el dropdown list de áreas
    subArea.addEventListener('change', function() {
        filterExtintoresBySubArea();
        extintor.value = "0"; // Restablecer el valor del extintor
    });

    // Ocultar extintores al cargar la página
    var extintoresOptions = extintor.getElementsByTagName("option");
    for (var i = 0; i < extintoresOptions.length; i++) {
        extintoresOptions[i].style.display = "none";
    }

    ultRec.addEventListener('change', () => {
        let nuevafecha = ultRec.value.split('-');
        nuevafecha[0] = (parseInt(nuevafecha[0]) + 1).toString();
        proxRec.value = nuevafecha.join('-');
    });

    const clearForm = () => {
        subArea.value = "0";
        peso.value = "";
        altura.value = "";
        ultRec.value = "";
        proxRec.value = "";
        extintor.value = "0";

        const radios = radioGroup.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => {
            radio.checked = false;
        });
    };


    const form = document.getElementById('newExtintor');
    form.addEventListener('submit', async(e) => {
        e.preventDefault();
        const formData = new FormData(form);
        formData.append('subarea', subArea.value);
        formData.append('extintor', extintor.value);
        formData.append('txtPeso', peso.value);
        formData.append('txtAltura', altura.value);
        formData.append('fechaProxRec', proxRec.value);
        formData.append('fechaUltRec', ultRec.value);

        const res = await fetch('/SSST/Extintores', {
            method: 'POST',
            body: formData,
        });

        const msg = await res.json();
        if (res.status != 200) {
            showToast({ title: "Error", text: msg.res, icon: "error" });
        } else {
            tabla.clear().draw();
            tabla.ajax.reload();
            clearForm();
            showToast({ title: "Listo !!", text: "Se ha guardado los datos del extintor", icon: "success" });
        }
    });


    // Manejar clic en botones de eliminar
    $('#tableReportE').on('click', '.btnDelete', async function() {
        const idRegistro = $(this).data('id'); // Obtener el ID del registro a eliminar
        console.log('ID del registro a eliminar:', idRegistro); // Verifica el ID del registro

        try {
            const res = await fetch(`/SSST/reg_extintores?id=${idRegistro}`, {
                method: 'DELETE',
            });

            if (!res.ok) {
                throw new Error('Error al eliminar el registro');
            }

            const msg = await res.json();
            tabla.ajax.reload(); // Recargar la tabla después de la eliminación exitosa
            showToast({ title: "Listo !!", text: "Se ha eliminado el registro", icon: "success" });

        } catch (error) {
            console.error('Error al eliminar el registro:', error);
            showToast({ title: "Error", text: "Hubo un problema al intentar eliminar el registro", icon: "error" });
        }
    });

    const showToast = (msg) => {
        swal({
            title: msg.title,
            text: msg.text,
            icon: msg.icon
        });
    };

    // Inicializar el filtro al cargar la página
    filterExtintoresBySubArea();
});