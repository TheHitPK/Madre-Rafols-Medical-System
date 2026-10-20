<?php
	require_once __DIR__ . "/../core/bootstrap.php";
	requerir_login_pagina();

	$pageTitle = "Inicio";

	include "header.php";
	include "menu.php";
?>
        <div id="layoutSidenav_content">
            <main id="contenido" tabindex="-1">
                <div class="container-fluid px-4">
                    <?php if (nombre_sistema() === 'Imágenes') { ?>
                    <h1 class="mt-2 mb-3 animate__animated animate__fadeInDown"><i class="fa-solid fa-x-ray" aria-hidden="true"></i> IMÁGENES</h1>
                    <?php } else { ?>
                    <h1 class="mt-2 mb-3 animate__animated animate__fadeInDown"><i class="fa-solid fa-heart-pulse" aria-hidden="true"></i> CARDIOLOGÍA</h1>
                    <?php } ?>

                    <?php
                        if (es_admin()) {
                    ?>
                            <div class="row animate__animated animate__slideInRight">
                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-primary text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>ECOS REALIZADOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <!--<img src="../../assets/img/eco.png" width="70" height="70">-->
                                                    <span class="fa-solid fa-heart-circle-check fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countEcos"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="ecocardiogramas.php">Ver detalles<span class="visually-hidden"> de ecocardiogramas</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-success text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>HOLTERS REALIZADOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-file-waveform fa-4x" aria-hidden="true"></span>
                                                    <!--<img src="../../assets/img/holter.png" width="90" height="70">-->
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countHolters"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="holters.php">Ver detalles<span class="visually-hidden"> de holters</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-warning text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>MAPAS REALIZADOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-stethoscope fa-4x" aria-hidden="true"></span>
                                                    <!--<img src="../../assets/img/mapa.png" width="70" height="70">-->
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countMapas"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="mapas.php">Ver detalles<span class="visually-hidden"> de MAPA</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row animate__animated animate__slideInLeft">
                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-secondary text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>ESTUDIOS DE IMÁGENES</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-x-ray fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countImagenes"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="imagenes.php">Ver detalles<span class="visually-hidden"> de estudios de imágenes</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-dark text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>TIPOS DE ESTUDIO</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-list fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countTiposEstudio"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="imagenes.php">Ver detalles<span class="visually-hidden"> de tipos de estudio</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row animate__animated animate__slideInRight">
                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-light text-dark mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>CENTROS DE COSTO</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-hospital fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countC_costo"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-light card-footer d-flex align-items-center justify-content-between" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightC_costo" aria-controls="offcanvasRightC_costo">
                                            <span class="small text-dark">Ver detalles<span class="visually-hidden"> de centros de costo</span></span>
                                            <div class="small text-dark">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-info text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>MÉDICOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-user-doctor fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countMedicos"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-info card-footer d-flex align-items-center justify-content-between" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightMedicos" aria-controls="offcanvasRightMedicos">
                                            <span class="small text-white">Ver detalles<span class="visually-hidden"> de médicos</span></span>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-4">
                                    <div class="card bg-danger text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>USUARIOS REGISTRADOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-users fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countUsers"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger card-footer d-flex align-items-center justify-content-between" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightUsers" aria-controls="offcanvasRightUsers">
                                            <span class="small text-white">Ver detalles<span class="visually-hidden"> de usuarios</span></span>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>        
                    <?php
                        } elseif (area_usuario() === AREA_CARDIOLOGIA) {
                    ?>
                            <div class="row animate__animated animate__slideInRight">
                                <div class="col-xl-6 col-md-6">
                                    <div class="card bg-primary text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>ECOS REALIZADOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <!--<img src="../../assets/img/eco.png" width="70" height="70">-->
                                                    <span class="fa-solid fa-heart-circle-check fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countEcos"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="ecocardiogramas.php">Ver detalles<span class="visually-hidden"> de ecocardiogramas</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-md-6">
                                    <div class="card bg-success text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>HOLTERS REALIZADOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-file-waveform fa-4x" aria-hidden="true"></span>
                                                    <!--<img src="../../assets/img/holter.png" width="90" height="70">-->
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countHolters"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="holters.php">Ver detalles<span class="visually-hidden"> de holters</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row animate__animated animate__slideInLeft">
                                <div class="col-xl-6 col-md-6">
                                    <div class="card bg-warning text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>MAPAS REALIZADOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-stethoscope fa-4x" aria-hidden="true"></span>
                                                    <!--<img src="../../assets/img/mapa.png" width="70" height="70">-->
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countMapas"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="mapas.php">Ver detalles<span class="visually-hidden"> de MAPA</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="card bg-info text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>MÉDICOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-user-doctor fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countMedicos"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-info card-footer d-flex align-items-center justify-content-between" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightMedicos" aria-controls="offcanvasRightMedicos">
                                            <span class="small text-white">Ver detalles<span class="visually-hidden"> de médicos</span></span>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <?php
                        } else {
                    ?>
                            <div class="row animate__animated animate__slideInRight">
                                <div class="col-xl-6 col-md-6">
                                    <div class="card bg-secondary text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>ESTUDIOS DE IMÁGENES</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-x-ray fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countImagenes"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="imagenes.php">Ver detalles<span class="visually-hidden"> de estudios de imágenes</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="card bg-dark text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>TIPOS DE ESTUDIO</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-list fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countTiposEstudio"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="imagenes.php">Ver detalles<span class="visually-hidden"> de tipos de estudio</span></a>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row animate__animated animate__slideInLeft">
                                <div class="col-xl-6 col-md-6">
                                    <div class="card bg-info text-light mb-4 shadow">
                                        <div class="card-header">
                                            <div class="class-title">
                                                <strong>MÉDICOS</strong>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mt-2">
                                                <div class="d-flex" style="align-items: center;">
                                                    <span class="fa-solid fa-user-doctor fa-4x" aria-hidden="true"></span>
                                                </div>
                                                <div class="d-flex" style="align-items: center;">
                                                    <p class="display-4 mb-0">
                                                        <span id="container_countMedicos"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-info card-footer d-flex align-items-center justify-content-between" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightMedicos" aria-controls="offcanvasRightMedicos">
                                            <span class="small text-white">Ver detalles<span class="visually-hidden"> de médicos</span></span>
                                            <div class="small text-white">
                                                <i class="fas fa-angle-right" aria-hidden="true"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </main>
            <?php
                include "footer_page.php";
            ?>

            <?php if (es_admin()) { ?>
            <div class="offcanvas offcanvas-end text-light" tabindex="-1" id="offcanvasRightC_costo" aria-labelledby="offcanvasRightC_costoLabel" style="background-color: #001d3d;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightC_costoLabel"><i class="fa-solid fa-hospital" aria-hidden="true"></i> CENTROS DE COSTO</h5>
                    <button type="button" class="btn btn-sm text-light" data-bs-dismiss="offcanvas" aria-label="Cerrar" style="font-size: 30px;">
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <button type="button" class="btn btn-primary mb-4 shadow" data-bs-toggle="modal" data-bs-target="#addC_costoModal">
						<i class="fa-solid fa-hospital" aria-hidden="true"></i> Nuevo centro de costo
					</button>
                    
                    <div id="container_tableC_costo"></div>
                </div>
            </div>
            <?php } ?>

            <div class="offcanvas offcanvas-end text-light" tabindex="-1" id="offcanvasRightMedicos" aria-labelledby="offcanvasRightMedicosLabel" style="background-color: #001d3d;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightMedicosLabel"><i class="fa-solid fa-user-doctor" aria-hidden="true"></i> MÉDICOS</h5>
                    <button type="button" class="btn btn-sm text-light" data-bs-dismiss="offcanvas" aria-label="Cerrar" style="font-size: 30px;">
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <button type="button" class="btn btn-primary mb-4 shadow" data-bs-toggle="modal" data-bs-target="#addMedicoModal">
						<i class="fa-solid fa-user-doctor" aria-hidden="true"></i> Nuevo médico
					</button>

                    <div id="container_tableMedicos"></div>
                </div>
            </div>

            <?php if (es_admin()) { ?>
            <div class="offcanvas offcanvas-end text-light" tabindex="-1" id="offcanvasRightUsers" aria-labelledby="offcanvasRightUsersLabel" style="background-color: #001d3d;">
                <div class="offcanvas-header">
                    <a href="users.php" class="text-light" style="text-decoration: none;"><h5 class="offcanvas-title" id="offcanvasRightUsersLabel"><i class="fa-solid fa-users" aria-hidden="true"></i> USUARIOS</h5></a>
                    <button type="button" class="btn btn-sm text-light" data-bs-dismiss="offcanvas" aria-label="Cerrar" style="font-size: 30px;">
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <div id="container_tableUsersRol"></div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
<?php
    include "modals/medicos/addMedicoModal.php";
    include "modals/medicos/updateMedicoModal.php";

    if (es_admin()) {
        include "modals/c_costo/addC_costoModal.php";
        include "modals/c_costo/updateC_costoModal.php";
    }
    
    include "footer.php";
?>

<script src="functions/ecos/functionsEcos.js?v=<?php echo ASSET_VERSION;?>"></script>
<script src="functions/holters/functionsHolters.js?v=<?php echo ASSET_VERSION;?>"></script>
<script src="functions/mapas/functionsMapas.js?v=<?php echo ASSET_VERSION;?>"></script>

<script src="functions/c_costo/functionsC_costo.js?v=<?php echo ASSET_VERSION;?>"></script>
<script src="functions/medicos/functionsMedicos.js?v=<?php echo ASSET_VERSION;?>"></script>
<script src="functions/users/functionsUsers.js?v=<?php echo ASSET_VERSION;?>"></script>
<script src="functions/imagenes/functionsImagenes.js?v=<?php echo ASSET_VERSION;?>"></script>
<script src="functions/tipos_estudio/functionsTiposEstudio.js?v=<?php echo ASSET_VERSION;?>"></script>
<script>
<?php if (puede_ver_area(AREA_CARDIOLOGIA)) { ?>
    countEcosData();
    countHoltersData();
    countMapasData();
<?php } ?>
<?php if (puede_ver_area(AREA_IMAGENES)) { ?>
    countImagenesData();
    countTiposEstudioData();
<?php } ?>
    showMedicosDataTable();
    countMedicosData();
<?php if (es_admin()) { ?>
    showC_costoDataTable();
    countC_costoData();
    countUsersData();
    countUsersRolData();
<?php } ?>
</script>
