<!-- Modal -->
<div class="modal fade" id="filterMapaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-light">
                <h1 class="modal-title fs-5">
                    <i class="fa-solid fa-calendar"></i> Filtrar registros por rango de fechas
				</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Close" style="font-size: 30px;">
					<i class="fa-solid fa-xmark"></i>
				</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <input type="text" id="min" name="min" class="form-control" placeholder="Fecha de inicio">
                    </div>
                    <div class="col">
                        <input type="text" id="max" name="max" class="form-control" placeholder="Fecha final">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-info text-light" data-bs-dismiss="modal"><i class="fa-solid fa-filter"></i> OK</button>
            </div>
    	</div>
	</div>
</div>