// Función para obtener los datos del formulario de agregar soporte
function getFormDataSoporte() {
    const formData = new FormData(document.getElementById('formualarioSoporte'));
    const dataObject = {};
    formData.forEach((value, key) => {
        dataObject[key] = value;
    });

    return {
        created_at: new Date().toISOString(),
        id_proveedor: dataObject.id_proveedor, // Captura el ID del proveedor
        nombreIdentficiador: dataObject.nombreIdentficiador,
        id_medios: dataObject.id_medios,
        razonSocial: dataObject.razonSocial,
        nombreFantasia: dataObject.nombreFantasia,
        rut_soporte: dataObject.rut_soporte,
        giro: dataObject.giro,
        nombreRepresentanteLegal: dataObject.nombreRepresentanteLegal,
        rutRepresentante: dataObject.rutRepresentante,
        direccion: dataObject.direccion,
        id_region: dataObject.id_region,
        id_comuna: dataObject.id_comuna,
        telCelular: dataObject.telCelular,
        telFijo: dataObject.telFijo,
        email: dataObject.email || null,
        bonificacion_ano: dataObject.bonificacion_ano,
        escala: dataObject.escala_rango
    };
}

// Función para enviar el formulario de agregar soporte
async function submitFormSoporte(event) {
    event.preventDefault(); // Evita la recarga de la página

    let bodyContent = JSON.stringify(getFormDataSoporte());
    let headersList = {
        "Content-Type": "application/json",
   
    };

    let response = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Soportes", {
        method: "POST",
        body: bodyContent,
        headers: headersList
    });

    if (response.ok) {
        alert("Soporte agregado correctamente");
        location.reload();
    } else {
        let errorData = await response.json();
        console.error("Error:", errorData);
        alert("Error, intentelo nuevamente");
    }
}

// Asigna el evento de envío al formulario de agregar soporte
document.getElementById('formualarioSoporte').addEventListener('submit', submitFormSoporte);
