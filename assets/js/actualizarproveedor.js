function getFormData3() {
    const formData = new FormData(document.getElementById('formactualizarproveedor'));

    // Convertir FormData a objeto para imprimirlo
    const dataObject = {};
    formData.forEach((value, key) => {
        dataObject[key] = value;
    });

    console.log(dataObject, "aqui el actualizar señores"); // Imprime el objeto con los datos del formulario

    return {
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
async function submitForm3(event) {
    event.preventDefault(); // Evita la recarga de la página

    let bodyContent = JSON.stringify(getFormData3());
    console.log(bodyContent, "holacon");

    let idProveedor = document.querySelector('input[name="id_proveedor"]').value;

    let headersList = {
        "Content-Type": "application/json",
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
    };

    try {
        let response = await fetch(`https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Proveedores?id_proveedor=eq.${idProveedor}`, {
            method: "PATCH",
            body: bodyContent,
            headers: headersList
        });

        if (response.ok) {
            alert("Actualización correcta");
            location.reload();
        } else {
            let errorData = await response.json();
            console.error("Error:", errorData);
            alert("Error, intentelo nuevamente");
        }
    } catch (error) {
        console.error("Error de red:", error);
        alert("Error de red, intentelo nuevamente");
    }
}

// Asigna el evento de envío al formulario de actualizar proveedor
document.getElementById('formactualizarproveedor').addEventListener('submit', submitForm3);
