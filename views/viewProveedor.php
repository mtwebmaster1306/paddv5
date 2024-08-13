<?php
// Iniciar la sesión
session_start();
// Definir variables de configuración
//$ruta = 'localhost/paddv4/';
// Función para hacer peticiones cURL
include '../querys/qproveedor.php';
// Obtener el ID del cliente de la URL
$idProveedor = isset($_GET['id_proveedor']) ? $_GET['id_proveedor'] : null;

if (!$idProveedor) {
    die("No se proporcionó un ID de cliente válido.");
}

// Obtener datos del cliente específico
$url = "https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Proveedores?id_proveedor=eq.$idProveedor&select=*";
$proveedor = makeRequest($url);

// Verificar si se obtuvo el medio
if (empty($proveedor) || !isset($proveedor[0])) {
    die("No se encontró el cliente con el ID proporcionado.");
}

$datosProveedor = $proveedor[0];

// Obtener clasificaciones asociadas al medio
$themedio = makeRequest("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/ClasificacionMedios?select=*");

// Crear un mapa de clasificaciones para fácil acceso
$clasificacionesMap = array_column($themedio, null, 'id_clasificacion_medios');

include '../componentes/header.php';
include '../componentes/sidebar.php';

?>
      <!-- Main Content -->
      <div class="main-content">
      
      <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $ruta; ?>ListProveedores.php">Ver Proveedores</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $datosProveedor['nombreProveedor'] ; ?></li>
                      </ol>
                    </nav>
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      
                      <div class="clearfix"></div>
                      <div class="nombrex author-box-name">
                        <?php echo $datosProveedor['nombreProveedor'] ; ?>
                      </div>
                      <div class="author-box-job">
                      <?php echo 'RUT: ' .$datosProveedor['rutProveedor'] ; ?>
                      
                    
                    </div>
                    </div>
                    <div class="text-center">
                      <div class="author-box-job">
               
                        <?php
    // Convertir la cadena de fecha y hora a un objeto DateTime
    $fecha = new DateTime($datosProveedor['created_at']);
    
    // Formatear la fecha como deseas (en este caso, solo la fecha)
    echo 'Registrado el: '.$fecha->format('d-m-Y'); // Esto mostrará la fecha en formato AAAA-MM-DD
    ?>
                   
                      </div>
                      <div class="w-100 d-sm-none"></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4>Detalles del Proveedor</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">
                      <p class="clearfix">
                        <span class="float-start">
                        Nombre Proveedor
                        </span>
                        <span class="float-right text-muted">
                          <?php echo $datosProveedor['nombreProveedor'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Nombre de Fantasía
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosProveedor['nombreFantasia'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Razón Social
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosProveedor['razonSocial'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Giro Proveedor
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosProveedor['giroProveedor'] ; ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-start">
                          Dirección
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $datosProveedor['direccionFacturacion'] ; ?>
                        </span>
                      </p>
                      
                   
                    </div>
                  </div>
                </div>
               
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-bs-toggle="tab" href="#generales" role="tab"
                          aria-selected="true">Datos Generales</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-bs-toggle="tab" href="#facturacion" role="tab"
                          aria-selected="false">Datos de Facturación</a>
                      </li>
                

                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab4" data-bs-toggle="tab" href="#soportes" role="tab"
                          aria-selected="false">Soportes</a>
                      </li>

             
                    

                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="generales" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="row">
                          <div class="col-md-4 col-6 b-r">
                            <strong>Razón Social</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['razonSocial'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Nombre de Fantasía</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['nombreFantasia'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Nombre Identificador</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['nombreIdentificador'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6">
                            <strong>Giro Proveedor</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['giroProveedor']; ?></p>
                          </div>
                          <div class="col-md-4 col-6">
                            <strong>Representante Legal</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['nombreRepresentante'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6">
                            <strong>RUT Representante</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['rutRepresentante'] ; ?></p>
                          </div>
                           <div class="col-md-4 col-6">
                            <strong>N° de Soportes</strong>
                            <br>
                            <p class="text-muted">
                             <?php
                                                 
                            $contador = 0;
                            foreach ($soportes as $soporte) {
                                if ($datosProveedor['id_proveedor'] == $soporte['id_proveedor']) {
                                    $contador++;
                                }
                            }
                            echo $contador;
                          ?>
                            </p>
                          </div>

                           <div class="col-md-4 col-6">
                            <strong>N° de Medios</strong>
                            <br>
                            <p class="text-muted">Acá data</p>
                          </div>

                          <div class="col-md-4 col-6">
                            <strong>Clientes</strong>
                            <br>
                            <p class="text-muted">Acá data</p>
                          </div>

                        </div>
                      
                      </div>


                      
                      <div class="tab-pane fade" id="facturacion" role="tabpanel" aria-labelledby="profile-tab2">
                      <div class="row">
                      <div class="col-md-4 col-6 b-r">
                            <strong>Región</strong>
                            <br>
                            <p class="text-muted"><?php echo $regionesMap[$datosProveedor['id_region']] ?? ''; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Comuna</strong>
                            <br>
                            <p class="text-muted"><?php echo $comunasMap[$datosProveedor['id_comuna']] ?? ''; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Dirección</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['direccionFacturacion'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Teléfono Fijo</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['telFijo'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Teléfono Celular</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['telCelular'] ; ?></p>
                          </div>
                          <div class="col-md-4 col-6 b-r">
                            <strong>Email</strong>
                            <br>
                            <p class="text-muted"><?php echo $datosProveedor['email'] ; ?></p>
                          </div>
                      </div>
                      </div>

                    

                      <div class="tab-pane fade" id="soportes" role="tabpanel" aria-labelledby="profile-tab4">
                      <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Soporte</th>
                            <th>Nombre Identificador</th>
                            <th>Razón Social</th>
                            <th>Rut Soporte</th>
                            <th>Medios</th>
                            <th>Teléfono/Celular</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($soportes as $soporte): ?>
                            <?php if ($soporte['id_proveedor'] == $datosProveedor['id_proveedor']): ?>
                            <tr>
                                <td><?php echo $soporte['id_soporte']; ?></td>
                                <td><?php echo $soporte['nombreIdentficiador']; ?></td>
                                <td><?php echo $soporte['razonSocial']; ?></td>
                                <td><?php echo $soporte['rut_soporte']; ?></td>
                                <td>
                                                                                                        <?php
                                                            // Paso 1: Obtener todos los id_medios para un id_proveedor específico
                                                            $id_soporte = $soporte['id_soporte'];

                                                            // Realiza la solicitud para obtener los datos de la tabla proveedor_medios

                                                            $id_medios_array = [];
                                                            foreach ($soporte_medios as $fila) {
                                                                if ($fila['id_soporte'] == $id_soporte) {
                                                                    $id_medios_array[] = $fila['id_medio'];
                                                                }
                                                            }                 

                                                            $medios_nombres = [];
                                                            foreach ($medios as $medio) {
                                                                if (in_array($medio['id'], $id_medios_array)) {
                                                                    $medios_nombres[] = $medio['NombredelMedio'];
                                                                }
                                                            }

                                                            if (!empty($medios_nombres)) {
                                                                $medios_list = implode("</li><li>", $medios_nombres);
                                                                $tooltip_content = "<ul><li>" . $medios_list . "</li></ul>";
                                                            } else {
                                                                $tooltip_content = ""; // Puedes dejarlo vacío o agregar un mensaje como "No hay medios disponibles"
                                                            }
                                                            
                                                            // Paso 3: Mostrar los nombres en una lista tipo tooltip
                                                            ?>   




                                                            <svg width="24" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo $tooltip_content; ?>" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="dist_marketing-btn-icon__AWP8I"><path fill-rule="evenodd" clip-rule="evenodd" d="M24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24C18.6274 24 24 18.6274 24 12ZM13.0033 22.3936C12.574 22.8778 12.2326 23 12 23C11.7674 23 11.426 22.8778 10.9967 22.3936C10.5683 21.9105 10.1369 21.1543 9.75435 20.1342C9.3566 19.0735 9.03245 17.7835 8.81337 16.3341C9.8819 16.1055 10.9934 15.9922 12.1138 16.0004C13.1578 16.0081 14.1912 16.1211 15.1866 16.3341C14.9675 17.7835 14.6434 19.0735 14.2457 20.1342C13.8631 21.1543 13.4317 21.9105 13.0033 22.3936ZM15.3174 15.3396C14.2782 15.1229 13.2039 15.0084 12.1211 15.0004C10.9572 14.9919 9.7999 15.1066 8.68263 15.3396C8.58137 14.4389 8.51961 13.4874 8.50396 12.5H15.496C15.4804 13.4875 15.4186 14.4389 15.3174 15.3396ZM16.1609 16.5779C15.736 19.3214 14.9407 21.5529 13.9411 22.8293C16.6214 22.3521 18.9658 20.9042 20.5978 18.862C19.6345 18.0597 18.4693 17.3939 17.1586 16.9062C16.8326 16.7849 16.4997 16.6754 16.1609 16.5779ZM21.1871 18.0517C20.1389 17.1891 18.8906 16.4837 17.5074 15.969C17.1122 15.822 16.708 15.6912 16.2967 15.5771C16.411 14.5992 16.4798 13.5676 16.4962 12.5H22.9888C22.8973 14.5456 22.2471 16.4458 21.1871 18.0517ZM7.70333 15.5771C7.58896 14.5992 7.52024 13.5676 7.50384 12.5H1.01116C1.10267 14.5456 1.75288 16.4458 2.81287 18.0517C3.91698 17.1431 5.24216 16.4096 6.71159 15.8895C7.0368 15.7744 7.3677 15.6702 7.70333 15.5771ZM3.40224 18.862C5.03424 20.9042 7.37862 22.3521 10.0589 22.8293C9.05934 21.5529 8.26398 19.3214 7.83906 16.5779C7.57069 16.6552 7.3059 16.74 7.04526 16.8322C5.65305 17.325 4.41634 18.0173 3.40224 18.862ZM15.496 11.5H8.50396C8.51961 10.5126 8.58136 9.56113 8.68263 8.66039C9.84251 8.90232 11.0448 9.01653 12.2521 8.99807C13.2906 8.9822 14.3202 8.86837 15.3174 8.66039C15.4186 9.56113 15.4804 10.5126 15.496 11.5ZM9.75435 3.86584C9.3566 4.9265 9.03245 6.21653 8.81337 7.66594C9.92191 7.90306 11.0758 8.01594 12.2369 7.99819C13.2391 7.98287 14.2304 7.87047 15.1866 7.66594C14.9675 6.21653 14.6434 4.9265 14.2457 3.86584C13.8631 2.84566 13.4317 2.08954 13.0033 1.60643C12.574 1.12215 12.2326 1 12 1C11.7674 1 11.426 1.12215 10.9967 1.60643C10.5683 2.08954 10.1369 2.84566 9.75435 3.86584ZM16.4962 11.5C16.4798 10.4324 16.411 9.40077 16.2967 8.42286C16.6839 8.31543 17.0648 8.19328 17.4378 8.05666C18.848 7.54016 20.1208 6.82586 21.1871 5.94826C22.2471 7.55418 22.8973 9.4544 22.9888 11.5H16.4962ZM17.0939 7.11766C18.4298 6.62836 19.6178 5.95419 20.5978 5.13796C18.9658 3.09584 16.6214 1.64793 13.9411 1.17072C14.9407 2.44711 15.736 4.67864 16.1609 7.42207C16.4773 7.33102 16.7886 7.22949 17.0939 7.11766ZM7.33412 7.26641C7.50092 7.32131 7.66929 7.37321 7.83905 7.42207C8.26398 4.67864 9.05934 2.44711 10.0589 1.17072C7.37862 1.64793 5.03423 3.09584 3.40224 5.13796C4.48835 6.04266 5.82734 6.77048 7.33412 7.26641ZM7.02148 8.21629C5.4308 7.69274 3.99599 6.92195 2.81287 5.94826C1.75288 7.55418 1.10267 9.4544 1.01116 11.5H7.50384C7.52024 10.4324 7.58896 9.40077 7.70333 8.42286C7.47376 8.35918 7.24638 8.29031 7.02148 8.21629Z" fill="currentColor"></path></svg>


                                                        </td>
                                <td><?php echo $soporte['telCelular']; ?></td>
                                <td>
                <!-- Acciones -->
                <a class="btn btn-primary micono" href="views/viewSoporte.php?id_soporte=<?php echo $soporte['id_soporte']; ?>" data-toggle="tooltip" title="Ver Soporte"><i class="fas fa-eye "></i></a>  
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#actualizarSoporte" data-id-soporte="<?php echo htmlspecialchars($soporte['id_soporte']); ?>" data-idproveedor="<?php echo $datosProveedor['id_proveedor']; ?>" onclick="loadProveedorDataSoporte(this)"><i class="fas fa-pencil-alt"></i></button>
                <a class="btn btn-danger micono" href="#" onclick="confirmarEliminacionSoporte(<?php echo htmlspecialchars($soporte['id_soporte']); ?>); return false;" data-toggle="tooltip" title="Eliminar Proveedor"><i class="fas fa-trash-alt "></i></a>
            </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
</div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-bs-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <script src="<?php echo $ruta; ?>assets/js/actualizarsoporte.js"></script>
<?php include '../componentes/settings.php'; ?>
<?php include '../componentes/footer.php'; ?>
