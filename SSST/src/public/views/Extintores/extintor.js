document.addEventListener('DOMContentLoaded', function() {
    const subArea = document.getElementById('subarea');
    const extintor = document.getElementById('extintor');
    const peso = document.getElementById('txtPeso');
    const altura = document.getElementById('txtAltura');
    const ultRec = document.getElementById('fechaUltRec');
    const proxRec = document.getElementById('fechaProxRec');
    const radioGroup = document.getElementById('newExtintor');

    function filterExtintoresBySubArea() {
        const selectedSubArea = subArea.value;
        const extintoresOptions = extintor.getElementsByTagName("option");

        // Restablecer el valor del extintor seleccionado cuando se cambie de área o se seleccione "Seleccionar área"
        if (selectedSubArea === "0") {
            extintor.value = "0";
        }

        // Ocultar todos los extintores
        for (let i = 0; i < extintoresOptions.length; i++) {
            extintoresOptions[i].style.display = "none";
        }

        // Mostrar solo los extintores que pertenecen al área seleccionada
        if (selectedSubArea !== "0") {
            for (let i = 0; i < extintoresOptions.length; i++) {
                const extintorSubArea = extintoresOptions[i].getAttribute("data-subarea");
                if (extintorSubArea === selectedSubArea || extintoresOptions[i].value === "0") {
                    extintoresOptions[i].style.display = ""; // Mostrar el extintor
                }
            }
        }
    }

    // Agregar un controlador de eventos para el cambio en el dropdown list de áreas
    subArea.addEventListener('change', function() {
        filterExtintoresBySubArea();
        extintor.value = "0"; // Restablecer el valor del extintor
    });

    // Ocultar extintores al cargar la página
    var extintoresOptions = extintor.getElementsByTagName("option");
    for (var i = 0; i < extintoresOptions.length; i++) {
        extintoresOptions[i].style.display = "none";
    }

    ultRec.addEventListener('change', () => {
        let nuevafecha = ultRec.value.split('-');
        nuevafecha[0] = (parseInt(nuevafecha[0]) + 1).toString();
        proxRec.value = nuevafecha.join('-');
    });

    const clearForm = () => {
        subArea.value = "0";
        peso.value = "";
        altura.value = "";
        ultRec.value = "";
        proxRec.value = "";
        extintor.value = "0";

        const radios = radioGroup.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => {
            radio.checked = false;
        });
    };

    const form = document.getElementById('newExtintor');
    form.addEventListener('submit', async(e) => {
        e.preventDefault();
        const formData = new FormData(form);
        formData.append('subarea', subArea.value);
        formData.append('extintor', extintor.value);
        formData.append('txtPeso', peso.value);
        formData.append('txtAltura', altura.value);
        formData.append('fechaProxRec', proxRec.value);
        formData.append('fechaUltRec', ultRec.value);

        const res = await fetch('/SSST/Extintores', {
            method: 'POST',
            body: formData,
        });

        const msg = await res.json();
        if (res.status != 200) {
            showToast({ title: "Error", text: msg.res, icon: "error" });
        } else {
            clearForm();
            showToast({ title: "Listo !!", text: "Se ha guardado los datos del extintor", icon: "success" });
        }
    });

    const showToast = (msg) => {
        swal({
            title: msg.title,
            text: msg.text,
            icon: msg.icon
        });
    };

    // Inicializar el filtro al cargar la página
    filterExtintoresBySubArea();
});
