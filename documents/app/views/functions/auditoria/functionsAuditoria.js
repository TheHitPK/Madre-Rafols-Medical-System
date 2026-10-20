function showAuditoriaTable(){
	$(function(){
		cargarFragmento('#container_tableAuditoria', 'tables/auditoria/tableAuditoria.php', 'tableAuditoria');
	});
}

function restaurarEstudio(modulo, id){
	swal({
		icon: "warning",
		title: "¡ATENCIÓN!",
		text: "¿Desea restaurar este registro? Volverá a aparecer en su tabla.",
		buttons: ["Cancelar", "Restaurar"]
	}).then(function(confirmado) {
		if (!confirmado) {
			return;
		}
		$.ajax({
			type: "POST",
			url: "../controllers/auditoria/restaurarEstudio.php",
			data: { modulo: modulo, id: id },
			success: function(r){
				var ok = mostrarResultado(r, {
					1: "El registro fue restaurado correctamente.",
					2: "No se puede restaurar: esa factura ya se registró de nuevo para el mismo paciente.",
					0: "El registro ya no está en la papelera."
				});
				showAuditoriaTable();
			}
		});
	});
}
