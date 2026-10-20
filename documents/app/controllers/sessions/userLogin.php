<?php
	require_once __DIR__ . "/../../core/bootstrap.php";
	require_once __DIR__ . "/../../models/UsersModel.php";
	require_once __DIR__ . "/../../core/auditoria.php";

	requerir_post();

	// Respuestas: "Activo" = acceso concedido, "Inactivo" = usuario deshabilitado,
	//             "Bloqueado" = demasiados intentos fallidos, "0" = credenciales incorrectas
	if (login_bloqueado()) {
		auditar('login_bloqueado', 'sesion', null, "Intento con equipo bloqueado: " . post_texto('usuario', 20), null, null, array('idUsuario' => null, 'usuario' => post_texto('usuario', 20)));
		responder("Bloqueado");
	}

	$usuario  = post_texto('usuario', 20);
	$password = isset($_POST['password']) ? (string)$_POST['password'] : '';

	$Users = new Users();
	$userLogin = ($usuario !== '' && $password !== '') ? $Users -> userLogin($usuario, $password) : false;

	if (!$userLogin) {
		registrar_fallo_login();
		auditar('login_fallido', 'sesion', null, "Usuario o contraseña incorrectos: " . $usuario, null, null, array('idUsuario' => null, 'usuario' => $usuario));
		responder("0");
	}

	limpiar_fallos_login();

	// Un usuario inactivo NO recibe sesión.
	if ((int)$userLogin['idEstado'] !== ESTADO_ACTIVO) {
		auditar('login_inactivo', 'sesion', (int)$userLogin['idUsuario'], "Usuario inactivo intentó entrar: " . $userLogin['usuario'], null, null, $userLogin);
		responder("Inactivo");
	}

	iniciar_sesion();
	abrir_sesion_usuario($userLogin);
	auditar('login', 'sesion', (int)$userLogin['idUsuario'], "Inicio de sesión: " . $userLogin['usuario']);
	echo "Activo";
?>
