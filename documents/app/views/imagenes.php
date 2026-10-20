<?php
	require_once __DIR__ . "/../core/bootstrap.php";
	requerir_login_pagina();
	requerir_area_pagina(AREA_IMAGENES);

	$pageTitle = "Estudios de imágenes";
	$usaTablas = true;

	require_once __DIR__ . "/../controllers/c_costo/showC_costoData.php";
	require_once __DIR__ . "/../controllers/medicos/showMedicosData.php";
	require_once __DIR__ . "/../controllers/tipos_estudio/showTiposEstudioData.php";

	include "header.php";
	include "menu.php";
?>
		<div id="layoutSidenav_content">
			<main id="contenido" tabindex="-1">
				<div class="container">
					<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3 mb-2">
						<h1 class="h2 mb-0 animate__animated animate__fadeInDown"><i class="fa-solid fa-x-ray" aria-hidden="true"></i> ESTUDIOS DE IMÁGENES</h1>
						<button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTiposEstudio" aria-controls="offcanvasTiposEstudio">
							<i class="fa-solid fa-list" aria-hidden="true"></i> Tipos de estudio
						</button>
					</div>
					<div class="card border border-0 shadow animate__animated animate__fadeInUp">
						<div class="card-body">
							<div id="container_tableImagenes"></div>
						</div>
					</div>
				</div>
			</main>
			<div class="mt-4">
				<?php
					include "footer_page.php";
				?>
			</div>

			<div class="offcanvas offcanvas-end text-light" tabindex="-1" id="offcanvasTiposEstudio" aria-labelledby="offcanvasTiposEstudioLabel" style="background-color: #001d3d;">
				<div class="offcanvas-header">
					<h2 class="offcanvas-title h5" id="offcanvasTiposEstudioLabel"><i class="fa-solid fa-list" aria-hidden="true"></i> TIPOS DE ESTUDIO</h2>
					<button type="button" class="btn btn-sm text-light" data-bs-dismiss="offcanvas" aria-label="Cerrar" style="font-size: 30px;">
						<i class="fa-solid fa-xmark" aria-hidden="true"></i>
					</button>
				</div>
				<div class="offcanvas-body">
					<button type="button" class="btn btn-primary mb-4 shadow" data-bs-toggle="modal" data-bs-target="#addTipoEstudioModal">
						<i class="fa-solid fa-plus" aria-hidden="true"></i> Nuevo tipo de estudio
					</button>
					<p class="small" style="color: #d3dee9;">El número indica cuántos estudios hay registrados de cada tipo.</p>
					<div id="container_tableTiposEstudio"></div>
				</div>
			</div>
		</div>
<?php
		require_once "modals/imagenes/addImagenModal.php";
		require_once "modals/imagenes/updateImagenModal.php";
		require_once "modals/imagenes/filterImagenModal.php";
		require_once "modals/tipos_estudio/addTipoEstudioModal.php";
		require_once "modals/tipos_estudio/updateTipoEstudioModal.php";
	include "footer.php";
?>
	<script src="functions/imagenes/functionsImagenes.js?v=<?php echo ASSET_VERSION;?>"></script>
	<script src="functions/tipos_estudio/functionsTiposEstudio.js?v=<?php echo ASSET_VERSION;?>"></script>
	<script src="functions/pacientes/functionsPacientes.js?v=<?php echo ASSET_VERSION;?>"></script>
	<script>
		showImagenDataTable();
		showTiposEstudioDataTable();
		activarAutocompletadoPaciente("imagen");
	</script>
