const hoy = Date.now();
const dateNow = new Date(hoy);
dateNow.setMonth( dateNow.getMonth() <= 9 ?  "0"+dateNow.getMonth() : dateNow.getMonth()+1 );

const  dateReport = $("#fecha");
const fechNow = `${dateNow.getFullYear()}-0${ dateNow.getMonth()+1}-${dateNow.getUTCDate()}`;

dateReport.val(`${dateNow.getFullYear()}-0${dateNow.getMonth()+1}-01`);


//Elementos del DOM
const area =$("#area");
const fecha = $("#fecha");


let urlFetch=" ";

$("#report").on('submit',async (e)=>{
    e.preventDefault();
    try {
        tabla.clear().draw();
        tabla.ajax.url("/Extinotres/reports"+cadenaReport()).load();
        format();
        const da = await res.json();
        console.log(da.data);
    } catch (error) {
        console.error(error);
    } 
});
const textDescripcion = $("#textTitle");
const format =()=>{

    if(dateReport.val() != '' ){
        text = `Riesgos reportados de ${dateReport.val()} `;
    }

    let text = "";
    if(area.val() >0 ){
        let areaText = $("#area option:selected").text();
        text += `, de ${areaText}`;
    }

  text = text.trim()+".";
  textDescripcion.html(text);
  return text;
}

const cadenaReport=()=>{        
    const res = `?fecha=${dateReport.val()}
    &area=${area.val()}`;
    return res;
}
//Configuración de Tabla para mostrar antes de 
const tabla  = new DataTable('#tableReport', {
 
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
            },
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
            }
        ]
     });
     
  $("#generatePDF").click(()=>{
    window.location="/PDF"+cadenaReport()+`&title=${format()}`;
  });
  $("#generateExcel").click(()=>{
    window.location = "/EXCEL"+cadenaReport();
  });