<!-- Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header bg-warning">
				<h1 class="modal-title fs-5" id="updateUserModalLabel">
					<i class="fa-solid fa-user-pen" aria-hidden="true"></i> Editar Usuario
				</h1>
				<button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
      		</div>

			<form id="updateUserForm" onsubmit="return updateUserData()" method="post">
                <input type="hidden" name="idUsuario" id="idUsuario">
				<div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
					<div class="row mb-3">
                        <div class="col">
                            <label for="nombre_usuario_update" class="form-label mb-1">Nombre:</label>
                            <input type="text" name="nombre_usuario_update" id="nombre_usuario_update" class="form-control" placeholder="Ingrese el nombre" required>
                        </div>
                        <div class="col">
                            <label for="apellido_usuario_update" class="form-label mb-1">Apellido:</label>
                            <input type="text" name="apellido_usuario_update" id="apellido_usuario_update" class="form-control" placeholder="Ingrese el apellido" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula_usuario_update" class="form-label mb-1">Cédula:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="cedula_usuario_update" id="cedula_usuario_update" class="form-control" placeholder="Ingrese la cédula" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="usuario_update" class="form-label mb-1">Usuario:</label>
                            <input type="text" name="usuario_update" id="usuario_update" class="form-control" placeholder="Ingrese el usuario" required>
                        </div>
                        <div class="col">
                            <label for="idRol_update" class="form-label mb-1">Rol:</label>
                            <select class="form-select" name="idRol_update" id="idRol_update" required>
                                <option selected value="">Seleccione...</option>
                                <?php
                                    foreach ($showRoleData as $key => $value) {
                                ?>
                                        <option value="<?php echo (int)$value[0];?>"><?php echo e($value[1]);?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="idDepartamento_update" class="form-label mb-1">Área:</label>
                            <select class="form-select" name="idDepartamento_update" id="idDepartamento_update" aria-describedby="ayudaArea_update" required>
                                <option value="">Seleccione...</option>
                                <?php
                                    foreach ($showDepartamentoData as $key => $value) {
                                ?>
                                        <option value="<?php echo (int)$value[0];?>"><?php echo e($value[1]);?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <div class="form-text" id="ayudaArea_update">Un empleado solo ve los módulos de su área. Los administradores ven todas.</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="password_update" class="form-label mb-1">Nueva contraseña:</label>
                            <input type="password" name="password_update" id="password_update" class="form-control" placeholder="Dejar en blanco para no cambiarla" autocomplete="new-password">
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-check" aria-hidden="true"></i> Actualizar</button> <!--Guardar, Registrar, Agregar-->
                </div>
			</form>
    </div>
  </div>
</div>
