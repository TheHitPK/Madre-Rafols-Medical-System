<!-- Modal: editar tipo de estudio -->
<div class="modal fade" id="updateTipoEstudioModal" tabindex="-1" aria-labelledby="updateTipoEstudioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="updateTipoEstudioModalLabel"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Editar tipo de estudio</h1>
                <button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
            </div>

            <form id="updateTipoEstudioForm" onsubmit="return updateTipoEstudioData()" method="post">
                <input type="hidden" name="idTipoEstudio" id="idTipoEstudio_editar">
                <div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tipo_estudio_update" class="form-label mb-1">Tipo de estudio:</label>
                            <input type="text" name="tipo_estudio_update" id="tipo_estudio_update" class="form-control" maxlength="150" placeholder="Ej.: Rayos X de tórax" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-check" aria-hidden="true"></i> Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
