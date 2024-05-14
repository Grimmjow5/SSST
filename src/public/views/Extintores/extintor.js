const area = document.getElementById('area');
const inven = document.getElementById('txtNumIn');
const peso = document.getElementById('txtPeso');
const altura = document.getElementById('txtAltura');
const inlineRadio1 = document.getElementById('inlineRadio1');





const clearForm = () => {
    area.value = 0;
    inven.value = null;
    peso.value = null;
    altura.value = null;
    inlineRadio1.value = "";

}



const forma = document.getElementById('newExtintor');
//Modelo el  formulario
forma.addEventListener('submit', async(e) => {
    e.preventDefault();
    const form = new FormData();
    form.append('area', area.value);
    form.append('txtNumIn', inven.value);
    form.append('txtPeso', peso.value);
    form.append('txtAltura', altura.value)
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
        showToast({ title: "Listo !!", text: "Se a guardado el riesgo", icon: "success" });
    }

});


const showToast = (msg) => {
    swal({
        title: msg.title,
        text: msg.text,
        icon: msg.icon
    });
}