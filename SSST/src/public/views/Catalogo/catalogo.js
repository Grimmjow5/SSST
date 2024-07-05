const subArea = document.getElementById('subarea');
const extint = document.getElementById('nExtintor');
const invent = document.getElementById('nInventario');
const estatus = document.getElementById('estatus');
const exId = document.getElementById('idExtintor');

const toggleShow = () => {
    console.log(estatus.value);
    if (estatus.value == 0) {
        console.log("Ejecuta al cargar ");
        showSolucion.classList.add('d-none');
    }
}

const tabla = new DataTable('#tableExtintores', {
    ajax: 'cat_extintores',
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
            data: "id_extintor",
            className: "ids text-center"
        },
        {
            data: "id_sub",
            className: "ids text-center"
        },
        {
            data: "num_extintor",
            className: "ids text-center"
        },
        {
            data: "num_inventario",
            className: 'ids text-center'
        },
        {
            data: "estatus",
            className: "estatus",
            render: function(item) {
                if (item == 1) {
                    return '<i class="bi bi-clipboard-check  text-success h4 mx-1"></i>Activo';
                } else {
                    return '<i class="bi bi-clipboard-x text-warning h4 mx-1"></i>Inactivo';
                }
            }
        }

    ]
});

$('#tableExtintores tbody').on('click', 'tr', async function() {
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    } else {
        tabla.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        let dates = tabla.row('.selected').data();
        console.log(dates);
        extint.focus();
        await selectRow(dates);
    }

});

toggleShow();

const selectRow = async(dates) => {

    extint.value = dates.num_extintor;
    estatus.value = dates.estatus;
    invent.value = dates.num_inventario;
    exId.value = dates.id_extintor;
    subArea.value = dates.id_sub;
    toggleShow();
}

const clearForm = () => {

    extint.value = null;
    invent.value = null;
    estatus.value = 2;
    exId.value = 0;
    subArea.value = 0;
    toggleShow();
}

const forma = document.getElementById('newExtintorCat');
//Modelo el  formulario
forma.addEventListener('submit', async(e) => {
    e.preventDefault();
    const form = new FormData();
    
    form.append('nExtintor', extint.value);
    form.append('nInventario', invent.value);
    form.append('estatus', estatus.value);
    form.append('idExtintor', exId.value)
    form.append('subarea', subArea.value);
    const res = await fetch('/Catalogo', {
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