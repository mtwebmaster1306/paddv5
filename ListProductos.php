<?php
// Iniciar la sesión
session_start();

include 'querys/qproductos.php';
include 'componentes/header.php';
include 'componentes/sidebar.php';
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header milinea">
                            <div class="titulox">
                                <h4>Listado de Productos</h4>
                            </div>
                            <div class="agregar">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalagregar"><i class="fas fa-plus-circle"></i> Agregar Productos</button>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre Cliente</th>
                                            <th>Nombre de Producto</th>
                                            <th>N° de Campañas</th>
                                            <th>N° de Contratos</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($productos as $producto): ?>
                                        <tr>
                                            <td><?php echo $producto['id']; ?></td>
                                            <td><?php echo $clientesMap[$producto['Id_Cliente']]['nombreCliente'] ?? ''; ?></td>
                                            <td><?php echo $producto['NombreDelProducto']; ?></td>
                                           <td>
                                                <?php
                                                // Verificar si existe la campaña en $campaignMap
                                                if (isset($contadorcampaignsmaps[$producto['Id_Campañas']])) {
                                                    // Obtener el nombre de la clasificación
                                                    $nombreClasificacion = $contadorcampaignsmaps[$producto['Id_Campañas']]['id_campania'];
                                

                                                    // Obtener y mostrar el contador
                                                    $contador = $contadorcampaignsmaps[$producto['Id_Campañas']]['count'] ?? 0;
                                                    echo  $contador;
                                                } else {
                                                    echo '0'; // Mostrar cadena vacía si no se encuentra la campaña
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                 
                                                 $contador = 0;
                                                 foreach ($contratos as $contrato) {
                                                     if ($producto['id'] == $contrato['id_producto']) {
                                                         $contador++;
                                                     }
                                                 }
                                                 echo $contador;
                                                ?>
                                            </td>
                                            <td><a href="views/viewproducto.php?id_producto=<?php echo $producto['id']; ?>" data-toggle="tooltip" title="Ver Producto"><i class="fas fa-eye btn btn-primary micono"></i></a> <a href="#" data-toggle="tooltip" title="Editar Cliente"><i class="fas fa-pencil-alt btn btn-success micono"></i></a> <a href="#" data-toggle="tooltip" title="Eliminar Cliente" onclick="eliminarProducto(<?php echo $producto['id']; ?>)"><i class="fas fa-trash-alt btn btn-danger micono"></i></a></td>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal agregar -->

<div class=" modal fade bd-example-modal-lg " id="modalagregar" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="agregarproducto">
  <div class="row">
    <div class="col-md-6">

  
    <div class="form-group">
  <label for="cliente">Cliente</label>
  <input type="text" id="search" class="form-control" placeholder="Buscar cliente...">
  <select class="form-control hidden" id="cliente" name="cliente" required size="5" onchange="cargarTipoCliente()">
    <option value="">Seleccione un cliente</option>
    <?php foreach ($productos as $producto): ?>
      <?php if (isset($clientesMap[$producto['Id_Cliente']])): ?>
        <option value="<?php echo $producto['Id_Cliente']; ?>" data-tipocliente="<?php echo $tipoclientesMap[$producto['Id_TipoDeCliente']]['nombreTipoCliente']; ?>"
        data-tipo-id="<?php echo $tipoclientesMap[$producto['Id_TipoDeCliente']]['id_tyipoCliente'] ?>">
          <?php echo htmlspecialchars($clientesMap[$producto['Id_Cliente']]['nombreCliente']);
          ?>
         
        </option>
      <?php endif; ?>
    <?php endforeach; ?>
  </select>
  <div id="no-results" class="hidden">No se han encontrado resultados</div>
</div>

<div class="form-group">
  <label for="nombreTipoCliente">Nombre Tipo Cliente</label>
  <input type="text" id="nombreTipoCliente" class="form-control" readonly>
  <input type="hidden" id="idTipoCliente" name="idTipoCliente">
</div>
  
      <div class="form-group">
        <label for="nombreProducto">Nombre del Producto</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="fas fa-box"></i>
            </div>
          </div>
          <input type="text" class="form-control" id="nombreProducto" placeholder="Nombre del Producto" name="nombreProducto" required>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="razonSocial">Razón Social</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="fas fa-building"></i>
            </div>
          </div>
          <input type="text" class="form-control" id="razonSocial" placeholder="Razón Social" name="razonSocial" required>
        </div>
      </div>
      <div class="form-group">
        <label for="agencia">Agencia</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="fas fa-store"></i>
            </div>
          </div>
          <input type="text" class="form-control" id="agencia" placeholder="Agencia" name="agencia" required>
        </div>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary m-t-15 waves-effect">Agregar Producto</button>
</form>
      </div>
    </div>
  </div>
</div>


<style>
  .hidden {
    display: none;
  }
</style>

<!-- script para obtener funciones -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="assets/js/producto/agregarproducto.js"></script>
<script src="assets/js/producto/eliminarproducto.js"></script>

<?php include 'componentes/settings.php'; ?>
<?php include 'componentes/footer.php'; ?>