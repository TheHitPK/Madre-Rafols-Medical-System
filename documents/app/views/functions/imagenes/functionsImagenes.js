// ---------- ESTUDIOS DE IMÁGENES ----------
// Los formularios se envían con FormData (no serialize) porque pueden llevar el informe médico.

var MENSAJES_INFORME = {
	5: "El informe debe ser un archivo PDF o Word (.doc, .docx) y no superar el tamaño máximo indicado.",
	6: "Los datos del estudio se guardaron, pero el informe no pudo guardarse. Intente adjuntarlo de nuevo desde Editar o contacte al administrador."
};

function enviarFormularioImagen(formulario, url, mensajes, alTerminar) {
	$.ajax({
		type: "POST",
		url: url,
		data: new FormData(formulario),
		processData: false,
		contentType: false,
		success: function(r){
			var ok = mostrarResultado(r, $.extend({}, MENSAJES_INFORME, mensajes));
			// 6: el estudio sí se guardó, así que la tabla se actualiza igual.
			if (ok || String(r).trim() === "6") {
				alTerminar();
			}
		}
	});
	return false;
}

function addImagenData(){
	var formulario = $('#addImagenForm')[0];
	return enviarFormularioImagen(formulario, "../controllers/imagenes/addImagenData.php", {
		1: "Estudio agregado correctamente.",
		2: "Esta factura ya se encuentra registrada para este paciente.",
		0: "El estudio no pudo agregarse, contacte al administrador."
	}, function(){
		formulario.reset();
		showImagenDataTable();
	});
}

function obtainImagenData(idImagen) {
	$('#info_registro_imagen').empty();
	$('#informe_actual_imagen').empty();
	$('#informe_update').val('');
	$.ajax({
		type:"POST",
		url:"../controllers/imagenes/obtainImagenData.php",
		data: { idImagen: idImagen },
		dataType: "json",
		success:function(r){
			if (!r) {
				return;
			}
			$('#idImagen').val(r['idImagen']);
			$('#idTipoEstudio_update').val(r['idTipoEstudio']);
			$('#idC_costo_update').val(r['idC_costo']);
			$('#idMedico_update').val(r['idMedico']);
			$('#factura_imagen_update').val(r['factura_imagen']);
			$('#fecha_imagen_update').val(r['fecha_imagen']);
			$('#nombre_paciente_imagen_update').val(r['nombre_paciente_imagen']);
			$('#apellido_paciente_imagen_update').val(r['apellido_paciente_imagen']);
			$('#cedula_paciente_imagen_update').val(r['cedula_paciente_imagen']);
			$('#n_historia_paciente_imagen_update').val(parseInt(r['n_historia_paciente_imagen'], 10) > 0 ? r['n_historia_paciente_imagen'] : '');
			mostrarInformeActual(r);
			mostrarInfoRegistro('#info_registro_imagen', r);
		}
	});
}

// Informe actual en el formulario de edición: enlace para verlo y casilla para quitarlo.
function mostrarInformeActual(r) {
	var $caja = $('#informe_actual_imagen');
	if (!r['informe_archivo']) {
		$caja.html('<span class="form-text">Este estudio no tiene informe médico.</span>');
		return;
	}
	var $enlace = $('<a target="_blank" rel="noopener"></a>')
		.attr('href', '../controllers/imagenes/verInforme.php?id=' + r['idImagen'])
		.append('<i class="fa-solid fa-file-lines" aria-hidden="true"></i> ')
		.append(document.createTextNode(r['informe_nombre']));
	var $quitar = $('<div class="form-check mt-1">'
		+ '<input class="form-check-input" type="checkbox" name="quitar_informe" value="1" id="quitar_informe">'
		+ '<label class="form-check-label" for="quitar_informe">Quitar el informe actual</label></div>');
	$caja.empty().append($('<div>').append('Informe actual: ').append($enlace)).append($quitar);
}

function updateImagenData() {
	return enviarFormularioImagen($('#updateImagenForm')[0], "../controllers/imagenes/updateImagenData.php", {
		1: "Estudio actualizado correctamente.",
		2: "Esta factura ya se encuentra registrada para este paciente.",
		0: "El estudio no pudo actualizarse, contacte al administrador."
	}, function(){
		bootstrap.Modal.getOrCreateInstance(document.getElementById('updateImagenModal')).hide();
		showImagenDataTable();
	});
}

function showImagenDataTable(){
	$(function(){
		cargarFragmento('#container_tableImagenes', 'tables/imagenes/tableImagenes.php', 'tableImagenes');
	});
}

function countImagenesData(){
	$(function(){
		cargarFragmento('#container_countImagenes', 'elements/imagenes/countImagenes.php');
	});
}

function deleteImagenData(idImagen){
	confirmarEliminacion("¿Realmente desea eliminar este estudio? Un administrador podrá restaurarlo desde Auditoría.").then(function(willDelete) {
		if (!willDelete) {
			return;
		}
		$.ajax({
			type:"POST",
			url:"../controllers/imagenes/deleteImagenData.php",
			data: { idImagen: idImagen },
			success:function(r){
				var ok = mostrarResultado(r, {
					1: "El estudio ha sido eliminado correctamente.",
					0: "El estudio no pudo eliminarse, contacte al administrador."
				});
				if (ok) {
					showImagenDataTable();
				}
			}
		});
	});
}
