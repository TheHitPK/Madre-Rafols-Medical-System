/*
 * CONFIGURACIÓN COMPARTIDA DE LAS TABLAS (DataTables)
 * Antes este código estaba copiado dentro de cada tabla (ecos, holters, mapas, usuarios),
 * junto con el logo en base64, y se volvía a descargar y ejecutar en cada recarga.
 */

var DT_IDIOMA_ES = {
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %d fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "notEmpty": "No Vacio",
                "not": "Diferente de"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con",
                "not": "Diferente de"
            },
            "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d"
    },
    "select": {
        "cells": {
            "1": "1 celda seleccionada",
            "_": "$d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        },
        "rows": {
            "1": "1 fila seleccionada",
            "_": "%d filas seleccionadas"
        }
    },
    "thousands": ".",
    "datetime": {
        "previous": "Anterior",
        "next": "Proximo",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "AM",
            "PM"
        ],
        "months": {
            "0": "Enero",
            "1": "Febrero",
            "10": "Noviembre",
            "11": "Diciembre",
            "2": "Marzo",
            "3": "Abril",
            "4": "Mayo",
            "5": "Junio",
            "6": "Julio",
            "7": "Agosto",
            "8": "Septiembre",
            "9": "Octubre"
        },
        "weekdays": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ]
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
            }
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
        },
        "multi": {
            "title": "Múltiples Valores",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
        }
    },
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
};

var DT_LONGITUDES = [
    [ 5, 10, 25, 50, -1 ],
    [ '5 filas', '10 filas', '25 filas', '50 filas', 'Mostrar todo' ]
];

function tituloReporte(titulo) {
    var f = new Date();
    return "Departamento de Cardiología\n " + titulo + " - " + f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear();
}

// Botones de copiar / imprimir / Excel / PDF / cantidad de filas
function botonesExportacion(opciones) {
    var titulo = function() { return tituloReporte(opciones.titulo); };
    var botonPdf = {
        extend:    'pdf',
        text:      '<i class="fa-solid fa-file-pdf" aria-hidden="true"></i>',
        titleAttr: 'Exportar a PDF',
        attr:      { 'aria-label': 'Exportar a PDF' },
        pageSize:  'A4',
        className: 'btn btn-danger',
        title:     titulo,
        customize: function(doc) {
            if (opciones.pdfEstilos) {
                doc.styles.tableHeader = {
                    fillColor: '#001d3d',
                    color: '#fff',
                    fontSize: '10'
                };
                doc.defaultStyle.fontSize = 9;
                doc.pageMargins = [30, 30, 30, 30];
            }
            doc.content.splice(0, 0, {
                columns: [{
                    margin: 0,
                    alignment: 'left',
                    image: PDF_LOGO,
                    width: 50,
                    height: 50
                }, {
                    margin: [10, 15],
                    text: (opciones.pdfSaltoEncabezado ? '\n' : '') + 'Sistema de Salud Madre Rafols\nAsociación Civil Hospital Madre Rafols',
                    fontSize: 10
                }]
            });
        }
    };
    if (opciones.pdfFontSize) {
        botonPdf.fontSize = opciones.pdfFontSize;
    }

    return [
        {
            extend:    'copy',
            text:      '<i class="fa-solid fa-copy" aria-hidden="true"></i>',
            titleAttr: 'Copiar al portapapeles',
            attr:      { 'aria-label': 'Copiar al portapapeles' },
            className: 'btn btn-dark'
        },
        {
            extend:    'print',
            text:      '<i class="fa-solid fa-print" aria-hidden="true"></i>',
            titleAttr: 'Imprimir',
            attr:      { 'aria-label': 'Imprimir' },
            className: 'btn btn-secondary',
            title:     titulo,
            // La vista de impresión es HTML: se mantienen los datos escapados para que
            // un nombre con código HTML se imprima como texto y no se ejecute.
            exportOptions: { decodeEntities: false }
        },
        {
            extend:    'excel',
            text:      '<i class="fa-solid fa-file-excel" aria-hidden="true"></i>',
            titleAttr: 'Exportar a Excel',
            attr:      { 'aria-label': 'Exportar a Excel' },
            className: 'btn btn-success',
            title:     titulo
        },
        botonPdf,
        {
            extend: 'pageLength',
            className: 'btn btn-light'
        }
    ];
}

function botonModal(modal, html, estilo) {
    var boton = {
        text: '<span class="' + estilo.clase + '" style="' + estilo.css + '">' + html + '</span>',
        className: 'p-0 border-0',
        action: function() {
            bootstrap.Modal.getOrCreateInstance(document.querySelector(modal)).show();
        }
    };
    if (estilo.nombre) {
        boton.titleAttr = estilo.nombre;
        boton.attr = { 'aria-label': estilo.nombre };
    }
    return boton;
}

function guardarJSON(clave, valor) {
    try { localStorage.setItem(clave, JSON.stringify(valor)); } catch (e) {}
}

function leerJSON(clave) {
    try { return JSON.parse(localStorage.getItem(clave)); } catch (e) { return null; }
}

/*
 * MARCAS (checkbox junto a la factura)
 * Se guardan en la base de datos: todos los equipos ven las mismas y queda registrado quién marcó.
 * Antes vivían en el navegador de cada PC (localStorage), así que la primera vez que cada
 * equipo abre la tabla se suben las marcas que tenía guardadas, para no perderlas.
 */
// Fila (datos) de un estudio por su id, aunque no esté dibujada en la página actual.
function filaPorId(tabla, id) {
    return tabla.row(function(indice, datos) { return datos.id === id; });
}

function prepararMarcas(tabla, opciones) {
    $(tabla.table().node()).on('change', 'input.marca', function() {
        var casilla = this;
        var id = parseInt($(casilla).data('id'), 10);
        var datos = { marcado: casilla.checked ? 1 : 0 };
        datos[opciones.campoId] = id;

        $.post(opciones.urlMarcar, datos).done(function(r) {
            if (String(r).trim() === '1') {
                var fila = filaPorId(tabla, id);
                var d = fila.data();
                d.marcado = casilla.checked;
                d.marcado_por = casilla.checked ? 'usted' : null;
                d.marcado_en = casilla.checked ? 'hace un momento' : null;
                casilla.title = casilla.checked ? 'Marcado por usted' : '';
            } else {
                casilla.checked = !casilla.checked;
                swal({ icon: "error", title: "¡ERROR!", text: "No se pudo guardar la marca. Recargue la página e intente de nuevo." });
            }
        }).fail(function() {
            casilla.checked = !casilla.checked;
        });
    });

    importarMarcasLocales(tabla, opciones);
}

function importarMarcasLocales(tabla, opciones) {
    var bandera = 'marcas_' + opciones.modulo + '_importadas';
    if (leerJSON(bandera)) {
        return;
    }
    var ids = {};
    $.each(leerJSON('marcas_' + opciones.modulo) || {}, function(id, marcado) {
        if (marcado) {
            ids[id] = true;
        }
    });
    $.each(leerJSON('checkboxes') || {}, function(clave, marcado) { // formato de la primera versión del sistema
        var coincidencia = /^mark(\d+)$/.exec(clave);
        if (coincidencia && marcado) {
            ids[coincidencia[1]] = true;
        }
    });

    var lista = Object.keys(ids);
    if (lista.length === 0) {
        guardarJSON(bandera, true);
        return;
    }
    $.post(opciones.urlMarcar, { ids: lista }).done(function(r) {
        if (String(r).trim() !== '1') {
            return;
        }
        guardarJSON(bandera, true);
        tabla.rows().every(function() {
            var d = this.data();
            if (ids[d.id] && !d.marcado) {
                d.marcado = true;
                this.invalidate();
            }
        });
        tabla.draw(false);
    });
}

/*
 * FILTRO POR RANGO DE FECHAS
 * Se registra UNA sola vez por página. Antes se agregaba un filtro nuevo en cada recarga de la tabla
 * (cada alta, edición o borrado) y la tabla se volvía más lenta cuanto más se usaba.
 */
var filtroFechas = null;

function prepararFiltroFechas(columna) {
    if (filtroFechas || !$('#min').length) {
        return;
    }
    filtroFechas = {
        min: new DateTime($('#min'), { format: 'DD/MM/YYYY' }),
        max: new DateTime($('#max'), { format: 'DD/MM/YYYY' })
    };

    $.fn.dataTable.ext.search.push(function(settings, data) {
        if (!$(settings.nTable).hasClass('filtro-fechas')) {
            return true;
        }
        var min = filtroFechas.min.val();
        var max = filtroFechas.max.val();
        var date = new Date(data[columna]);

        return (min === null && max === null) ||
               (min === null && date <= max) ||
               (min <= date && max === null) ||
               (min <= date && date <= max);
    });

    $('#min, #max').on('change', function() {
        $.fn.dataTable.tables({ api: true }).draw();
        actualizarIndicadorFiltro();
    });
}

// Si hay un rango de fechas aplicado, el botón de filtro lo muestra: así nadie piensa
// que faltan registros cuando en realidad están filtrados.
function actualizarIndicadorFiltro() {
    var activo = !!(filtroFechas && (filtroFechas.min.val() || filtroFechas.max.val()));
    $('.indicador-filtro').each(function() {
        var $span = $(this);
        $span.toggleClass('btn-info', !activo).toggleClass('btn-warning', activo);
        $span.find('.texto-filtro').text(activo ? ' Filtro activo' : '');
        $span.closest('button').attr('aria-label', activo ? 'Filtrar por fechas (hay un filtro activo)' : 'Filtrar por fechas')
             .attr('title', activo ? 'Filtro por fechas activo' : 'Filtrar por fechas');
    });
}

function limpiarFiltroFechas() {
    if (!filtroFechas) {
        return;
    }
    filtroFechas.min.val(null);
    filtroFechas.max.val(null);
    $('#min, #max').val('');
    $.fn.dataTable.tables({ api: true }).draw();
    actualizarIndicadorFiltro();
}

function escaparHtml(valor) {
    return String(valor === null || valor === undefined ? '' : valor)
        .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
}

// Texto de una celda: escapado al mostrarlo; tal cual para buscar, ordenar y exportar.
function celdaTexto(dato, tipo) {
    return tipo === 'display' ? escaparHtml(dato) : dato;
}

// Tablas de ecos, holters y mapas.
// Los datos llegan en opciones.datos y DataTables solo dibuja las filas visibles (deferRender):
// con miles de registros la tabla aparece en una fracción de segundo.
function initTablaEstudio(opciones) {
    var $tabla = $('#' + opciones.id);
    var nombre = opciones.nombre;

    prepararFiltroFechas(2); // columna "Fecha"
    $tabla.addClass('filtro-fechas');

    var tabla = $tabla.DataTable({
        data: opciones.datos,
        deferRender: true,
        rowId: function(d) { return 'fila-' + opciones.modulo + '-' + d.id; },
        columns: [
            { data: null, responsivePriority: 9, render: function(d, tipo, fila, meta) { return meta.row + 1; } }, // N° en orden de fecha, como antes
            { data: 'factura', className: 'text-start', responsivePriority: 3, render: function(factura, tipo, fila) {
                if (tipo !== 'display') {
                    return factura;
                }
                var titulo = fila.marcado && fila.marcado_por ? ' title="Marcado por ' + escaparHtml(fila.marcado_por) + ' el ' + escaparHtml(fila.marcado_en) + '"' : '';
                return '<input type="checkbox" class="marca" data-id="' + fila.id + '" aria-label="Marcar ' + (factura ? 'factura ' + escaparHtml(factura) : 'registro sin factura') + ' de ' + escaparHtml(fila.paciente) + '"' + (fila.marcado ? ' checked' : '') + titulo + '>&nbsp; ' + escaparHtml(factura);
            } },
            { data: 'fecha', responsivePriority: 4, render: celdaTexto },
            { data: 'c_costo', className: 'celda-mayusculas', responsivePriority: 6, render: celdaTexto },
            { data: 'paciente', className: 'celda-mayusculas', responsivePriority: 2, render: celdaTexto },
            { data: 'cedula', responsivePriority: 5, render: celdaTexto },
            { data: 'n_historia', responsivePriority: 8, render: celdaTexto },
            { data: 'medico', className: 'celda-mayusculas', responsivePriority: 7, render: celdaTexto },
            { data: null, orderable: false, searchable: false, responsivePriority: 1, render: function(d, tipo, fila) {
                if (tipo !== 'display') {
                    return '';
                }
                // Botones reales (alcanzables con Tab) con nombre que incluye al paciente
                var paciente = escaparHtml(fila.paciente);
                var eliminar = opciones.puedeEliminar
                    ? '<button type="button" class="btn btn-sm btn-danger" onclick="delete' + nombre + 'Data(' + fila.id + ')" title="Eliminar" aria-label="Eliminar registro de ' + paciente + '"><span class="fa-solid fa-trash" aria-hidden="true"></span></button>'
                    : '';
                return '<div class="btn-group shadow acciones-fila" role="group" aria-label="Acciones">'
                     + '<button type="button" class="btn btn-sm btn-warning" onclick="obtain' + nombre + 'Data(' + fila.id + ')" data-bs-toggle="modal" data-bs-target="#update' + nombre + 'Modal" title="Editar" aria-label="Editar registro de ' + paciente + '"><span class="fa-solid fa-pen-to-square" aria-hidden="true"></span></button>'
                     + eliminar + '</div>';
            } }
        ],
        responsive: true,
        language: DT_IDIOMA_ES,
        lengthChange: false,
        lengthMenu: DT_LONGITUDES,
        buttons: [
            botonModal(opciones.modalNuevo, '<span class="fa-solid fa-plus" aria-hidden="true"></span> Nuevo', { clase: 'btn btn-primary', css: 'border-radius: 4px 0px 4px 4px; width: 100%;' }),
            botonModal(opciones.modalFiltro, '<span class="fa-solid fa-filter" aria-hidden="true"></span><span class="texto-filtro"></span>', { clase: 'btn btn-info text-dark indicador-filtro', css: 'border-radius: 0px 0px 0px 0px; width: 100%;', nombre: 'Filtrar por fechas' })
        ].concat(botonesExportacion(opciones))
    });

    tabla.buttons().container().appendTo('#' + opciones.id + '_wrapper .col-md-6:eq(0)');
    prepararMarcas(tabla, opciones);
    actualizarIndicadorFiltro();
    return tabla;
}

// Tabla de usuarios
function initTablaUsuarios(opciones) {
    var tabla = $('#' + opciones.id).DataTable({
        responsive: true,
        language: DT_IDIOMA_ES,
        lengthChange: false,
        lengthMenu: DT_LONGITUDES,
        buttons: [
            botonModal(opciones.modalNuevo, '<span class="fa-solid fa-user-plus" aria-hidden="true"></span> Nuevo', { clase: 'btn btn-primary', css: 'border-radius: 4px 0px 4px 4px;' })
        ].concat(botonesExportacion(opciones))
    });

    tabla.buttons().container().appendTo('#' + opciones.id + '_wrapper .col-md-6:eq(0)');
    return tabla;
}

// Tablas de solo consulta (historial de pacientes, auditoría): búsqueda y exportación, sin botón "Nuevo".
function initTablaSimple(opciones) {
    var tabla = $('#' + opciones.id).DataTable({
        responsive: true,
        language: DT_IDIOMA_ES,
        lengthChange: false,
        lengthMenu: DT_LONGITUDES,
        pageLength: opciones.filas || 10,
        order: opciones.orden || [],
        buttons: botonesExportacion({ titulo: opciones.titulo, pdfEstilos: true })
    });

    tabla.buttons().container().appendTo('#' + opciones.id + '_wrapper .col-md-6:eq(0)');
    return tabla;
}
