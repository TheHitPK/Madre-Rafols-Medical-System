function addMapaData(){
	$.ajax({
		type:"POST",
		url:"../controllers/mapas/addMapaData.php",
		data: $('#addMapaForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Registro agregado correctamente.",
				2: "Esta factura ya se encuentra registrada para este paciente.",
				0: "El registro no pudo agregarse, contacte al administrador."
			});
			if (ok) {
				$('#addMapaForm')[0].reset();
				showMapaDataTable();
			}
		}
	});
	return false;
}

function obtainMapaData(idMapa) {
	$('#info_registro_mapa').empty();
	$.ajax({
		type:"POST",
		url:"../controllers/mapas/obtainMapaData.php",
		data: { idMapa: idMapa },
		dataType: "json",
		success:function(r){
			if (!r) {
				return;
			}
			$('#idMapa').val(r['idMapa']);
			$('#idC_costo_update').val(r['idC_costo']);
			$('#idMedico_update').val(r['idMedico']);
			$('#factura_mapa_update').val(r['factura_mapa']);
			$('#fecha_mapa_update').val(r['fecha_mapa']);
			$('#nombre_paciente_mapa_update').val(r['nombre_paciente_mapa']);
			$('#apellido_paciente_mapa_update').val(r['apellido_paciente_mapa']);
			$('#cedula_paciente_mapa_update').val(r['cedula_paciente_mapa']);
			$('#n_historia_paciente_mapa_update').val(r['n_historia_paciente_mapa']);
			mostrarInfoRegistro('#info_registro_mapa', r);
		}
	});
}

function updateMapaData() {
	$.ajax({
		type:"POST",
		url:"../controllers/mapas/updateMapaData.php",
		data: $('#updateMapaForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Registro actualizado correctamente.",
				2: "Esta factura ya se encuentra registrada para este paciente.",
				0: "El registro no pudo actualizarse, contacte al administrador."
			});
			if (ok) {
				showMapaDataTable();
			}
		}
	});
	return false;
}

function showMapaDataTable(){
	$(function(){
		cargarFragmento('#container_tableMapas', 'tables/mapas/tableMapas.php', 'tableMapas');
	});
}

function countMapasData(){
	$(function(){
		cargarFragmento('#container_countMapas', 'elements/mapas/countMapas.php');
	});
}

function deleteMapaData(idMapa){
	confirmarEliminacion("¿Realmente desea eliminar este registro? Un administrador podrá restaurarlo desde Auditoría.").then(function(willDelete) {
		if (!willDelete) {
			return;
		}
		$.ajax({
			type:"POST",
			url:"../controllers/mapas/deleteMapaData.php",
			data: { idMapa: idMapa },
			success:function(r){
				var ok = mostrarResultado(r, {
					1: "El registro ha sido eliminado correctamente.",
					0: "El registro no pudo eliminarse, contacte al administrador."
				});
				if (ok) {
					showMapaDataTable();
				}
			}
		});
	});
}
