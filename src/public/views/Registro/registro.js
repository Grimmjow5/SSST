const nombre = document.getElementById('txtNombre');
const ApellP = document.getElementById('txtApellP');
const Usuario = document.getElementById('txtUsuario');
const Password = document.getElementById('password');
const rol = document.getElementById('rol');
const estatus = document.getElementById('estatus');
const correo = document.getElementById('correo');




const tabla = new DataTable('#tableUsuarios', {
    ajax: 'vista_usuario',
    colReorder: true,
    pageLength: 5,
    language: {
        lengthMenu: 'Mostrar _MENU_ _ENTRIES_',
        entries: {
            _: 'Registro',
        }
    },
    select: true,
    columns: [{
            data: "id_user",
            className: "ids text-center"
        },
        {
            data: "user_name",
            className: "ids text-center"
        },
        {
            data: "last_name",
            className: "ids text-center"
        },
        {
            data: "user",
            className: "ids text-center"
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
            data: "rol"
        },
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
        await selectRow(dates);
    }
});

const selectRow = async(dates) => {
    nombre.value = dates.user_name;
    ApellP.value = dates.last_name;
    Usuario.value = dates.user;
    estatus.value = dates.status;
    rol.value = dates.rol;
    correo.value = dates.correo;

}

const clearForm = () => {
    nombre.value = null;
    ApellP.value = null;
    rol.value = 0;
    Usuario.value = null;
    correo.value = null;
    Password.value = null;
    estatus.value = 2;
}

const forma = document.getElementById('newRegistro');
forma.addEventListener('submit', async(e) => {
    e.preventDefault();

    // Mostrar el indicador de carga
    swal({
        title: "Cargando...",
        text: "Por favor espere.",
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
    });

    const form = new FormData();
    form.append('txtNombre', nombre.value);
    form.append('txtApellP', ApellP.value);
    form.append('rol', rol.value);
    form.append('txtUsuario', Usuario.value);
    form.append('correo', correo.value);
    form.append('password', Password.value);
    form.append('estatus', estatus.value);

    try {
        const res = await fetch('/Registro', {
            method: 'POST',
            body: form,
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
    } catch (error) {
        showToast({ title: "Error", text: "Ocurrió un error al procesar la solicitud.", icon: "error" });
    } finally {
        // Ocultar el indicador de carga
        swal.close();
    }
});

const showToast = (msg) => {
    swal({
        title: msg.title,
        text: msg.text,
        icon: msg.icon
    });
}