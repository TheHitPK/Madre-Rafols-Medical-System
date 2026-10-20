function addEcoData(){
	$.ajax({
		type:"POST",
		url:"../controllers/ecos/addEcoData.php",
		data: $('#addEcoForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Registro agregado correctamente.",
				2: "Esta factura ya se encuentra registrada para este paciente.",
				0: "El registro no pudo agregarse, contacte al administrador."
			});
			if (ok) {
				$('#addEcoForm')[0].reset();
				showEcoDataTable();
			}
		}
	});
	return false;
}

function obtainEcoData(idEco) {
	$('#info_registro_eco').empty();
	$.ajax({
		type:"POST",
		url:"../controllers/ecos/obtainEcoData.php",
		data: { idEco: idEco },
		dataType: "json",
		success:function(r){
			if (!r) {
				return;
			}
			$('#idEco').val(r['idEco']);
			$('#idC_costo_update').val(r['idC_costo']);
			$('#idMedico_update').val(r['idMedico']);
			$('#factura_eco_update').val(r['factura_eco']);
			$('#fecha_eco_update').val(r['fecha_eco']);
			$('#nombre_paciente_eco_update').val(r['nombre_paciente_eco']);
			$('#apellido_paciente_eco_update').val(r['apellido_paciente_eco']);
			$('#cedula_paciente_eco_update').val(r['cedula_paciente_eco']);
			$('#n_historia_paciente_eco_update').val(r['n_historia_paciente_eco']);
			mostrarInfoRegistro('#info_registro_eco', r);
		}
	});
}

function updateEcoData() {
	$.ajax({
		type:"POST",
		url:"../controllers/ecos/updateEcoData.php",
		data: $('#updateEcoForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Registro actualizado correctamente.",
				2: "Esta factura ya se encuentra registrada para este paciente.",
				0: "El registro no pudo actualizarse, contacte al administrador."
			});
			if (ok) {
				showEcoDataTable();
			}
		}
	});
	return false;
}

function showEcoDataTable(){
	$(function(){
		cargarFragmento('#container_tableEcos', 'tables/ecos/tableEcos.php', 'tableEcos');
	});
}

function countEcosData(){
	$(function(){
		cargarFragmento('#container_countEcos', 'elements/ecos/countEcos.php');
	});
}

function deleteEcoData(idEco){
	confirmarEliminacion("¿Realmente desea eliminar este registro? Un administrador podrá restaurarlo desde Auditoría.").then(function(willDelete) {
		if (!willDelete) {
			return;
		}
		$.ajax({
			type:"POST",
			url:"../controllers/ecos/deleteEcoData.php",
			data: { idEco: idEco },
			success:function(r){
				var ok = mostrarResultado(r, {
					1: "El registro ha sido eliminado correctamente.",
					0: "El registro no pudo eliminarse, contacte al administrador."
				});
				if (ok) {
					showEcoDataTable();
				}
			}
		});
	});
}
