const hoy = Date.now();
const dateNow = new Date(hoy);
dateNow.setMonth( dateNow.getMonth() <= 9 ?  "0"+dateNow.getMonth() : dateNow.getMonth()+1 );

const  dateMinReport = $("#fechaMinReport");
const fechNow = `${dateNow.getFullYear()}-0${ dateNow.getMonth()+1}-${dateNow.getUTCDate()}`;

dateMinReport.attr({"max": fechNow});

dateMinReport.val(`${dateNow.getFullYear()}-0${dateNow.getMonth()+1}-01`);
const dateMaxReport = $("#fechaMaxReport");

dateMaxReport.attr({"max": fechNow});
dateMaxReport.val(fechNow);
//dateSolution.attr({"max":"2024-04-01"});

//Elementos del DOM
const area =$("#area");//Are de donde se hace la consulta en caso de cero toma que que son todas las áreas
const estatus = $("#estatus");//Hay tres opciones reportado, solucionado y las dos al mis tiempo 
const fechaMinSolucion = $("#fechaMinSolucion");//Fecha minima para consultar por solución
const fechaMaxSolucion = $("#fechaMaxSolucion");//FechaMaxiuma para consutlar por soluciónnn


let urlFetch=" ";



$("#report").on('submit',async (e)=>{
    e.preventDefault();
 /*   console.log("A=S");
    urlFetch =`/riesgos/reports?fechaReport=${dateMinReport.val()}
    &fechaMaxReport=${dateMaxReport.val()}
    &area=${area.val()}
    &estatus=${estatus.val()}
    &fechaMinSolucion=${fechaMinSolucion.val()}
    &fechaMaxSolucion=${fechaMaxSolucion.val()}`;
    tabla.clear().draw();
    tabla.ajax.reload();
   */  console.log("Here");    
    try {
    const config = {method:'GET'};        
    const res = await fetch(`/riesgos/reports?fechaReport=${dateMinReport.val()}
    &fechaMaxReport=${dateMaxReport.val()}
    &area=${area.val()}
    &estatus=${estatus.val()}
    &fechaMinSolucion=${fechaMinSolucion.val()}
    &fechaMaxSolucion=${fechaMaxSolucion.val()}`,config);

    tabla.clear().draw();
    tabla.ajax.url(`/riesgos/reports?fechaReport=${dateMinReport.val()}
    &fechaMaxReport=${dateMaxReport.val()}
    &area=${area.val()}
    &estatus=${estatus.val()}
    &fechaMinSolucion=${fechaMinSolucion.val()}
    &fechaMaxSolucion=${fechaMaxSolucion.val()}`).load();
    const da = await res.json();
        console.log(da.data);
    } catch (error) {
        console.error(error);
    } 
});

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
   

/* withDateSolution.on('change',()=>{
    if(!withDateSolution.prop("checked")){
        dateSolution.prop("disabled",true);
    }else{

        dateSolution.prop("disabled",false);
    }
}); */