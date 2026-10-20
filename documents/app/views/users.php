<?php
	require_once __DIR__ . "/../core/bootstrap.php";
	requerir_login_pagina();
	requerir_admin_pagina();

	$pageTitle = "Usuarios";
	$usaTablas = true;

	require_once __DIR__ . "/../controllers/users/showRoleData.php";

	include "header.php";
	include "menu.php";
?>
		<div id="layoutSidenav_content">
			<main>
				<div class="container">
					<h2 class="mt-3 animate__animated animate__fadeInDown"><i class="fa-solid fa-users"></i> USUARIOS</h2>
					<div class="card border border-0 shadow animate__animated animate__fadeInUp">
						<div class="card-body">
							<div id="container_tableUsers"></div>
						</div>
					</div>
				</div>
			</main>
			<?php
				include "footer_page.php";
			?>
		</div>
<?php
		require_once "modals/users/addUserModal.php";
		require_once "modals/users/updateUserModal.php";
	include "footer.php";
?>
	
	<script src="functions/users/functionsUsers.js?v=<?php echo ASSET_VERSION;?>"></script>
	<script>
		showUserDataTable();
	</script>
