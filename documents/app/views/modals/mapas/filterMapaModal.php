<!-- Modal: filtro por rango de fechas -->
<div class="modal fade" id="filterMapaModal" tabindex="-1" aria-labelledby="filterMapaModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-dark">
                <h1 class="modal-title fs-5" id="filterMapaModalLabel">
                    <i class="fa-solid fa-calendar" aria-hidden="true"></i> Filtrar por rango de fechas
				</h1>
                <button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <div class="col">
                        <label for="min" class="form-label mb-1">Desde:</label>
                        <input type="text" id="min" name="min" class="form-control" placeholder="dd/mm/aaaa" autocomplete="off" aria-describedby="ayudaFiltroMapa">
                    </div>
                    <div class="col">
                        <label for="max" class="form-label mb-1">Hasta:</label>
                        <input type="text" id="max" name="max" class="form-control" placeholder="dd/mm/aaaa" autocomplete="off" aria-describedby="ayudaFiltroMapa">
                    </div>
                </div>
                <div class="form-text mt-2" id="ayudaFiltroMapa">Puede dejar uno de los dos vacío. El filtro se aplica al instante y también afecta a los reportes (Excel, PDF, imprimir).</div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="limpiarFiltroFechas()"><i class="fa-solid fa-eraser" aria-hidden="true"></i> Quitar filtro</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fa-solid fa-check" aria-hidden="true"></i> Listo</button>
            </div>
    	</div>
	</div>
</div>
