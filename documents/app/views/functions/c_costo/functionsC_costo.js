function addC_costoData(){
	$.ajax({
		type:"POST",
		url:"../controllers/c_costo/addC_costoData.php",
		data: $('#addC_costoForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Centro de costo agregado correctamente.",
				2: "El centro de costo ya se encuentra en el sistema.",
				0: "El centro de costo no pudo agregarse, contacte al administrador."
			});
			if (ok) {
				$('#addC_costoForm')[0].reset();
				showC_costoDataTable();
				countC_costoData();
			}
		}
	});
	return false;
}

function updateC_costoData() {
	$.ajax({
		type:"POST",
		url:"../controllers/c_costo/updateC_costoData.php",
		data: $('#updateC_costoForm').serialize(),
		success:function(r){
			var ok = mostrarResultado(r, {
				1: "Centro de costo actualizado correctamente.",
				2: "Ya existe otro centro de costo con ese nombre.",
				0: "El centro de costo no pudo actualizarse, contacte al administrador."
			});
			if (ok) {
				showC_costoDataTable();
			}
		}
	});
	return false;
}

function showC_costoDataTable(){
	$(function(){
		cargarFragmento('#container_tableC_costo', 'tables/c_costo/tableC_costo.php');
	});
}

function countC_costoData(){
	$(function(){
		cargarFragmento('#container_countC_costo', 'elements/c_costo/countC_costo.php');
	});
}

function obtainC_costoData(idC_costo) {
	$.ajax({
		type:"POST",
		url:"../controllers/c_costo/obtainC_costoData.php",
		data: { idC_costo: idC_costo },
		dataType: "json",
		success:function(r){
			if (!r) {
				return;
			}
			$('#idC_costo').val(r['idC_costo']);
			$('#c_costo_update').val(r['c_costo']);
		}
	});
}

function deleteC_costoData(idC_costo){
	confirmarEliminacion("¿Realmente desea eliminar este centro de costo?").then(function(willDelete) {
		if (!willDelete) {
			return;
		}
		$.ajax({
			type:"POST",
			url:"../controllers/c_costo/deleteC_costoData.php",
			data: { idC_costo: idC_costo },
			success:function(r){
				var ok = mostrarResultado(r, {
					1: "El centro de costo ha sido eliminado correctamente.",
					3: "No se puede eliminar: hay estudios registrados con este centro de costo.",
					0: "El centro de costo no pudo eliminarse, contacte al administrador."
				});
				if (ok) {
					showC_costoDataTable();
					countC_costoData();
				}
			}
		});
	});
}
