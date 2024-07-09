// Selección de elementos del DOM
const nombre = document.getElementById('txtNombre');
const apellP = document.getElementById('txtApellP');
const usuario = document.getElementById('txtUsuario');
const password = document.getElementById('password');
const rol = document.getElementById('rol');
const area = document.getElementById('area');
const subarea = document.getElementById('subarea'); // Cambiar a minúsculas para consistencia
const estatus = document.getElementById('estatus');
const correo = document.getElementById('correo');

function filterSubAreaByArea() {
    const selectedArea = area.value;
    const subAreaOptions = subarea.getElementsByTagName("option");

    for (let i = 0; i < subAreaOptions.length; i++) {
        if (subAreaOptions[i].getAttribute("data-area") === selectedArea || subAreaOptions[i].value === "0") {
            subAreaOptions[i].style.display = "";
        } else {
            subAreaOptions[i].style.display = "none";
        }
    }
}

area.addEventListener('change', function() {
    filterSubAreaByArea();
    subarea.value = "0"; // Restablecer el valor del extintor
});

// Ocultar todas las opciones de subarea inicialmente
const subAreaOptions = subarea.getElementsByTagName("option");
for (let i = 0; i < subAreaOptions.length; i++) {
    subAreaOptions[i].style.display = "none";
}

const tabla = new DataTable('#tableUsuarios', {
    ajax: '/SSST/vista_usuario',
    colReorder: true,
    pageLength: 5,
    language: {
        lengthMenu: 'Mostrar _MENU_ registros',
        entries: {
            _: 'Registro',
        }
    },
    select: true,
    columns: [
        { 
            data: "id_user", className: "ids text-center" 
        },
        { 
            data: "user_name", className: "ids text-center" 
        },
        { 
            data: "last_name", className: "ids text-center" 
        },
        { 
            data: "user", className: "ids text-center" 
        },
        {
            data: "fecha_reg",
            className: "fechaRe",
            render: function(fecha) {
                let full = fecha.split(" ")[0].split("-");
                let reverse = full.reverse();
                let format = reverse.join("-");
                return format;
            }
        },
        { 
            data: "rol" },
        {
            data: "status",
            className: "estatus",
            render: function(item) {
                if (item == 1) {
                    return '<i class="bi bi-person-fill-check text-success h4 mx-1"></i>Activo';
                } else {
                    return '<i class="bi bi-person-fill-x text-warning h4 mx-1"></i>Inactivo';
                }
            }
        },
        { 
            data: "correo", className: "ids-text-center" 
        }
    ]
});

$('#tableUsuarios tbody').on('click', 'tr', async function() {
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    } else {
        tabla.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        let dates = tabla.row('.selected').data();
        console.log(dates);
        //estatus.focus();
        await selectRow(dates);
        /*usuario.disabled = true;
        nombre.disabled = true;
        apellP.disabled = true;*/
    }
});

/*const selectRow = async(dates) => {
    nombre.value = dates.user_name;
    apellP.value = dates.last_name;
    usuario.value = dates.user;
    estatus.value = dates.status;
    rol.value = dates.rol;
    correo.value = dates.correo;
    subarea.value = dates.subarea;
}*/

const clearForm = () => {
    nombre.value = null;
    apellP.value = null;
    rol.value = 0;
    usuario.value = null;
    correo.value = null;
    password.value = null;
    estatus.value = 2;
    area.value = 0;
    subarea.value = 0; 
    nombre.disabled = false;
    apellP.disabled = false;
    usuario.disabled = false;
}

// Suponiendo que 'form' es una variable global o definida en un ámbito superior
const form = document.getElementById('newRegistro');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Mostrar el indicador de carga
    swal({
        title: "Cargando...",
        text: "Por favor espere.",
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    });

    // Obtener valores seleccionados del campo de subárea
    const selectedSubAreas = [...subarea.selectedOptions].map(option => option.value);

    const formData = new FormData();
    formData.append('txtNombre', nombre.value);
    formData.append('txtApellP', apellP.value);
    formData.append('rol', rol.value);
    formData.append('txtUsuario', usuario.value);
    formData.append('correo', correo.value);
    formData.append('password', password.value);
    formData.append('estatus', estatus.value);
    formData.append('subarea', JSON.stringify(selectedSubAreas)); // Convertir a JSON para enviar como arreglo

    try {
        const res = await fetch('/SSST/Registro', {
            method: 'POST',
            body: formData,
        });

        const msg = await res.json();
        if (res.status !== 200) {
            showToast({ title: "Error", text: msg.res, icon: "error" });
        } else {
            tabla.clear().draw();
            tabla.ajax.reload();
            clearForm();
            showToast({ title: "Listo !!", text: "Se han guardado los datos del usuario", icon: "success" });
        }
    } catch (error) {
        showToast({ title: "Error", text: "Ocurrió un error al procesar la solicitud.", icon: "error" });
    } finally {
        // Ocultar el indicador de carga
        swal.close();
    }
});

function mostrarContrasena() {
    var tipo = document.getElementById("password");
    if (tipo.type == "password") {
        tipo.type = "text";
    } else {
        tipo.type = "password";
    }
}

const showToast = (msg) => {
    swal({
        title: msg.title,
        text: msg.text,
        icon: msg.icon
    });
}
