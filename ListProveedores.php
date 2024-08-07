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
                    <div class="card-header milinea">
                            <div class="titulox"><h4>Listado de Proveedores</h4></div>
                            <div class="agregar"><button type="button" class="btn btn-success micono" data-bs-toggle="modal" data-bs-target="#agregarProveedor"   >Agregar Proveedor<i class="fas fa-pencil-alt"></i></button>
                            </div>
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

//Agregar Proveedor

<div class="modal fade" id="agregarProveedor" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                 <!-- Alerta para mostrar el resultado de la actualización -->
                 <div id="updateAlert" class="alert" style="display:none;" role="alert"></div>
                            
                 
                 <form id="formularioAgregarProveedor">
                    <!-- Campos del formulario -->
                    <div>
                        <h3 class="titulo-registro mb-3">Agregar Proveedor</h3>
                        <div class="row">
                            <div class="col-6">
                  
                                <p><input class="form-control" placeholder="Nombre Identificador" name="nombreIdentificador"></p>
                                <select class="form-select mb-3" name="id_medios" id="id_medios">
                    <?php foreach ($medios as $medio) : ?>
                        <option value="<?php echo $medio['id']; ?>"><?php echo $medio['NombredelMedio']; ?></option>
                    <?php endforeach; ?>
                </select>
                                <p><input class="form-control" placeholder="Nombre de Proveedor" name="nombreProveedor"></p>
                                <p><input class="form-control" placeholder="Nombre de Fantasía" name="nombreFantasia"></p>
                                
                                
                            </div>
                            <div class="col-6">
                                <p><input class="form-control" placeholder="Rut Proveedor" name="rutProveedor"></p>
                                <p><input class="form-control" placeholder="Giro Proveedor" name="giroProveedor"></p>
                                <p><input class="form-control" placeholder="Nombre Representante" name="nombreRepresentante"></p>
                                <p><input class="form-control" placeholder="Rut Representante" name="rutRepresentante"></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="titulo-registro mb-3">Datos de facturación</h3>
                        <div class="row">
                            <div class="col-6">
                            <p><input class="form-control" placeholder="Razón Social" name="razonSocial"></p>
                                <p><input class="form-control" placeholder="Dirección Facturación" name="direccionFacturacion"></p>
                                <select class="form-select mb-3" name="id_region" id="region" required>
    <?php foreach ($regiones as $regione) : ?>
        <option value="<?php echo $regione['id']; ?>"><?php echo $regione['nombreRegion']; ?></option>
    <?php endforeach; ?>
</select>
<select class="form-select mb-3" name="id_comuna" id="comuna" required>
    <?php foreach ($comunas as $comuna) : ?>
        <option value="<?php echo $comuna['id_comuna']; ?>" data-region="<?php echo $comuna['id_region']; ?>">
            <?php echo $comuna['nombreComuna']; ?>
        </option>
    <?php endforeach; ?>
</select>
                                
                            </div>
                            <div class="col-6">
                            <p><input class="form-control" placeholder="Teléfono celular" name="telCelular"></p>
                                <p><input class="form-control" placeholder="Teléfono fijo" name="telFijo"></p>
                                <p><input class="form-control" placeholder="Email" name="email"></p>
                            </div>
                        </div>
                        <h3 class="titulo-registro mb-3">Otros datos</h3>
                        <div class="row">
    <div class="col">
    <p><input class="form-control" placeholder="Bonifiación por año %" name="bonificacion_ano"></p>
    </div>
    <div class="col" id="moneda-container">
    <p><input class="form-control" placeholder="Escala de rango" name="escala_rango"></p>
    </div>

</div>
                    </div>
                    <button type="button" class="btn btn-primary" id="provprov" onclick="submitForm(event)">Guardar cambios</button>
                </form>
              </div>
            </div>
          </div>
        </div>
//fin editar modal



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







<script src="<?php echo $ruta; ?>assets/js/agregarproveedor.js"></script>

<script>document.getElementById('region').addEventListener('change', function () {
    var regionId = this.value;
    var comunaSelect = document.getElementById('comuna');
    var opcionesComunas = comunaSelect.querySelectorAll('option');

    // Mostrar solo las comunas que pertenecen a la región seleccionada
    opcionesComunas.forEach(function (opcion) {
        if (opcion.getAttribute('data-region') === regionId) {
            opcion.style.display = 'block';
        } else {
            opcion.style.display = 'none';
        }
    });

    // Seleccionar la primera opción visible
    var firstVisibleOption = comunaSelect.querySelector('option[data-region="' + regionId + '"]');
    if (firstVisibleOption) {
        firstVisibleOption.selected = true;
    }
});

// Disparar el evento change al cargar la página para establecer el estado inicial
document.getElementById('region').dispatchEvent(new Event('change'));</script>


<?php include 'componentes/settings.php'; ?>
<?php include 'componentes/footer.php'; ?>