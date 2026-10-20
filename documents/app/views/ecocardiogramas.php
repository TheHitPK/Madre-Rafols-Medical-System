<?php
	require_once __DIR__ . "/../core/bootstrap.php";
	requerir_login_pagina();
	requerir_area_pagina(AREA_CARDIOLOGIA);

	$pageTitle = "Ecocardiogramas";
	$usaTablas = true;

	require_once __DIR__ . "/../controllers/c_costo/showC_costoData.php";
	require_once __DIR__ . "/../controllers/medicos/showMedicosData.php";

	include "header.php";
	include "menu.php";
?>
		<div id="layoutSidenav_content">
			<main id="contenido" tabindex="-1">
				<div class="container">
					<h1 class="h2 mt-3 animate__animated animate__fadeInDown"><i class="fa-solid fa-heart-circle-check" aria-hidden="true"></i> ECOCARDIOGRAMAS</h1>
					<div class="card border border-0 shadow animate__animated animate__fadeInUp">
						<div class="card-body">
							<div id="container_tableEcos"></div>
						</div>
					</div>
				</div>
			</main>
			<div class="mt-4">
				<?php
					include "footer_page.php";
				?>
			</div>
		</div>
<?php
		require_once "modals/ecos/addEcoModal.php";
		require_once "modals/ecos/updateEcoModal.php";
		require_once "modals/ecos/filterEcoModal.php";
	include "footer.php";
?>
	<script src="functions/ecos/functionsEcos.js?v=<?php echo ASSET_VERSION;?>"></script>
	<script src="functions/pacientes/functionsPacientes.js?v=<?php echo ASSET_VERSION;?>"></script>
	<script>
		showEcoDataTable();
		activarAutocompletadoPaciente("eco");
	</script>
