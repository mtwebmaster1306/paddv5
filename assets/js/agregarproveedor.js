// Función para obtener los datos del formulario de agregar proveedor
function getFormData2() {
    const formData2 = new FormData(document.getElementById('formularioAgregarProveedor'));
    const dataObject2 = {};
    formData2.forEach((value, key) => {
        dataObject2[key] = value;
    });

    return {
        created_at: new Date().toISOString(),
        nombreIdentificador: dataObject2.nombreIdentificador,
        nombreProveedor: dataObject2.nombreProveedor,
        nombreFantasia: dataObject2.nombreFantasia,
        rutProveedor: dataObject2.rutProveedor,
        giroProveedor: dataObject2.giroProveedor,
        nombreRepresentante: dataObject2.nombreRepresentante,
        rutRepresentante: dataObject2.rutRepresentante,
        razonSocial: dataObject2.razonSocial,
        direccionFacturacion: dataObject2.direccionFacturacion,
        id_medios: dataObject2.id_medios,
        id_region: dataObject2.id_region,
        id_comuna: dataObject2.id_comuna,
        telCelular: dataObject2.telCelular,
        telFijo: dataObject2.telFijo,
        email: dataObject2.email || null,
        bonificacion_ano: dataObject2.bonificacion_ano,
        escala_rango: dataObject2.escala_rango,
        estado: true
    };
}

// Función para enviar el formulario de agregar proveedor
async function submitForm2(event) {
    event.preventDefault(); // Evita la recarga de la página

    let bodyContent = JSON.stringify(getFormData2());
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
        alert("Registro correcto");
        location.reload();
    } else {
        let errorData = await response.json();
        console.error("Error:", errorData);
        alert("Error, intentelo nuevamente");
    }
}

// Asigna el evento de envío al formulario de agregar proveedor
document.getElementById('formularioAgregarProveedor').addEventListener('submit', submitForm2);
