function getFormData() {
    const formData = new FormData(document.getElementById('formularioAgregarProveedor'));

    // Convertir FormData a objeto para imprimirlo
    const dataObject = {};
    formData.forEach((value, key) => {
        dataObject[key] = value;
    });

    console.log(dataObject, "hola"); // Imprime el objeto con los datos del formulario

    return {
        created_at: new Date().toISOString(),
        nombreIdentificador: dataObject.nombreIdentificador,
        nombreProveedor: dataObject.nombreProveedor,
        nombreFantasia: dataObject.nombreFantasia,
        rutProveedor: dataObject.rutProveedor,
        giroProveedor: dataObject.giroProveedor,
        nombreRepresentante: dataObject.nombreRepresentante,
        rutRepresentante: dataObject.rutRepresentante,
        razonSocial: dataObject.razonSocial,
        direccionFacturacion: dataObject.direccionFacturacion,
        id_medios: dataObject.id_medios,
        id_region: dataObject.id_region,
        id_comuna: dataObject.id_comuna,
        telCelular: dataObject.telCelular,
        telFijo: dataObject.telFijo,
        email: dataObject.email || null,
        bonificacion_ano: dataObject.bonificacion_ano,
        escala_rango: dataObject.escala_rango,
        estado: true
    };
}

// Función para enviar el formulario
async function submitForm(event) {
    event.preventDefault(); // Evita la recarga de la página

    let bodyContent = JSON.stringify(getFormData());
    console.log(bodyContent,"holacon");
    let headersList = {
        "Content-Type": "application/json",
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
    };
    let response = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Proveedores", {
        method: "POST",
        body: bodyContent,
        headers: headersList
    });

    if (response.ok) {
        // Si el registro fue exitoso
        alert("Registro correcto");
        location.reload();
    } else {
        // Si hubo un error en el registro
        console.error("Error:", errorData);
        alert("Error, intentelo nuevamente");
    }
}

// Asignar el evento de envío al botón "Siguiente"
document.getElementById('provprov').addEventListener('click', submitForm);

