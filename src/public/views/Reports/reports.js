const dateNow = new Date();
dateNow.setMonth( dateNow.getMonth() <= 9 ?  "0"+dateNow.getMonth() : dateNow.getMonth() );

const  dateReport = $("#fechaReport");

dateReport.attr({"max": `${dateNow.getFullYear()}-0${dateNow.getMonth()}-0${dateNow.getDay()}`});

const dateSolution = $("#fechaSolucion");

dateSolution.attr({"max": `${dateNow.getFullYear()}-0${dateNow.getMonth()}-0${dateNow.getDay()}`});
//dateSolution.attr({"max":"2024-04-01"});
const area =$("#area");
const  withDateSolution =  $("#conSolucion");


const model ={

    conFechaSolucion:false,
};



$("#report").on('submit',async (e)=>{
    e.preventDefault();
    console.log( `${dateNow.getFullYear()}-${dateNow.getMonth()}-${dateNow.getDay()}`);    

});

withDateSolution.on('change',()=>{
    if(!withDateSolution.prop("checked")){
        dateSolution.prop("disabled",true);
    }else{

        dateSolution.prop("disabled",false);
    }
});