const area = document.getElementById('area');
const nRiesgo = document.getElementById('nRiesgo');
const descripcion = document.getElementById('descripcion');
const estatus = document.getElementById('estatus');
const prioridad = document.getElementById('prioridad');
const solucion = document.getElementById('solucion');
const elId = document.getElementById('idRiesgo');

const showSolucion = document.getElementById('boxSolucion');

document.addEventListener('DOMContentLoaded', () => {
    toggleShow();
});

estatus.addEventListener('change', () => {
    toggleShow();
});

const toggleShow = () => {
    console.log(estatus.value);
    if (estatus.value == 0) {
        console.log("Ejecuta al cargar ");
        showSolucion.classList.add('d-none');
    } else {
        showSolucion.classList.remove('d-none');
    }
}


const tabla = new DataTable('#tableRiesgos', {
    ajax: 'cat_riesgos',
    colReorder: true,
    pageLength: 25,
    language: {
        lengthMenu: 'Mostrar  _MENU_ _ENTRIES_',
        entries: {
            _: ' Riesgos',
        }
    },

    select: true,
    columns: [{
            data: "id",
            className: "ids text-center"
        },
        { data: "text_Riesgo", className: "descri" },
        {
            data: "fechaRegistro",
            className: "fechaRe",
            render: function(fecha) {
                let full = fecha.split(" ")[0].split("-");
                let reverse = full.reverse();
                let format = reverse.join("-");
                return format;
            }
        },
        { data: "prioridad", className: 'prioridad' },
        {
            data: "estatus",
            className: "estatus",
            render: function(item) {
                if (item == 1) {
                    return '<i class="bi bi-clipboard-check  text-success h4 mx-1"></i>Solucionado';
                } else {
                    return '<i class="bi bi-clipboard-x text-warning h4 mx-1"></i>Reportado';
                }
            }
        },
        { data: "solucion" }
    ]
});


$('#tableRiesgos tbody').on('click', 'tr', async function() {
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    } else {
        tabla.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        let dates = tabla.row('.selected').data();
        console.log(dates);
        area.focus();
        await selectRow(dates);
    }

});

toggleShow();

const selectRow = async(dates) => {
    area.value = dates.id_area;
    //Preguntar que onda con el numero de riesgo ya que se hace de manera automatica
    nRiesgo.value = 210001202;

    descripcion.value = dates.text_Riesgo;
    estatus.value = dates.estatus;
    solucion.value = dates.solucion;
    prioridad.value = dates.prioridad;
    elId.value = dates.id;
    toggleShow();
}
const clearForm = () => {
    area.value = 0;
    //Preguntar que onda con el numero de riesgo ya que se hace de manera automatica
    nRiesgo.value = null;
    descripcion.value = null;
    estatus.value = 0;
    prioridad.value = 0;
    solucion.value = null;
    elId.value = 0;

    toggleShow();
}
const forma = document.getElementById('newRiesgo');
//Modelo el  formulario
forma.addEventListener('submit', async(e) => {
    e.preventDefault();
    const form = new FormData();
    form.append('area', area.value);
    form.append('nRiesgo', nRiesgo.value);
    form.append('descripcion', descripcion.value);
    form.append('estatus', estatus.value);
    form.append('prioridad', prioridad.value);
    form.append('solucion', solucion.value);
    form.append('idRiesgo', elId.value)
    const res = await fetch('/riesgos', {
        method: 'POST',
        body: form,

    });
    const msg = await res.json();
    if (res.status != 200) {
        showToast({ title: "Error", text: msg.res, icon: "info" });
    } else {
        ///err 
        tabla.clear().draw();
        tabla.ajax.reload();
        clearForm();
        showToast({ title: "Listo !!", text: "Se a guardado el riesgo", icon: "success" });
    }

});


const showToast = (msg) => {
    swal({
        title: msg.title,
        text: msg.text,
        icon: msg.icon
    });
}