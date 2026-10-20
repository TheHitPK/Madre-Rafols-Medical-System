<?php
	require_once __DIR__ . "/../core/bootstrap.php";
	requerir_login_pagina();

	$pageTitle = "Historial de pacientes";
	$usaTablas = true;

	include "header.php";
	include "menu.php";
?>
		<div id="layoutSidenav_content">
			<main>
				<div class="container">
					<h2 class="mt-3 animate__animated animate__fadeInDown"><i class="fa-solid fa-hospital-user"></i> HISTORIAL DE PACIENTES</h2>
					<div class="card border border-0 shadow animate__animated animate__fadeInUp mb-3">
						<div class="card-body">
							<form id="buscarPacienteForm" onsubmit="return buscarHistorial()" class="row g-2 align-items-center">
								<div class="col-md-8">
									<input type="search" id="terminoPaciente" class="form-control" placeholder="Cédula completa o nombre / apellido del paciente" minlength="3" maxlength="60" autofocus required>
								</div>
								<div class="col-md-4 d-grid">
									<button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
								</div>
							</form>
							<div class="form-text">Muestra los ecocardiogramas, holters y MAPA del paciente juntos.</div>
						</div>
					</div>
					<div class="card border border-0 shadow animate__animated animate__fadeInUp">
						<div class="card-body">
							<div id="container_tablePacientes">
								<div class="text-muted text-center py-4"><i class="fa-solid fa-magnifying-glass fa-2x mb-2"></i><br>Busque un paciente para ver su historial.</div>
							</div>
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
	include "footer.php";
?>
	<script src="functions/pacientes/functionsPacientes.js?v=<?php echo ASSET_VERSION;?>"></script>
