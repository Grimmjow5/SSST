const hoy = Date.now();
const dateNow = new Date(hoy);
dateNow.setMonth(dateNow.getMonth() <= 9 ? "0" + dateNow.getMonth() : dateNow.getMonth() + 1);

const fecha = $("#fecha");
const fechNow = `${dateNow.getFullYear()}-0${ dateNow.getMonth()+1}-${dateNow.getUTCDate()}`;

fecha.val(`${dateNow.getFullYear()}-0${dateNow.getMonth()+1}-01`);


//Elementos del DOM
const area = $("#area");
//const fecha = $("#fecha");

const cadenaReport = () => {
    const res = `?fecha=${fecha.val()}
    &area=${area.val()}`;
    return res;
}

$("#report").on('submit', async(e) => {
    e.preventDefault();
    try {
        tabla.clear().draw();
        tabla.ajax.url("/Extintores/reports" + cadenaReport()).load();
        formatE();
        const da = await res.json();
        console.log(da.data);
    } catch (error) {
        console.error(error);
    }
});

const textDescripcion = $("#textTitle");
const formatE = () => {

    /*if(fecha.val() != '' ){
        text = `Riesgos reportados en ${fecha.val()} `;
    }*/

    let text = "";
    if (area.val() > 0) {
        let areaText = $("#area option:selected").text();
        text += ` ${areaText}`;
    } else {
        if (area.val() == 0) {
            text = `Todas las areas - ${fechNow}`;
        }
    }

    text = text.trim() + ".";
    textDescripcion.html(text);
    return text;
}


//Configuración de Tabla para mostrar antes de 
const tabla = new DataTable('#tableReport', {

    ajax: '',
    colReorder: true,
    pageLength: 25,
    language: {
        lengthMenu: 'Mostrar  _MENU_ _ENTRIES_',
        entries: {
            _: ' Extintores',
        }
    },

    select: true,
    columns: [{
            data: "id",
            className: "ids text-center"
        },
        {
            data: "fecha_reg",
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
        },
        {
            data: "fecha_recarga",
            className: 'ids text-center'
        },
        {
            data: "fecha_prox_recarga",
            className: 'ids text-center'
        }
    ]
});

$("#generatePDF").click(() => {
    window.location = "/SSST/PDFex" + cadenaReport() + `&title=${formatE()}`;
});

$("#generateExcel").click(() => {
    window.location = "/SSST/EXCELex" + cadenaReport();
});