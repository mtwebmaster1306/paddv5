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
                <button type="button" class="btn btn-primary btn-narango" data-bs-toggle="modal"
                  data-bs-target="#modalagregar"><i class="fas fa-plus-circle"></i> Agregar Productos</button>
              </div>


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
                                                 
                                                 $contador = 0;
                                                 foreach ($contratos as $contrato) {
                                                     if ($producto['id'] == $contrato['id_producto']) {
                                                         $contador++;
                                                     }
                                                 }
                                                 echo $contador;
                                                ?>
                                            </td>
                                            <td><a href="views/viewproducto.php?id_producto=<?php echo $producto['id']; ?>" data-toggle="tooltip" title="Ver Producto"><i class="fas fa-eye btn btn-primary micono"></i></a> <a  data-bs-toggle="modal"
                                            data-bs-target="#modalupdate" href="#"  onclick="cargarDatosProducto(<?php echo $producto['id']; ?>)"  data-toggle="tooltip" title="Editar Cliente"><i class="fas fa-pencil-alt btn btn-success micono"></i></a> <a href="#" data-toggle="tooltip" title="Eliminar Cliente" onclick="eliminarProducto(<?php echo $producto['id']; ?>)"><i class="fas fa-trash-alt btn btn-danger micono"></i></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="tableExportadora">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre Cliente</th>
                      <th>Nombre de Producto</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($productos as $producto): ?>
                      <tr>
                        <td><?php echo $producto['id']; ?></td>
                        <td><?php echo $clientesMap[$producto['Id_Cliente']]['nombreCliente'] ?? ''; ?></td>
                        <td><?php echo $producto['NombreDelProducto']; ?></td>


                        <td><a href="views/viewproducto.php?id_producto=<?php echo $producto['id']; ?>" data-toggle="tooltip" title="Ver Producto"><i class="fas fa-eye btn btn-primary micono"></i></a> <a data-bs-toggle="modal"
                            data-bs-target="#modalupdate" href="#" onclick="cargarDatosProducto(<?php echo $producto['id']; ?>)" data-toggle="tooltip" title="Editar Cliente"><i class="fas fa-pencil-alt btn btn-success micono"></i></a> <a href="#" data-toggle="tooltip" title="Eliminar Cliente" onclick="eliminarProducto(<?php echo $producto['id']; ?>)"><i class="fas fa-trash-alt btn btn-danger micono"></i></a></td>
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
                <label for="clientes">Clientes</label>
                <select class="form-control" name="clientes" id="clientes">
                  <?php foreach ($clientes as $cliente): ?>
                    <option value="<?php echo $cliente['id_cliente']; ?>">
                      <?php echo $clientesMap[$cliente['id_cliente']]['nombreCliente'] ?? ''; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>






          <button type="submit" class="btn btn-primary m-t-15 waves-effect">Agregar Producto</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal Update -->
<div class="modal fade bd-example-modal-lg" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Actualizar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="updateForm">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" id="updateId" name="id">
              <div class="form-group">
                <label for="updateClientName">Cliente</label>
                <select class="form-control" id="updateClientName" name="clientName">
                  <!-- Las opciones se cargarán dinámicamente desde JavaScript -->
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="updateProductName">Nombre del Producto</label>
                <input type="text" class="form-control" id="updateProductName" name="productName">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Actualizar</button>
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
<script src="assets/js/producto/updateproductos.js"></script>

<?php include 'componentes/settings.php'; ?>
<?php include 'componentes/footer.php'; ?>