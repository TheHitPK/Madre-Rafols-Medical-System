<?php
	require_once __DIR__ . "/../core/bootstrap.php";
	requerir_login_pagina();

	$pageTitle = "Acceso denegado";

	include "header.php";
	include "menu.php";
?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mt-4 animate__animated animate__fadeInUp">
                            <h1 class="display-1 text-danger"><i class="fa-solid fa-ban"></i></h1>
                            <p class="lead">¡ATENCIÓN!</p>
                            <p>Usted no posee acceso a éste módulo.</p>
                            <a href="home.php">
                                <i class="fas fa-arrow-left me-1"></i>
                                Regresar al Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
            include "footer_page.php";
        ?>
    </div>
<?php
    include "footer.php";
?>
