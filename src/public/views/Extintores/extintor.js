const area = document.getElementById('area');
//const ext = document.getElementById('extintor');
const peso = document.getElementById('txtPeso');
const altura = document.getElementById('txtAltura');
const ultRec = document.getElementById('fechaUltRec');
const proxRec = document.getElementById('fechaProxRec');
const extintor = document.getElementById('extintor');
const idRe = document.getElementById('idExtinto');

//const inlineRadio1 = document.getElementById('inlineRadio1');
const radioGroup = document.getElementById('newExtintor');
//const areaR = $("#areaR");aqui*/


const areaShow = () => {
    console.log(area.value);
    if (area.value == 0) {
        console.log("Ejecuta al cargar ");
        showSolucion.classList.add('d-none');
    }
}
const ExtintoresShow = () => {
        console.log(extintor.value);
        if (extintor.value == 0) {
            console.log("Ejecuta al cargar ");
            showSolucion.classList.add('d-none');
        }
    }
    //Validacion con respecto a las recargas de los extintores <--Empiezo
ultRec.addEventListener('change', () => {
    nuevafecha = ultRec.value.split('-');
    nuevafecha[0]++;
    proxRec.value = nuevafecha.join('-');
}); //<--Acabo

const tabla = new DataTable('#tablaRegExt', {
    ajax: 'registro_ext',
    colReorder: true,
    pageLength: 25,
    language: {
        lengthMenu: 'Mostrar  _MENU_ _ENTRIES_',
        entries: {
            _: ' Extintores',
        }
    },

    select: true,
    columns: [
        {
            data: "id",
            className: "ids text-center"
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
            data: "altura",
            className: 'ids text-center'
        },
        {
            data: "peso",
            className: 'ids text-center'
        }


    ]
});
$('#tablaRegExt tbody').on('click', 'tr', async function() {
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


const selectRow = async(dates) => {
    idRe.value = dates.id;
    areaShow();




}

const clearForm = () => {
    area.value = 0;
    //ext.value = null;
    peso.value = null;
    altura.value = null;
    ultRec.value = null;
    proxRec.value = null;
    extintor.value = 0;

    //inlineRadio1.value = " ";

    const radios = radioGroup.querySelectorAll('input[type="radio"]');
    radios.forEach(radio => {
        radio.checked = false;
    });

}

const forma = document.getElementById('newExtintor');
//Modelo el  formulario
forma.addEventListener('submit', async(e) => {
    e.preventDefault();
    const form = new FormData();
    form.append('area', area.value);
    form.append('extintor', extintor.value);
    //form.append('extintor', ext.value);
    form.append('txtPeso', peso.value);
    form.append('txtAltura', altura.value);
    form.append('fechaProxRec', proxRec.value);
    form.append('fechaUltRec', ultRec.value);


    /*joshua*/
    const pregun1 = document.querySelector('input[name="pregunta1"]:checked');
    const pregun2 = document.querySelector('input[name="pregunta2"]:checked');
    const pregun3 = document.querySelector('input[name="pregunta3"]:checked');
    const pregun4 = document.querySelector('input[name="pregunta4"]:checked');
    const pregun5 = document.querySelector('input[name="pregunta5"]:checked');
    const pregun6 = document.querySelector('input[name="pregunta6"]:checked');
    const pregun7 = document.querySelector('input[name="pregunta7"]:checked');
    const pregun8 = document.querySelector('input[name="pregunta8"]:checked');

    if (pregun1 && pregun1.checked) {
        form.append('pregunta1', pregun1.value);
    } else {
        form.append('pregunta1', '');
    }
    if (pregun2 && pregun2.checked) {
        form.append('pregunta2', pregun2.value);
    } else {
        form.append('pregunta2', '');
    }
    if (pregun3 && pregun3.checked) {
        form.append('pregunta3', pregun3.value);
    } else {
        form.append('pregunta3', '');
    }
    if (pregun4 && pregun4.checked) {
        form.append('pregunta4', pregun4.value);
    } else {
        form.append('pregunta4', '');
    }
    if (pregun5 && pregun5.checked) {
        form.append('pregunta5', pregun5.value);
    } else {
        form.append('pregunta5', '');
    }
    if (pregun6 && pregun6.checked) {
        form.append('pregunta6', pregun6.value);
    } else {
        form.append('pregunta6', '');
    }
    if (pregun7 && pregun7.checked) {
        form.append('pregunta7', pregun7.value);
    } else {
        form.append('pregunta7', '');
    }
    if (pregun8 && pregun8.checked) {
        form.append('pregunta8', pregun8.value);
    } else {
        form.append('pregunta8',  '');    
    }

    /*aqui termina joshua*/
    const res = await fetch('/Extintores', {
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
        showToast({ title: "Listo !!", text: "Se a guardado los datos del extintor", icon: "success" });
    }

});
/*Aqui
$("#reportR").on('submitR',async (e)=>{
    e.preventDefault();
    try {
    tabla.clear().draw();
    tabla.ajax.url("/Extintores"+cadenaReport()).load();
    format();
    const da = await res.json();
        console.log(da.data);
    } catch (error) {
        console.error(error);
    } 
});

const cadenaReport=()=>{        
    const res = `?area=${area.val()}`;
return res;

}
Configuración de Tabla para mostrar antes de 

const tablaR  = new DataTable('#tablaRepExt', {
 
      ajax:'', 
       colReorder:true,
       pageLength: 25,
       language: {
         lengthMenu: 'Mostrar  _MENU_ _ENTRIES_',
         entries: {
           _: ' Extintores',
         }
       },
   
       select: true,
       columns: [
            {
                data: "id",
                className: "ids text-center"
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
            }
       ]
     });
*/
$("#generatePDF").click(() => {
    window.location = "/PDF" + cadenaReport() + `&title=${format()}`;
});
$("#generateExcel").click(() => {
    window.location = "/EXCEL" + cadenaReport();
});

const showToast = (msg) => {
    swal({
        title: msg.title,
        text: msg.text,
        icon: msg.icon
    });
}