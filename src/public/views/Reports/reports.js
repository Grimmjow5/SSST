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






$("#report").on('submit',async (e)=>{
    e.preventDefault();
    console.log("Here");    
    try {
    const config = {method:'GET'};        
    const res = await fetch(`/riesgos/reports?fechaReport=${dateMinReport.val()}
    &fechaMaxReport=${dateMaxReport.val()}
    &area=${area.val()}
    &estatus=${estatus.val()}
    &fechaMinSolucion=${fechaMinSolucion.val()}
    &fechaMaxSolucion=${fechaMaxSolucion.val()}`,config);

        console.log(await res.json());
    } catch (error) {
        console.error(error);
    }
});

//Configuración de Tabla para mostrar antes de 
const tabla = new DataTable("#tableReport",{
layout: {
        topStart: {
            pageLength:{menu:[5,100]},
          buttons: [ 'excel']
        }
    },
 
        ajax:"",
        lenguage:{
            lengthMenu:'Mostrar _MENU_ ',
            entries:{_:"sdsdfdfsdfsdfsdfs",1:"ffffffffffffffff"}
         
        }
    }

);



/* withDateSolution.on('change',()=>{
    if(!withDateSolution.prop("checked")){
        dateSolution.prop("disabled",true);
    }else{

        dateSolution.prop("disabled",false);
    }
}); */