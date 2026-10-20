<?php
	require_once __DIR__ . "/../../core/bootstrap.php";

	// El cierre de sesión llega por POST con el token CSRF (formulario del menú),
	// así otra página no puede cerrar la sesión del usuario con un simple enlace.
	requerir_post();
	iniciar_sesion();
	verificar_csrf();
	cerrar_sesion();

	header("Location: ../../../../index.php");
	exit;
?>
