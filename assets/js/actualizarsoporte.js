function loadProveedorDataSoporte(button) {
    var idSoporte = button.getAttribute('data-id-soporte');
    var soporte = getSoporteData(idSoporte);

    if (soporte) {
        console.log('Datos del soporte:', soporte);
        document.querySelector('input[name="id_proveedor"]').value = soporte.id_proveedor;
        document.querySelector('input[name="nombreIdentificador"]').value = soporte.nombreIdentificador;
        document.querySelector('input[name="nombreFantasia"]').value = soporte.nombreFantasia;
        document.querySelector('input[name="rutProveedor"]').value = soporte.rut_soporte;
        document.querySelector('input[name="giroProveedor"]').value = soporte.giro;
        document.querySelector('input[name="nombreRepresentante"]').value = soporte.nombreRepresentanteLegal;
        document.querySelector('input[name="rutRepresentantexx"]').value = soporte.rutRepresentante;
        document.querySelector('input[name="razonSocial"]').value = soporte.razonSocial;
        document.querySelector('input[name="direccion"]').value = soporte.direccion;
        document.querySelector('select[name="id_region"]').value = soporte.id_region;
        document.querySelector('select[name="id_comuna"]').value = soporte.id_comuna;
        document.querySelector('input[name="telCelular"]').value = soporte.telCelular;
        document.querySelector('input[name="telFijo"]').value = soporte.telFijo;
        document.querySelector('input[name="email"]').value = soporte.email;
        document.querySelector('input[name="bonificacion_ano"]').value = soporte.bonificacion_ano;
        document.querySelector('input[name="escala_rango"]').value = soporte.escala;

       
    } else {
        console.log("No se encontró el proveedor con ID:", idSoporte);
    }
}

