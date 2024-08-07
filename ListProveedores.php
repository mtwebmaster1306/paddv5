<?php
// Iniciar la sesión
session_start();

// Función para hacer peticiones cURL
include 'querys/qproveedor.php';

include 'componentes/header.php';
include 'componentes/sidebar.php';
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Listado de Proveedores</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableExportadora">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre Proveedores</th>
                                            <th>Razón Social</th>
                                            <th>Rut</th>
                                            <th>N° de Soportes</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($proveedores as $proveedor): ?>
                                        <tr>
                                            <td><?php echo $proveedor['id_proveedor']; ?></td>
                                            <td><?php echo $proveedor['nombreProveedor']; ?></td>
                                            <td><?php echo $proveedor['razonSocial']; ?></td>
                                            <td><?php echo $proveedor['rutProveedor']; ?></td>
                                            <td>
                                                <?php
                                                 
                                                 $contador = 0;
                                                 foreach ($soportes as $soporte) {
                                                     if ($proveedor['id_proveedor'] == $soporte['id_proveedor']) {
                                                         $contador++;
                                                     }
                                                 }
                                                 echo $contador;
                                                ?>
                                            </td>

                                            <td><a href="views/viewProveedor.php?id_proveedor=<?php echo $proveedor['id_proveedor']; ?>" data-toggle="tooltip" title="Ver Proveedor"><i class="fas fa-eye btn btn-primary micono"></i></a> 
                                            <a href="#" 
   class="btn6 open-modal" 
   data-bs-toggle="modal" 
   data-bs-target="#editProveedorModal" 
   data-toggle="tooltip" 
   title="Editar Proveedor">
    <i class="fas fa-pencil-alt btn btn-success micono"></i>
</a>
                                            
                                            <a type="button" href="#" onclick="confirmarEliminacion(<?php echo htmlspecialchars($medio['id']); ?>); return false;" data-toggle="tooltip" title="Eliminar Proveedor">
                                                <i class="fas fa-trash-alt btn btn-danger micono"></i>
                                            </a></td>
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


//Modal Edit Proveedor

<div class="modal fade" id="editProveedorModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">EDITAR PROVEEDOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                 <!-- Alerta para mostrar el resultado de la actualización -->
                 <div id="updateAlert" class="alert" style="display:none;" role="alert"></div>
                            
                 
              <form id="updateMedioForm">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($medio['id']); ?>">
    <div class="form-group">
        <label for="NombredelMedio">Nombre del Medio</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="
fas fa-caret-square-right"></i></span>
            </div>
            <input type="text" class="form-control" id="NombredelMedio" name="NombredelMedio" value="<?php echo htmlspecialchars($medio['NombredelMedio']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="codigo">Código</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="
fas fa-barcode"></i></span>
            </div>
            <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo htmlspecialchars($medio['codigo']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="Id_Clasificacion">Clasificación</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-indent"></i></span>
            </div>
            <select class="form-control" id="Id_Clasificacion" name="Id_Clasificacion">
                <?php foreach ($clasifiacionmedios as $clasificacion): ?>
                    <option value="<?php echo $clasificacion['id_clasificacion_medios']; ?>"
                            <?php echo ($clasificacion['id_clasificacion_medios'] == $medio['Id_Clasificacion']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($clasificacion['NombreClasificacion']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>
              </div>
            </div>
          </div>
        </div>
//fin editar modal












<?php include 'componentes/settings.php'; ?>
<?php include 'componentes/footer.php'; ?>