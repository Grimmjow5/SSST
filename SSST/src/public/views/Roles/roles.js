const rol = document.getElementById('nomRol');
const estatus = document.getElementById('estatus');
const rlId = document.getElementById('idRol');

const toggleShow = () => {
    console.log(estatus.value);
    if (estatus.value == 0) {
        console.log("Ejecuta al cargar ");
        showSolucion.classList.add('d-none');
    } 
}

const tabla = new DataTable('#tableRoles', {
    ajax: 'cat_roles',
    colReorder: true,
    pageLength: 25,
    language: {
        lengthMenu: 'Mostrar  _MENU_ _ENTRIES_',
        entries: {
            _: ' Roles',
        }
    },

    select: true,
    columns: [{
            data: "id_rol",
            className: "ids text-center"
        },
        { 
            data: "id_userReg", 
            className: "ids text-center" 
        },
        {
            data: "fech_reg",
            className: "fechaRe",
            render: function(fecha) {
                let full = fecha.split(" ")[0].split("-");
                let reverse = full.reverse();
                let format = reverse.join("-");
                return format;
            }
        },
        { 
            data: "text_Rol", 
        },
        {
            data: "estatus",
            className: "estatus",
            render: function(item) {
                if (item == 1) {
                    return '<i class="bi bi-person-fill-check  text-success h4 mx-1"></i>Activo';
                } else {
                    return '<i class="bi bi-person-fill-x text-warning h4 mx-1"></i>Inactivo';
                }
            }
        }
        
    ]
});

$('#tableRoles tbody').on('click', 'tr', async function() {
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    } else {
        tabla.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        let dates = tabla.row('.selected').data();
        console.log(dates);
        rol.focus();
        await selectRow(dates);
    }

});

toggleShow();

const selectRow = async(dates) => {

    rol.value = dates.text_Rol;
    estatus.value = dates.estatus;
    rlId.value = dates.id_rol;
    toggleShow();
}

const clearForm = () => {
    rol.value = null;
    estatus.value = 2; 
    rlId.value = 0;
    toggleShow();
}

const forma = document.getElementById('newRol');
//Modelo el  formulario
forma.addEventListener('submit', async(e) => {
    e.preventDefault();
    const form = new FormData();
    form.append('nomRol', rol.value);
    form.append('estatus', estatus.value);
    form.append('idRol',rlId.value);
    const res = await fetch('/Roles', {
        method: 'POST',
        body: form,

    });
    const msg = await res.json();
    if (res.status != 200) {
        showToast({ title: "Error", text: msg.res, icon: "error" });
    } else {
        ///err 
        tabla.clear().draw();
        tabla.ajax.reload();
        clearForm();
        showToast({ title: "Listo !!", text: "Se a guardado el extintor", icon: "success" });
    }

});


const showToast = (msg) => {
    swal({
        title: msg.title,
        text: msg.text,
        icon: msg.icon
    });
}