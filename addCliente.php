<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
// Incluir el header y la barra lateral
include 'componentes/header.php';
include 'componentes/sidebar.php';
include 'querys/qinsertclient.php';
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">

            <!-- Form  -->
            <form id="regForm" action="">
    <!-- One "tab" for each step in the form: -->
    <div class="tab">
        <h3 class="titulo-registro mb-3">Información cliente:</h3>
        <div class="row">
            <div class="col-6">
                <p><input class="form-control" placeholder="Nombre de cliente" name="nombreCliente"></p>
                <p><input class="form-control" placeholder="Nombre de Fantasía" name="nombreFantasia"></p>
                <select class="form-select mb-3" name="id_tipoCliente" id="tipocliente">
                    <?php foreach ($tiposClientes as $tiposCliente) : ?>
                        <option value="<?php echo $tiposCliente['id_tyipoCliente']; ?>"><?php echo $tiposCliente['nombreTipoCliente']; ?></option>
                    <?php endforeach; ?>
                </select>
                <p><input class="form-control" placeholder="Razón Social" name="razonSocial"></p>
                <p><input class="form-control" placeholder="Grupo" name="grupo"></p>
            </div>
            <div class="col-6">
                <p><input class="form-control" placeholder="Rut Empresa" name="RUT"></p>
                <p><input class="form-control" placeholder="Giro" name="giro"></p>
                <p><input class="form-control" placeholder="Nombre representante legal" name="nombreRepresentanteLegal"></p>
                <p><input class="form-control" placeholder="Rut Representante" name="Rut_representante"></p>
            </div>
        </div>
    </div>
    <div class="tab">
        <h3 class="titulo-registro mb-3">Datos de facturación</h3>
        <div class="row">
            <div class="col-6">
                <p><input class="form-control" placeholder="Dirección" name="direccionEmpresa"></p>
                <select class="form-select mb-3" name="id_region" id="region">
                    <?php foreach ($regiones as $regione) : ?>
                        <option value="<?php echo $regione['id']; ?>"><?php echo $regione['nombreRegion']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-select mb-3" name="id_comuna" id="comuna">
                    <?php foreach ($comunas as $comuna) : ?>
                        <option value="<?php echo $comuna['id_comuna']; ?>"><?php echo $comuna['nombreComuna']; ?></option>
                    <?php endforeach; ?>
                </select>
                <p><input class="form-control" placeholder="Teléfono celular" name="telCelular"></p>
            </div>
            <div class="col-6">
                <p><input class="form-control" placeholder="Teléfono fijo" name="telFijo"></p>
                <p><input class="form-control" placeholder="Email" name="email"></p>
            </div>
        </div>
    </div>
    <div class="tab">
        <h3 class="titulo-registro mb-3">Otros datos</h3>
        <div class="row">
            <div class="col">
                <p><input class="form-control" placeholder="Formato" name="formato"></p>
            </div>
            <div class="col">
                <p><input class="form-control" placeholder="Moneda" name="nombreMoneda"></p>
            </div>
            <div class="col">
                <p><input class="form-control" placeholder="Valor" name="valor"></p>
            </div>
        </div>
    </div>
    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
        </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>
        
    </section>
</div>

<script src="<?php echo $ruta; ?>assets/js/formulariomultipass.js"></script>
<?php include 'componentes/settings.php'; ?>
<?php include 'componentes/footer.php'; ?>