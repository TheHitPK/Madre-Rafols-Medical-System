function addMedicoData(){
	$.ajax({
		type:"POST",
		url:"../controllers/medicos/addMedicoData.php",
		data: $('#addMedicoForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Médico agregado correctamente.",
				2: "El médico ya se encuentra registrado en el sistema.",
				0: "El médico no pudo agregarse, contacte al administrador."
			});
			if (ok) {
				$('#addMedicoForm')[0].reset();
				showMedicosDataTable();
				countMedicosData();
			}
		}
	});
	return false;
}

function updateMedicoData() {
	$.ajax({
		type:"POST",
		url:"../controllers/medicos/updateMedicoData.php",
		data: $('#updateMedicoForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Médico actualizado correctamente.",
				2: "Ya existe otro médico con ese nombre.",
				0: "El médico no pudo actualizarse, contacte al administrador."
			});
			if (ok) {
				showMedicosDataTable();
			}
		}
	});
	return false;
}

function showMedicosDataTable(){
	$(function(){
		cargarFragmento('#container_tableMedicos', 'tables/medicos/tableMedicos.php');
	});
}

function countMedicosData(){
	$(function(){
		cargarFragmento('#container_countMedicos', 'elements/medicos/countMedicos.php');
	});
}

function obtainMedicoData(idMedico) {
	$.ajax({
		type:"POST",
		url:"../controllers/medicos/obtainMedicoData.php",
		data: { idMedico: idMedico },
		dataType: "json",
		success:function(r){
			if (!r) {
				return;
			}
			$('#idMedico').val(r['idMedico']);
			$('#medico_update').val(r['medico']);
		}
	});
}

function deleteMedicoData(idMedico){
	confirmarEliminacion("¿Realmente desea eliminar este médico?").then(function(willDelete) {
		if (!willDelete) {
			return;
		}
		$.ajax({
			type:"POST",
			url:"../controllers/medicos/deleteMedicoData.php",
			data: { idMedico: idMedico },
			success:function(r){
				var ok = mostrarResultado(r, {
					1: "El médico ha sido eliminado correctamente.",
					3: "No se puede eliminar: hay estudios registrados con este médico.",
					0: "El médico no pudo eliminarse, contacte al administrador."
				});
				if (ok) {
					showMedicosDataTable();
					countMedicosData();
				}
			}
		});
	});
}
