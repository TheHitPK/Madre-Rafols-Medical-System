function addUserData(){
	$.ajax({
		type:"POST",
		url:"../controllers/users/addUserData.php",
		data: $('#addUserForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Usuario agregado correctamente.",
				2: "Ya existe un usuario con esa cédula o ese nombre de usuario.",
				3: "La contraseña debe tener al menos 6 caracteres.",
				0: "El usuario no pudo agregarse, contacte al administrador."
			});
			if (ok) {
				$('#addUserForm')[0].reset();
				showUserDataTable();
				countUsersData();
				countUsersRolData();
			}
		}
	});
	return false;
}

function updateUserData() {
	$.ajax({
		type:"POST",
		url:"../controllers/users/updateUserData.php",
		data: $('#updateUserForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Usuario actualizado correctamente.",
				2: "Ya existe otro usuario con esa cédula o ese nombre de usuario.",
				3: "La nueva contraseña debe tener al menos 6 caracteres.",
				0: "El usuario no pudo actualizarse, contacte al administrador."
			});
			if (ok) {
				$('#password_update').val('');
				showUserDataTable();
			}
		}
	});
	return false;
}

function showUserDataTable(){
	$(function(){
		cargarFragmento('#container_tableUsers', 'tables/users/tableUsers.php', 'tableUsers');
	});
}

function countUsersData(){
	$(function(){
		cargarFragmento('#container_countUsers', 'elements/users/countUsers.php');
	});
}

function countUsersRolData(){
	$(function(){
		cargarFragmento('#container_tableUsersRol', 'elements/users/countUsersRol.php');
	});
}

function obtainUserData(idUsuario) {
	$('#password_update').val('');
	$.ajax({
		type:"POST",
		url:"../controllers/users/obtainUserData.php",
		data: { idUsuario: idUsuario },
		dataType: "json",
		success:function(r){
			if (!r) {
				return;
			}
			$('#idUsuario').val(r['idUsuario']);
			$('#nombre_usuario_update').val(r['nombre_usuario']);
			$('#apellido_usuario_update').val(r['apellido_usuario']);
			$('#cedula_usuario_update').val(r['cedula_usuario']);
			$('#usuario_update').val(r['usuario']);
			$('#idRol_update').val(r['idRol']);
		}
	});
}

function deleteUserData(idUsuario){
	confirmarEliminacion("¿Realmente desea eliminar este usuario?").then(function(willDelete) {
		if (!willDelete) {
			return;
		}
		$.ajax({
			type:"POST",
			url:"../controllers/users/deleteUserData.php",
			data: { idUsuario: idUsuario },
			success:function(r){
				var ok = mostrarResultado(r, {
					1: "El usuario ha sido eliminado correctamente.",
					0: "El usuario no pudo eliminarse, contacte al administrador."
				});
				if (ok) {
					showUserDataTable();
					countUsersData();
					countUsersRolData();
				}
			}
		});
	});
}

function changeUserStatus(idUsuario){
	swal({
		icon: "warning",
		title: "¡ATENCIÓN!",
		text: "¿Realmente desea cambiar el estado de este usuario?",
		buttons: ["Cancelar", "Cambiar"],
		dangerMode: true
	})
	.then(function(willChange) {
		if (!willChange) {
			return;
		}
		$.ajax({
			type:"POST",
			url:"../controllers/users/statusUserData.php",
			data: { idUsuario: idUsuario },
			success:function(r){
				r = String(r).trim();
				if (r === "1" || r === "2") {
					showUserDataTable();
					swal({
						icon: "success",
						title: "¡ÉXITO!",
						text: "El estado del usuario ha sido cambiado correctamente."
					});
				} else {
					swal({
						icon: "error",
						title: "¡ERROR!",
						text: "El estado no se modificó, contacte al administrador."
					});
				}
			}
		});
	});
}
