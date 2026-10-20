<?php
	require_once __DIR__ . "/../core/bootstrap.php";
	requerir_login_pagina();
	requerir_admin_pagina();

	$pageTitle = "Auditoría";
	$usaTablas = true;

	include "header.php";
	include "menu.php";
?>
		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid px-4">
					<h2 class="mt-3 animate__animated animate__fadeInDown"><i class="fa-solid fa-clipboard-list"></i> AUDITORÍA</h2>
					<p class="text-muted mb-3">Quién creó, editó o eliminó cada registro, y los inicios de sesión. Los estudios eliminados se pueden restaurar desde aquí. Se muestran los últimos 2000 movimientos.</p>
					<div class="card border border-0 shadow animate__animated animate__fadeInUp">
						<div class="card-body">
							<div id="container_tableAuditoria"></div>
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
	<script src="functions/auditoria/functionsAuditoria.js?v=<?php echo ASSET_VERSION;?>"></script>
	<script>
		showAuditoriaTable();
	</script>
