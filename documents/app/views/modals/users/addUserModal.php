<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="addUserModalLabel">
					<i class="fa-solid fa-user-plus" aria-hidden="true"></i> Registrar usuario
				</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Cerrar" style="font-size: 30px;">
					<i class="fa-solid fa-xmark" aria-hidden="true"></i>
				</button>
            </div>

    		<form id="addUserForm" onsubmit="return addUserData()" method="post">
				<div class="modal-body">
                    <p class="nota-obligatorios mb-3">Los campos con <span>*</span> son obligatorios.</p>
					<div class="row mb-3">
                        <div class="col">
                            <label for="nombre_usuario" class="form-label mb-1">Nombre:</label>
                            <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" placeholder="Ingrese el nombre" required>
                        </div>
                        <div class="col">
                            <label for="apellido_usuario" class="form-label mb-1">Apellido:</label>
                            <input type="text" name="apellido_usuario" id="apellido_usuario" class="form-control" placeholder="Ingrese el apellido" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula_usuario" class="form-label mb-1">Cédula:</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="10" autocomplete="off" title="Solo números" name="cedula_usuario" id="cedula_usuario" class="form-control" placeholder="Ingrese la cédula" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="usuario" class="form-label mb-1">Usuario:</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese el usuario" required>
                        </div>
                        <div class="col">
                            <label for="password" class="form-label mb-1">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mínimo 6 caracteres" minlength="6" autocomplete="new-password" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <input type="hidden" name="idEstado" id="idEstado" value="1">
                        <div class="col">
                            <label for="idRol" class="form-label mb-1">Rol:</label>
                            <select class="form-select" name="idRol" id="idRol" required>
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
                            <label for="idDepartamento" class="form-label mb-1">Área:</label>
                            <select class="form-select" name="idDepartamento" id="idDepartamento" aria-describedby="ayudaArea" required>
                                <option value="">Seleccione...</option>
                                <?php
                                    foreach ($showDepartamentoData as $key => $value) {
                                ?>
                                        <option value="<?php echo (int)$value[0];?>"><?php echo e($value[1]);?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <div class="form-text" id="ayudaArea">Un empleado solo ve los módulos de su área. Los administradores ven todas.</div>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-ban" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check" aria-hidden="true"></i> Guardar</button> <!--Guardar, Registrar, Agregar-->
                </div>
			</form>
    	</div>
	</div>
</div>


