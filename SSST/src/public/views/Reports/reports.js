const hoy = Date.now();
const dateNow = new Date(hoy);
dateNow.setMonth( dateNow.getMonth() <= 9 ?  "0"+dateNow.getMonth() : dateNow.getMonth()+1 );

const dateMinReport = $("#fechaMinReport");
const fechNow = `${dateNow.getFullYear()}-0${ dateNow.getMonth()+1}-${dateNow.getUTCDate()}`;

dateMinReport.attr({"max": fechNow});

dateMinReport.val(`${dateNow.getFullYear()}-0${dateNow.getMonth()+1}-01`);
const dateMaxReport = $("#fechaMaxReport");

dateMaxReport.attr({"max": fechNow});
dateMaxReport.val(fechNow);
//dateSolution.attr({"max":"2024-04-01"});

//Elementos del DOM
const area =$("#area");//Are de donde se hace la consulta en caso de cero toma que que son todas las áreas
const estatus = $("#estatus");//Hay tres opciones reportado, solucionado y las dos al mismo tiempo 
const fechaMinSolucion = $("#fechaMinSolucion");//Fecha minima para consultar por solución
const fechaMaxSolucion = $("#fechaMaxSolucion");//FechaMaxiuma para consutlar por soluciónnn


estatus.on('change',()=>{
  if(estatus.val() == 1 || estatus.val()=='all'){
    fechaMinSolucion.prop('disabled',false);
    
    fechaMaxSolucion.prop('disabled',false);

  }
  else{

    fechaMinSolucion.val('');
    fechaMaxSolucion.val('');
    fechaMaxSolucion.prop('disabled',true);
    fechaMinSolucion.prop('disabled',true);
  }
});

$("#report").on('submit',async (e)=>{
    e.preventDefault();
    try {
    tabla.clear().draw();
    tabla.ajax.url("/SSST/riesgos/reports"+cadenaReport()).load();
    format();
    const da = await res.json();
        console.log(da.data);
    } catch (error) {
        console.error(error);
    } 
});

const textDescripcion = $("#textTitle");
const format =()=>{

  let text = "";
  if(dateMinReport.val() != ''  && dateMaxReport.val() != ''){
    text = `Riesgos reportados entre ${dateMinReport.val()} - ${dateMaxReport.val()}`;
  }
  
  if(dateMinReport.val() != ''  && dateMaxReport.val() == ''){
    text = `Riesgos reportados desde ${dateMinReport.val()}`;
  }

  if(dateMinReport.val() == ''  && dateMaxReport.val() != ''){
      text = `Riesgos reportados asta el ${dateMaxReport.val()}`;
  }
  if(area.val() >0 ){
    let areaText = $("#area option:selected").text();
    text += `, de ${areaText}`;
  }
//En caso de que diga solucionado o los dos entonces se aplicara lo siquiente 
  console.log(estatus.val());
  switch (estatus.val()) {
    
    case '1':
      text += ", solucionado";
      break;
    case '0':
      text +=", reportado ";
      break;
    default:
      text += ", reportado y solucionado ";
      break ;
  }
  if(fechaMinSolucion.val() != '' && fechaMaxSolucion.val() != ''){
      text += `, entre ${fechaMinSolucion.val()} - ${fechaMaxSolucion.val()}`;
  }

  if(fechaMinSolucion.val() != '' && fechaMaxSolucion.val() == ''){
    text += `, desde ${fechaMinSolucion.val()}`;
  }

  if(fechaMinSolucion.val() == '' && fechaMaxSolucion.val() != ''){
    text += `, asta ${fechaMaxSolucion.val()}`;
  }
  text = text.trim()+".";
  textDescripcion.html(text);
  return text;
}
const cadenaReport=()=>{        
    const res = `?fechaReport=${dateMinReport.val()}
    &fechaMaxReport=${dateMaxReport.val()}
    &area=${area.val()}
    &estatus=${estatus.val()}
    &fechaMinSolucion=${fechaMinSolucion.val()}
    &fechaMaxSolucion=${fechaMaxSolucion.val()}`;
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
           _: ' Riesgos',
         }
       },
   
       select: true,
       columns: [
         {
           data: "id",
           className: "ids text-center"
         },
         { data: "text_Riesgo",className:"descri" },
         {   data: "fechaRegistro",className:"fechaRe",render:function(fecha){
             let full = fecha.split(" ")[0].split("-");
             let reverse = full.reverse();
             let format = reverse.join("-");
             return format;
         } },
         {data:"prioridad",className:'prioridad'},
         {
           data: "estatus",className:"estatus",
           render: function (item) {
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
     
  $("#generatePDF").click(()=>{
    window.location="/PDF"+cadenaReport()+`&title=${format()}`;
  });
  $("#generateExcel").click(()=>{
    window.location = "/EXCEL"+cadenaReport();
  });