<?php
	require_once __DIR__ . "/../core/bootstrap.php";
	requerir_login_pagina();

	$pageTitle = "Holters";
	$usaTablas = true;

	require_once __DIR__ . "/../controllers/c_costo/showC_costoData.php";
	require_once __DIR__ . "/../controllers/medicos/showMedicosData.php";

	include "header.php";
	include "menu.php";
?>
		<div id="layoutSidenav_content">
			<main id="contenido" tabindex="-1">
				<div class="container">
					<h1 class="h2 mt-3 animate__animated animate__fadeInDown"><i class="fa-solid fa-file-waveform" aria-hidden="true"></i> HOLTERS</h1>
					<div class="card border border-0 shadow animate__animated animate__fadeInUp">
						<div class="card-body">
							<div id="container_tableHolters"></div>
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
		require_once "modals/holters/addHolterModal.php";
		require_once "modals/holters/updateHolterModal.php";
		require_once "modals/holters/filterHolterModal.php";
	include "footer.php";
?>
	<script src="functions/holters/functionsHolters.js?v=<?php echo ASSET_VERSION;?>"></script>
	<script src="functions/pacientes/functionsPacientes.js?v=<?php echo ASSET_VERSION;?>"></script>
	<script>
		showHolterDataTable();
		activarAutocompletadoPaciente("holter");
	</script>
