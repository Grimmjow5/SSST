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

function filterExtintoresByArea() {
    var selectedArea = document.getElementById("area").value;
    var extintoresDropdown = document.getElementById("extintor");
    var extintoresOptions = extintoresDropdown.getElementsByTagName("option");

    for (var i = 0; i < extintoresOptions.length; i++) {
        var extintorArea = extintoresOptions[i].getAttribute("data-area");
        if (selectedArea === "0" || extintorArea === selectedArea) {
            extintoresOptions[i].style.display = "";
        } else {
            extintoresOptions[i].style.display = "none";
        }
    }
}


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


        clearForm();
        showToast({ title: "Listo !!", text: "Se a guardado los datos del extintor", icon: "success" });
    }

});

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