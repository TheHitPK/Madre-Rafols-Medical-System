<!-- Modal Agregar Centro de costo-->
<div class="modal fade" id="updateC_costoModal" tabindex="-1" aria-labelledby="updateC_costoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header bg-warning">
				<h1 class="modal-title fs-5">
					<i class="fa-solid fa-pen-to-square"></i> Editar Centro de costo
				</h1>
				<button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Close" style="font-size: 30px;">
					<i class="fa-solid fa-xmark"></i>
				</button>
      		</div>

            <form id="updateC_costoForm" onsubmit="return updateC_costoData()" method="post">
                <input type="hidden" name="idC_costo" id="idC_costo">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="medico">Centro de costo:</label>
                            <input type="text" name="c_costo_update" id="c_costo_update" class="form-control" placeholder="Ingrese el centro de costo" aria-label="C_costo" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-check"></i> Actualizar</button> <!--Guardar, Registrar, Agregar-->
                </div>
            </form>
        </div>
    </div>
</div>
