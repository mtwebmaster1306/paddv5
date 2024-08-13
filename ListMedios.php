<?php
// Iniciar la sesión
session_start();

// Función para hacer peticiones cURL
include 'querys/qmedios.php';
// Obtener el ID del cliente de la URL
$idMedio = isset($_GET['id']) ? $_GET['id'] : null;
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
                            <div class="titulox"><h4>Listado de Medios</h4></div>
                            <div class="agregar">
                              <a href="#" 
       class="btn btn-primary open-modal" 
       data-bs-toggle="modal" 
       data-bs-target="#modalAdd">
        <i class="fas fa-plus-circle"></i> Agregar Medio
    </a></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tableExportadora">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre del Medio</th>
                                            <th>Código</th>
                                            <th>Clasificación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($medios as $medio): ?>
                                        <tr>
                                            <td><?php echo $medio['id']; ?></td>
                                            <td><?php echo $medio['NombredelMedio']; ?></td>
                                            <td><?php echo $medio['codigo']; ?></td>
                                            <td><?php echo $clasifiacionmediosMap[$medio['Id_Clasificacion']]['NombreClasificacion'] ?? ''; ?></td>
                                            <td><a href="views/viewMedio.php?id=<?php echo $medio['id']; ?>" data-toggle="tooltip" title="Ver Medio"><i class="fas fa-eye btn btn-primary micono"></i></a> 
                                            <a href="#" 
   class="btn6 open-modal" 
   data-bs-toggle="modal" 
   data-bs-target="#exampleModal" 
   data-toggle="tooltip" 
   title="Editar Medio">
    <i class="fas fa-pencil-alt btn btn-success micono"></i></a>
                                            
                                            <a type="button" href="#" onclick="confirmarEliminacion(<?php echo htmlspecialchars($medio['id']); ?>); return false;" data-toggle="tooltip" title="Eliminar Medio">
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



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">EDITAR MEDIO</h5>
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




//modal de add Medio


<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">AGREGAR MEDIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                 <!-- Alerta para mostrar el resultado de la actualización -->
                 <div id="updateAlert2" class="alert" style="display:none;" role="alert"></div>
                            
                 
              <form id="addMedioForm">
 
    <div class="form-group">
        <label for="NombredelMedio">Nombre del Medio</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="
fas fa-caret-square-right"></i></span>
            </div>
            <input type="text" class="form-control" id="NombredelMedio" name="NombredelMedio">
        </div>
    </div>
    <div class="form-group">
        <label for="codigo">Código</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="
fas fa-barcode"></i></span>
            </div>
            <input type="text" class="form-control" id="codigo" name="codigo">
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
    <button type="submit" class="btn btn-primary">Agregar Medio</button>
</form>
              </div>
            </div>
          </div>
        </div>





//fin modal




<?php include 'componentes/settings.php'; ?>

<script src="../../../assets/js/updateMedio.js"></script>
<script src="../../../assets/js/addMedio.js"></script>


<script>
function confirmarEliminacion(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, procedemos con la eliminación
            fetch(`/querys/modulos/deleteMedio.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Eliminado!',
                            'El medio ha sido eliminado.',
                            'success'
                        ).then(() => {
                            // Redirigir a ListMedios.php después de cerrar la alerta
                            window.location.href = 'ListMedios.php';
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'No se pudo eliminar el medio.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Ocurrió un error al intentar eliminar el medio.',
                        'error'
                    );
                });
        }
    });
}
</script>


<?php include 'componentes/footer.php'; ?>