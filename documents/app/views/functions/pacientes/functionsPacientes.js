// ---------- HISTORIAL DE PACIENTES ----------

function buscarHistorial(){
	var termino = $.trim($('#terminoPaciente').val());
	if (termino.length < 3) {
		$('#container_tablePacientes').html('<div class="alert alert-info mb-0"><i class="fa-solid fa-circle-info"></i> Escriba al menos 3 caracteres: la cédula completa o parte del nombre o apellido.</div>');
		return false;
	}
	cargarFragmento('#container_tablePacientes', 'tables/pacientes/tablePacientes.php?q=' + encodeURIComponent(termino), 'tablePacientes');
	return false;
}

// ---------- AUTOCOMPLETAR PACIENTE AL ESCRIBIR LA CÉDULA ----------
// Al salir del campo cédula del formulario "Agregar", busca si ese paciente ya tiene estudios
// y ofrece sus datos con un clic. No reemplaza nada sin que el usuario lo elija: la misma cédula
// puede pertenecer a más de una persona (menores registrados con la cédula de un familiar).

function activarAutocompletadoPaciente(sufijo){
	var $cedula = $('#cedula_paciente_' + sufijo);
	if (!$cedula.length) {
		return;
	}
	var $sugerencias = $('<div class="form-text" id="sugerencias_paciente_' + sufijo + '"></div>').insertAfter($cedula);
	var ultimaBuscada = '';

	$cedula.on('change blur', function(){
		var cedula = $.trim($cedula.val());
		if (cedula === ultimaBuscada) {
			return;
		}
		ultimaBuscada = cedula;
		$sugerencias.empty();
		if (!/^\d{4,10}$/.test(cedula)) {
			return;
		}
		$.ajax({
			type: "POST",
			url: "../controllers/pacientes/buscarPaciente.php",
			data: { cedula: cedula },
			dataType: "json",
			success: function(pacientes){
				if (!pacientes || !pacientes.length) {
					$sugerencias.text('Paciente nuevo: no tiene estudios registrados.');
					return;
				}
				$sugerencias.append($('<div>').text(pacientes.length === 1 ? 'Paciente con estudios registrados:' : 'Esta cédula tiene varios nombres registrados, elija el correcto:'));
				$.each(pacientes, function(i, p){
					var texto = (p.nombre + ' ' + p.apellido).toUpperCase() + ' - último estudio ' + p.ultima_fecha;
					$('<button type="button" class="btn btn-sm btn-outline-primary me-1 mt-1"></button>')
						.append('<i class="fa-solid fa-user-check"></i> ')
						.append(document.createTextNode(texto))
						.on('click', function(){
							$('#nombre_paciente_' + sufijo).val(p.nombre);
							$('#apellido_paciente_' + sufijo).val(p.apellido);
							if (parseInt(p.n_historia, 10) > 0) {
								$('#n_historia_paciente_' + sufijo).val(p.n_historia);
							}
							$sugerencias.empty().append($('<span class="text-success"></span>').text('Datos de ' + texto.split(' - ')[0] + ' cargados.'));
						})
						.appendTo($sugerencias);
				});
			}
		});
	});

	// Al vaciar el formulario (después de guardar o al cancelar) se limpian las sugerencias.
	$cedula.closest('form').on('reset', function(){
		ultimaBuscada = '';
		$sugerencias.empty();
	});
}
