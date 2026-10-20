// ---------- TIPOS DE ESTUDIO (catálogo del área de Imágenes) ----------

function addTipoEstudioData(){
	$.ajax({
		type:"POST",
		url:"../controllers/tipos_estudio/addTipoEstudioData.php",
		data: $('#addTipoEstudioForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Tipo de estudio agregado correctamente.",
				2: "Ese tipo de estudio ya está registrado.",
				0: "El tipo de estudio no pudo agregarse, contacte al administrador."
			});
			if (ok) {
				$('#addTipoEstudioForm')[0].reset();
				actualizarTiposEstudio();
			}
		}
	});
	return false;
}

function obtainTipoEstudioData(idTipoEstudio) {
	$.ajax({
		type:"POST",
		url:"../controllers/tipos_estudio/obtainTipoEstudioData.php",
		data: { idTipoEstudio: idTipoEstudio },
		dataType: "json",
		success:function(r){
			if (!r) {
				return;
			}
			$('#idTipoEstudio_editar').val(r['idTipoEstudio']);
			$('#tipo_estudio_update').val(r['tipo_estudio']);
		}
	});
}

function updateTipoEstudioData() {
	$.ajax({
		type:"POST",
		url:"../controllers/tipos_estudio/updateTipoEstudioData.php",
		data: $('#updateTipoEstudioForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Tipo de estudio actualizado correctamente.",
				2: "Ya existe otro tipo de estudio con ese nombre.",
				0: "El tipo de estudio no pudo actualizarse, contacte al administrador."
			});
			if (ok) {
				actualizarTiposEstudio();
				if (typeof showImagenDataTable === 'function' && $('#container_tableImagenes').length) {
					showImagenDataTable(); // el nombre nuevo aparece en la tabla de estudios
				}
			}
		}
	});
	return false;
}

function deleteTipoEstudioData(idTipoEstudio){
	confirmarEliminacion("¿Realmente desea eliminar este tipo de estudio?").then(function(willDelete) {
		if (!willDelete) {
			return;
		}
		$.ajax({
			type:"POST",
			url:"../controllers/tipos_estudio/deleteTipoEstudioData.php",
			data: { idTipoEstudio: idTipoEstudio },
			success:function(r){
				var ok = mostrarResultado(r, {
					1: "El tipo de estudio ha sido eliminado correctamente.",
					3: "No se puede eliminar: hay estudios registrados con este tipo (incluidos los que están en la papelera). Puede cambiarle el nombre.",
					0: "El tipo de estudio no pudo eliminarse, contacte al administrador."
				});
				if (ok) {
					actualizarTiposEstudio();
				}
			}
		});
	});
}

function showTiposEstudioDataTable(){
	$(function(){
		cargarFragmento('#container_tableTiposEstudio', 'tables/tipos_estudio/tableTiposEstudio.php');
	});
}

function countTiposEstudioData(){
	$(function(){
		cargarFragmento('#container_countTiposEstudio', 'elements/tipos_estudio/countTiposEstudio.php');
	});
}

// Lista, contador y los <select> de los formularios de estudios (conservando lo que estaba elegido).
function actualizarTiposEstudio(){
	showTiposEstudioDataTable();
	countTiposEstudioData();
	var $selects = $('.select-tipo-estudio');
	if (!$selects.length) {
		return;
	}
	$.get('elements/tipos_estudio/opcionesTiposEstudio.php', function(opciones){
		$selects.each(function(){
			var elegido = $(this).val();
			$(this).html(opciones).val(elegido);
		});
	});
}
