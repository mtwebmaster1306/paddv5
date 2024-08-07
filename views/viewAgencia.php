<?php
session_start();

include '../querys/qclientes.php';
include '../componentes/header.php';
include '../componentes/sidebar.php';

$idAgencia = isset($_GET['id']) ? $_GET['id'] : null;

$agencias = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Agencias?select=*');
$regiones = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Region?select=*');
$comunas = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Comunas?select=*');

$agencia = null;
foreach ($agencias as $a) {
    if ($a['id'] == $idAgencia) {
        $agencia = $a;
        break;
    }
}

$nombreRegion = '';
$nombreComuna = '';

foreach ($regiones as $region) {
    if ($region['id'] == $agencia['Region']) {
        $nombreRegion = $region['nombreRegion'];
        break;
    }
}

foreach ($comunas as $comuna) {
    if ($comuna['id_comuna'] == $agencia['Comuna']) {
        $nombreComuna = $comuna['nombreComuna'];
        break;
    }
}

if (!$agencia) {
    echo "Agencia no encontrada.";
    exit();
}
?>

<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header milinea">
                <div class="titulox"><h4>Detalle Agencia</h4></div>
                <div class="agregar">
                    <button type="button" class="btn btn-success micono" data-bs-toggle="modal" data-bs-target="#actualizaragencia2" data-idagencia="<?php echo $idAgencia ?>" onclick="loadAgenciaData2(this)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Pestañas -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="generales-tab" data-toggle="tab" href="#generales" role="tab" aria-controls="generales" aria-selected="true">Datos Generales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="facturacion-tab" data-toggle="tab" href="#facturacion" role="tab" aria-controls="facturacion" aria-selected="false">Datos de Facturación</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Datos Generales -->
                    <div class="tab-pane fade show active" id="generales" role="tabpanel" aria-labelledby="generales-tab">
                        <div class="row">
                            <div class="yep col">
                                <div class="concatn">
                                    <label class="tituloviewagen">Razón Social:</label>
                                    <span><?php echo $agencia['RazonSocial']; ?></span>
                                </div>
                                <div class="concatn">
                                    <label class="tituloviewagen">Nombre de Fantasía:</label>
                                    <span><?php echo $agencia['NombreDeFantasia']; ?></span>
                                </div>
                                <div class="concatn">
                                    <label class="tituloviewagen">Nombre Identificador:</label>
                                    <span><?php echo $agencia['NombreIdentificador']; ?></span>
                                </div>
                                <div class="concatn">
                                    <label class="tituloviewagen">Rut:</label>
                                    <span><?php echo $agencia['RutAgencia']; ?></span>
                                </div>
                            </div>
                            <div class="yep col">
                                <div class="concatn">
                                    <label class="tituloviewagen">Giro:</label>
                                    <span><?php echo $agencia['Giro']; ?></span>
                                </div>
                                <div class="concatn">
                                    <label class="tituloviewagen">Nombre Representante Legal:</label>
                                    <span><?php echo $agencia['NombreRepresentanteLegal']; ?></span>
                                </div>
                                <div class="concatn">
                                    <label class="tituloviewagen">Rut Representante:</label>
                                    <span><?php echo $agencia['rutRepresentante']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Datos de Facturación -->
                    <div class="tab-pane fade" id="facturacion" role="tabpanel" aria-labelledby="facturacion-tab">
                        <div class="row">
                            <div class="yep col">
                                <div class="concatn">
                                    <label class="tituloviewagen">Dirección:</label>
                                    <span><?php echo $agencia['DireccionAgencia']; ?></span>
                                </div>
                                <div class="concatn">
                                    <label class="tituloviewagen">Teléfono Celular:</label>
                                    <span><?php echo $agencia['telCelular']; ?></span>
                                </div>
                                <div class="concatn">
                                    <label class="tituloviewagen">Teléfono Fijo:</label>
                                    <span><?php echo $agencia['telFijo']; ?></span>
                                </div>
                            </div>
                            <div class="yep col">
                                <div class="concatn">
                                    <label class="tituloviewagen">Email:</label>
                                    <span><?php echo $agencia['Email']; ?></span>
                                </div>
                                <div class="concatn">
                                    <label class="tituloviewagen">Región:</label>
                                    <span><?php echo $nombreRegion; ?></span>
                                </div>
                                <div class="concatn">
                                    <label class="tituloviewagen">Comuna:</label>
                                    <span><?php echo $nombreComuna; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="actualizaragencia2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Agencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioactualizarAge">
                    <div>
                        <h3 class="titulo-registro mb-3">Actualizar Agencia:</h3>
                        <div class="row">
                            <div class="col-6">
                                <input type="hidden" name="id_agencia">
                                <p><input class="form-control" placeholder="Razón Social" name="razonSocial" required></p>
                                <p><input class="form-control" placeholder="Nombre de Fantasía" name="nombreFantasia" required></p>
                                <p><input class="form-control" placeholder="Nombre Identificador" name="nombreIdentificador" required></p>
                                <p><input class="form-control" placeholder="Rut" name="rut" required></p>
                            </div>
                            <div class="col-6">
                                <p><input class="form-control" placeholder="Giro" name="giro" required></p>
                                <p><input class="form-control" placeholder="Nombre Representante legal" name="nombreRepresentanteLegal" required></p>
                                <p><input class="form-control" placeholder="Rut Representante" name="rutRepresentante" required></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="titulo-registro mb-3">Datos de facturación</h3>
                        <div class="row">
                            <div class="col-6">
                                <p><input class="form-control" placeholder="Dirección" name="direccionagencia" required></p>
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
                                <p><input class="form-control" placeholder="Teléfono celular" name="telCelular" required></p>
                                <p><input class="form-control" placeholder="Teléfono fijo" name="telFijo" required></p>
                                <p><input class="form-control" placeholder="Email" name="email" required></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveBtn" onclick="submitForm(event)">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    function loadAgenciaData2(button) {
        var idAgencia2 = button.getAttribute('data-idagencia');
        var agencia2 = getAgenciaData(idAgencia2);

        if (agencia2) {
            document.querySelector('input[name="id_agencia"]').value = agencia2.id;
            document.querySelector('input[name="razonSocial"]').value = agencia2.RazonSocial;
            document.querySelector('input[name="nombreFantasia"]').value = agencia2.NombreDeFantasia;
            document.querySelector('input[name="nombreIdentificador"]').value = agencia2.NombreIdentificador;
            document.querySelector('input[name="rut"]').value = agencia2.RutAgencia;
            document.querySelector('input[name="giro"]').value = agencia2.Giro;
            document.querySelector('input[name="nombreRepresentanteLegal"]').value = agencia2.NombreRepresentanteLegal;
            document.querySelector('input[name="rutRepresentante"]').value = agencia2.rutRepresentante;
            document.querySelector('input[name="direccionagencia"]').value = agencia2.DireccionAgencia;
            document.querySelector('input[name="telCelular"]').value = agencia2.telCelular;
            document.querySelector('input[name="telFijo"]').value = agencia2.telFijo;
            document.querySelector('input[name="email"]').value = agencia2.Email;

            document.querySelector('select[name="id_region"]').value = agencia2.Region;
            document.querySelector('select[name="id_comuna"]').value = agencia2.Comuna;
        } else {
            console.log("No se encontró la agencia con ID:", idAgencia);
        }
    }

    function getAgenciaData(idAgencia2) {
        var agenciasMap = <?php echo json_encode($agencias); ?>;
        return agenciasMap.find(agencia => agencia.id == idAgencia2) || null;
    }

    window.loadAgenciaData2 = loadAgenciaData2;

    // Filtrar comunas por región seleccionada
    document.getElementById('region').addEventListener('change', function () {
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
    document.getElementById('region').dispatchEvent(new Event('change'));
});
</script>
<script src="../assets/js/actualizarviewagen.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/eliminaragencia.js"></script>
<?php include '../componentes/settings.php'; ?>
<?php include '../componentes/footer.php'; ?>
