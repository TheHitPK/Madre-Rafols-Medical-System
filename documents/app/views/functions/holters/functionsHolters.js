function addHolterData(){
	$.ajax({
		type:"POST",
		url:"../controllers/holters/addHolterData.php",
		data: $('#addHolterForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Registro agregado correctamente.",
				2: "Esta factura ya se encuentra registrada para este paciente.",
				0: "El registro no pudo agregarse, contacte al administrador."
			});
			if (ok) {
				$('#addHolterForm')[0].reset();
				showHolterDataTable();
			}
		}
	});
	return false;
}

function obtainHolterData(idHolter) {
	$('#info_registro_holter').empty();
	$.ajax({
		type:"POST",
		url:"../controllers/holters/obtainHolterData.php",
		data: { idHolter: idHolter },
		dataType: "json",
		success:function(r){
			if (!r) {
				return;
			}
			$('#idHolter').val(r['idHolter']);
			$('#idC_costo_update').val(r['idC_costo']);
			$('#idMedico_update').val(r['idMedico']);
			$('#factura_holter_update').val(r['factura_holter']);
			$('#fecha_holter_update').val(r['fecha_holter']);
			$('#nombre_paciente_holter_update').val(r['nombre_paciente_holter']);
			$('#apellido_paciente_holter_update').val(r['apellido_paciente_holter']);
			$('#cedula_paciente_holter_update').val(r['cedula_paciente_holter']);
			$('#n_historia_paciente_holter_update').val(r['n_historia_paciente_holter']);
			mostrarInfoRegistro('#info_registro_holter', r);
		}
	});
}

function updateHolterData() {
	$.ajax({
		type:"POST",
		url:"../controllers/holters/updateHolterData.php",
		data: $('#updateHolterForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Registro actualizado correctamente.",
				2: "Esta factura ya se encuentra registrada para este paciente.",
				0: "El registro no pudo actualizarse, contacte al administrador."
			});
			if (ok) {
				showHolterDataTable();
			}
		}
	});
	return false;
}

function showHolterDataTable(){
	$(function(){
		cargarFragmento('#container_tableHolters', 'tables/holters/tableHolters.php', 'tableHolters');
	});
}

function countHoltersData(){
	$(function(){
		cargarFragmento('#container_countHolters', 'elements/holters/countHolters.php');
	});
}

function deleteHolterData(idHolter){
	confirmarEliminacion("¿Realmente desea eliminar este registro? Un administrador podrá restaurarlo desde Auditoría.").then(function(willDelete) {
		if (!willDelete) {
			return;
		}
		$.ajax({
			type:"POST",
			url:"../controllers/holters/deleteHolterData.php",
			data: { idHolter: idHolter },
			success:function(r){
				var ok = mostrarResultado(r, {
					1: "El registro ha sido eliminado correctamente.",
					0: "El registro no pudo eliminarse, contacte al administrador."
				});
				if (ok) {
					showHolterDataTable();
				}
			}
		});
	});
}
