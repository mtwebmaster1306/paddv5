<?php
   // Función para hacer peticiones cURL 
function makeRequest($url) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

// Obtener datos
$campaigns = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Campania?select=*');

$clientes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Clientes?select=*');


$agencias = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Agencias?select=*');

$medios = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Medios?select=*');

$productos = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Productos?select=*');

$soportes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Soportes?select=*');



$campaignsCount = count($campaigns);
$clientesCount = count($clientes);
$agenciasCount = count($agencias);
$mediosCount = count($medios);

function obtenerNombreCliente($clientes, $idCliente) {
    foreach ($clientes as $cliente) {
        if ($cliente['id_cliente'] == $idCliente) {
            return $cliente['nombreCliente'];
        }
    }
    return null; // Retorna null si no se encuentra el cliente
}
// Procesar los datos
$productosPorCliente = [];

foreach ($productos as $producto) {
    $clienteId = $producto['Id_Cliente'];
    $nombreCliente = obtenerNombreCliente($clientes, $clienteId);
    
    if ($nombreCliente !== null) {
        if (!isset($productosPorCliente[$nombreCliente])) {
            $productosPorCliente[$nombreCliente] = 0;
        }
        $productosPorCliente[$nombreCliente]++;
    }
}

// Preparar datos para el gráficos
$labels = array_keys($productosPorCliente);
$data = array_values($productosPorCliente);
