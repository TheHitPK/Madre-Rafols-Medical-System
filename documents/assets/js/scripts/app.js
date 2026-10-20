/*
 * CONFIGURACIÓN COMÚN DE TODAS LAS PÁGINAS INTERNAS
 */

// Token CSRF: se envía automáticamente en TODAS las peticiones AJAX.
$.ajaxSetup({
    headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') }
});

// Los mensajes (SweetAlert) se anuncian con su título en los lectores de pantalla:
// la librería crea el cuadro de diálogo sin nombre accesible.
if (window.swal) {
    var swalOriginal = window.swal;
    window.swal = function() {
        var resultado = swalOriginal.apply(this, arguments);
        $('.swal-title').attr('id', 'swal-titulo');
        $('.swal-modal').attr({ 'aria-labelledby': 'swal-titulo', 'aria-describedby': 'swal-texto' });
        $('.swal-text').attr('id', 'swal-texto');
        return resultado;
    };
    $.extend(window.swal, swalOriginal);
}

// Errores de sesión / permisos en un solo lugar (antes cada petición fallaba en silencio).
var avisoSesionMostrado = false;
$(document).ajaxError(function(evento, xhr) {
    if (xhr.status === 401) {
        if (avisoSesionMostrado) {
            return;
        }
        avisoSesionMostrado = true;
        swal({
            icon: "warning",
            title: "SESIÓN EXPIRADA",
            text: "Su sesión ha caducado. Inicie sesión nuevamente."
        }).then(function() {
            window.location = "../../../index.php";
        });
    } else if (xhr.status === 403) {
        swal({
            icon: "error",
            title: "¡ACCESO DENEGADO!",
            text: "No tiene permisos para realizar esta acción. Si el problema continúa, recargue la página."
        });
    } else if (xhr.status >= 500) {
        swal({
            icon: "error",
            title: "¡ERROR!",
            text: "No se pudo completar la operación, contacte al administrador."
        });
    }
});

/*
 * Carga un fragmento HTML (tabla, contador) en un contenedor.
 * Si el contenedor tiene una tabla DataTables, la destruye antes de reemplazarla para que
 * no queden instancias viejas en memoria. Se reemplaza al llegar la respuesta (sin parpadeo).
 */
function cargarFragmento(contenedor, url, tablaId) {
    var $contenedor = $(contenedor);
    if (!$contenedor.length) {
        return;
    }
    $.get(url, function(html) {
        if (tablaId && $.fn.dataTable && $.fn.dataTable.isDataTable('#' + tablaId)) {
            $('#' + tablaId).DataTable().destroy();
        }
        $contenedor.html(html);
    });
}

/*
 * Muestra el resultado de guardar/editar/eliminar según el código que devuelve el servidor:
 * 1 = éxito, 2 = registro repetido, 3 y siguientes = casos especiales del módulo (con su mensaje),
 * 4 = datos inválidos, otro = error. Devuelve true si la operación fue exitosa.
 */
function mostrarResultado(respuesta, mensajes) {
    var r = String(respuesta).trim();
    if (r === "1") {
        swal({ icon: "success", title: "¡ÉXITO!", text: mensajes[1] });
        return true;
    }
    if (r !== "0" && r !== "4" && mensajes[r]) {
        swal({ icon: "warning", title: "¡ATENCIÓN!", text: mensajes[r] });
    } else if (r === "4") {
        swal({ icon: "warning", title: "¡ATENCIÓN!", text: "Verifique los datos ingresados: hay campos vacíos o con formato inválido." });
    } else {
        swal({ icon: "error", title: "¡ERROR!", text: mensajes[0] });
    }
    return false;
}

function confirmarEliminacion(texto) {
    return swal({
        icon: "warning",
        title: "¡ATENCIÓN!",
        text: texto,
        buttons: ["Cancelar", "Eliminar"],
        dangerMode: true
    });
}

// "Registrado por X el ... · Última edición por Y el ..." en el formulario de edición.
function mostrarInfoRegistro(selector, r) {
    var partes = [];
    if (r.creado_por_usuario) {
        partes.push('Registrado por ' + r.creado_por_usuario + ' el ' + r.creado_en);
    }
    if (r.modificado_por_usuario) {
        partes.push('Última edición por ' + r.modificado_por_usuario + ' el ' + r.modificado_en);
    }
    $(selector).text(partes.join(' · '));
}

/*
 * EVITAR GUARDAR DOS VECES
 * Mientras un formulario espera la respuesta del servidor, su botón de envío queda
 * desactivado y muestra "Guardando...". Antes, un doble clic o una red lenta podían
 * registrar el mismo estudio dos veces.
 * Los formularios llaman a su función con onsubmit="return addEcoData()"; este manejador
 * corre justo después, cuando la petición ya salió.
 */
var botonesOcupados = [];
$(document).on('submit', 'form[onsubmit]', function() {
    var $boton = $(this).find('[type="submit"]');
    if (!$boton.length || $boton.attr('aria-busy') === 'true') {
        return;
    }
    $boton.data('htmlOriginal', $boton.html())
          .prop('disabled', true)
          .attr('aria-busy', 'true')
          .html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Guardando...');
    botonesOcupados.push($boton);
});
$(document).ajaxComplete(function() {
    if ($.active > 1) {
        return; // todavía hay peticiones en curso
    }
    $.each(botonesOcupados, function(i, $boton) {
        $boton.prop('disabled', false).removeAttr('aria-busy').html($boton.data('htmlOriginal'));
    });
    botonesOcupados = [];
});
