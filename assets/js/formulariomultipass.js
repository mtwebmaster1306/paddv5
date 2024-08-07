var Fn = {
    validaRut: function(rutCompleto) {
        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto)) return false;
        var tmp = rutCompleto.split('-');
        var digv = tmp[1];
        var rut = tmp[0];
        if (digv == 'K') digv = 'k';
        return (Fn.dv(rut) == digv);
    },
    dv: function(T) {
        var M = 0, S = 1;
        for (; T; T = Math.floor(T / 10)) S = (S + T % 10 * (9 - M++ % 6)) % 11;
        return S ? S - 1 : 'k';
    }
};

var currentTab = 0;
showTab(currentTab);

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    
    document.getElementById("prevBtn").style.display = n == 0 ? "none" : "inline";
    
    var nextBtn = document.getElementById("nextBtn");
    if (n == (x.length - 1)) {
        nextBtn.innerHTML = "Registrar";
        nextBtn.onclick = submitForm;
    } else {
        nextBtn.innerHTML = "Siguiente";
        nextBtn.onclick = function() { nextPrev(1); };
    }
    
    fixStepIndicator(n);
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab += n;
    if (currentTab >= x.length) {
        document.getElementById("regForm").submit();
        return false;
    }
    showTab(currentTab);
}

function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }
    
    // Validación específica para RUT
    if (currentTab == 0) {
        var rutInput = document.getElementsByName("RUT")[0];
        if (!Fn.validaRut(rutInput.value)) {
            alert("RUT inválido");
            rutInput.className += " invalid";
            valid = false;
        }
    }
    
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid;
}

function fixStepIndicator(n) {
    var x = document.getElementsByClassName("step");
    for (var i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    x[n].className += " active";
}

function getFormData() {
    const formData = new FormData(document.getElementById('regForm'));
    const dataObject = Object.fromEntries(formData);
    console.log(dataObject, "Datos del formulario");

    return {
        created_at: new Date().toISOString(),
        nombreCliente: dataObject.nombreCliente,
        nombreFantasia: dataObject.nombreFantasia,
        razonSocial: dataObject.razonSocial,
        id_tipoCliente: dataObject.id_tipoCliente,
        grupo: dataObject.grupo,
        RUT: dataObject.RUT,
        giro: dataObject.giro,
        nombreRepresentanteLegal: dataObject.nombreRepresentanteLegal,
        RUT_representante: dataObject.Rut_representante,
        direccionEmpresa: dataObject.direccionEmpresa,
        id_region: dataObject.id_region,
        id_comuna: dataObject.id_comuna,
        telCelular: dataObject.telCelular,
        telFijo: dataObject.telFijo,
        estado: false,
        email: dataObject.email || null
    };
}

async function submitForm(event) {
    event.preventDefault();

    if (!validateForm()) {
        alert("Por favor, complete todos los campos correctamente antes de enviar.");
        return;
    }

    let bodyContent = JSON.stringify(getFormData());
    console.log(bodyContent, "Datos a enviar");

    let headersList = {
        "Content-Type": "application/json",
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
    };

    try {
        let response = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Clientes", {
            method: "POST",
            body: bodyContent,
            headers: headersList
        });

        if (response.ok) {
            alert("Registro correcto");
            document.getElementById("regForm").reset();
            currentTab = 0;
            showTab(currentTab);
        } else {
            const errorData = await response.json();
            console.error("Error:", errorData);
            alert("Error, inténtelo nuevamente");
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
        alert("Error de conexión, inténtelo más tarde");
    }
}

// Añadir validación en tiempo real para el RUT
document.addEventListener('DOMContentLoaded', function() {
    var rutInput = document.getElementsByName("RUT")[0];
    if (rutInput) {
        rutInput.addEventListener('blur', function() {
            if (!Fn.validaRut(this.value)) {
                this.className += " invalid";
                alert("RUT inválido");
            } else {
                this.className = this.className.replace(" invalid", "");
            }
        });
    }
});