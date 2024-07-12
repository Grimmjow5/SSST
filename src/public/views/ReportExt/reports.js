const hoy = Date.now();
const dateNow = new Date(hoy);
dateNow.setMonth(dateNow.getMonth() <= 9 ? "0" + dateNow.getMonth() : dateNow.getMonth() + 1);

const fechNow = `${dateNow.getFullYear()}-0${ dateNow.getMonth()+1}-${dateNow.getUTCDate()}`;

const fecha = $("#fecha");
fecha.attr({ "max": fechNow });
fecha.val(`${dateNow.getFullYear()}-0${dateNow.getMonth()+1}-01`);

const dateMaxReport = $("#fechaMaxReport");
dateMaxReport.attr({ "max": fechNow });
dateMaxReport.val(fechNow);


//Elementos del DOM
const SubArea = $("#subarea");


const cadenaReport = () => {
    const res = `?fecha=${fecha.val()}
    &fechaMaxReport=${dateMaxReport.val()}
    &subarea=${SubArea.val()}`;
    return res;
}

$("#report").on('submit', async(e) => {
    e.preventDefault();
    try {
        tabla.clear().draw();
        tabla.ajax.url("/SSST/Extintores/reports" + cadenaReport()).load();
        formatE();
        const da = await res.json();
        console.log(da.data);
    } catch (error) {
        console.error(error);
    }
});

const textDescripcion = $("#textTitle");
const formatE = () => {

    let text = "";
    if (SubArea.val() > 0) {
        let subareaText = $("#subarea option:selected").text();
        text += ` ${subareaText} - ${fechNow}`;
    } else {
        if (SubArea.val() == 0) {
            text = `Todas las Subareas - ${fechNow}`;
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
            data: "id_area",
            className: 'ids text-center'
        }
    ]
});

$("#generatePDF").click(() => {
    const url = "/SSST/PDFex" + cadenaReport() + `&title=${formatE()}`;
    window.open(url, '_blank');
});

$("#generateExcel").click(() => {
    window.location = "/SSST/EXCELex" + cadenaReport();
});