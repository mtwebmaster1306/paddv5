
function getFormData() {
    const formData = new FormData(document.getElementById('formularioactualizarcliente'));

    // Convertir FormData a objeto para imprimirlo
    const dataObject = {};
    formData.forEach((value, key) => {
        dataObject[key] = value;
    });

    console.log(dataObject, "hola"); // Imprime el objeto con los datos del formulario

    return {
        nombreCliente: dataObject.nombreCliente,
        nombreFantasia: dataObject.nombreFantasia,
        razonSocial: dataObject.razonSocial,
        grupo: dataObject.grupo,
        RUT: dataObject.RUT_info,
        giro: dataObject.giro,
        id_tipoCliente: dataObject.id_tipoCliente,
        nombreRepresentanteLegal: dataObject.nombreRepresentanteLegal,
        RUT_representante: dataObject.RUT_representante,
        direccionEmpresa: dataObject.direccionEmpresa,
        id_region: dataObject.id_region,
        id_comuna: dataObject.id_comuna,
        telCelular: dataObject.telCelular,
        telFijo: dataObject.telFijo,
        email: dataObject.email,
        formato: dataObject.formato,
        nombreMoneda: dataObject.nombreMoneda,
        valor: dataObject.valor
    };
}

// Función para enviar el formulario con PATCH
async function submitForm(event) {
    event.preventDefault(); // Evita la recarga de la página

    let bodyContent = JSON.stringify(getFormData());
    console.log(bodyContent, "holacon");

    let idAgencia = document.querySelector('input[name="id_cliente"]').value;

    let headersList = {
        "Content-Type": "application/json",
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",  // Reemplaza con tu clave API
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"  // Reemplaza con tu token
    };

    let response = await fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Clientes?id_cliente=eq.${idAgencia}`, {
        method: "PATCH",
        body: bodyContent,
        headers: headersList
    });

    if (response.ok) {
        // Si la actualización fue exitosa
        alert("Actualización correcta");
        // Redirigir a ListClientes.php
        window.location.href = 'ListClientes.php';
    } else {
        // Si hubo un error en la actualización
        const errorData = await response.json();
        console.error("Error:", errorData);
        alert("Error, intentelo nuevamente");
    }
}

// Función para actualizar la tabla
async function updateTable() {
    let response = await fetch('ListClientes.php', { method: 'GET' });

    if (response.ok) {
        let html = await response.text();
        document.querySelector('.card-body').innerHTML = html;
    } else {
        console.error("Error al actualizar la tabla");
    }
}


document.getElementById('formularioactualizarcliente').addEventListener('submit', submitForm);