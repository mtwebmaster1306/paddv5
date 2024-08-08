const SUPABASE_URL = 'https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Productos';
const SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc';

const headersList = {
    "Accept": "*/*",
    "User-Agent": "Thunder Client (https://www.thunderclient.com)",
    "apikey": SUPABASE_KEY,
    "Authorization": `Bearer ${SUPABASE_KEY}`,
    "Content-Type": "application/json"
};

function cargarDatosProducto(idProducto) {
    console.log(`Cargando datos para el producto con ID: ${idProducto}`);
    fetch(`${SUPABASE_URL}?id=eq.${idProducto}&select=*`, {
        method: 'GET',
        headers: headersList
    })
    .then(response => response.json())
    .then(data => {
        console.log('Datos recibidos:', data);
        if (data && data.length > 0) {
            const producto = data[0];
            document.getElementById('updateId').value = producto.id || '';
            document.getElementById('updateProductName').value = producto.NombreDelProducto || '';
            document.getElementById('updateClientName').value = producto.Id_Cliente || '';

        } else {
            console.log('No se encontraron datos para el ID proporcionado');
        }
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('updateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const idProducto = formData.get('id');
    const form = document.getElementById('updateForm');
    
    console.log(form.updateProductName.value);

    const productoActualizado = {
        NombreDelProducto: form.updateProductName.value
    };

    fetch(`${SUPABASE_URL}?id=eq.${idProducto}`, {
        method: 'PATCH',
        headers: {
            ...headersList,
            'Prefer': 'return=minimal'
        },
        body: JSON.stringify(productoActualizado)
    })
    .then(response => {
        if (response.ok) {
            console.log('Producto actualizado correctamente');
            $('#modalupdate').modal('hide');
       
            // Recargar sitio
        location.reload();
        } else {
            throw new Error('Error al actualizar el producto');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});