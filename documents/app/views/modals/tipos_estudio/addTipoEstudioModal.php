<!-- Modal: registrar tipo de estudio -->
<div class="modal fade" id="addTipoEstudioModal" tabindex="-1" aria-labelledby="addTipoEstudioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="addTipoEstudioModalLabel"><i class="fa-solid fa-x-ray" aria-hidden="true"></i> Registrar tipo de estudio</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
            </div>

            <form id="addTipoEstudioForm" onsubmit="return addTipoEstudioData()" method="post">
                <div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tipo_estudio" class="form-label mb-1">Tipo de estudio:</label>
                            <input type="text" name="tipo_estudio" id="tipo_estudio" class="form-control" maxlength="150" placeholder="Ej.: Rayos X de tórax" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check" aria-hidden="true"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
