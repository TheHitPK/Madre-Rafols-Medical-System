<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5">
					<i class="fa-solid fa-user-plus"></i> Registrar usuario
				</h1>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Close" style="font-size: 30px;">
					<i class="fa-solid fa-xmark"></i>
				</button>
            </div>

    		<form id="addUserForm" onsubmit="return addUserData()" method="post">
				<div class="modal-body">
					<div class="row mb-3">
                        <div class="col">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" placeholder="Ingrese el nombre" aria-label="Nombre" required>
                        </div>
                        <div class="col">
                            <label for="apellido">Apellido:</label>
                            <input type="text" name="apellido_usuario" id="apellido_usuario" class="form-control" placeholder="Ingrese el apellido" aria-label="Apellido" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula">Cédula:</label>
                            <input type="number" name="cedula_usuario" id="cedula_usuario" class="form-control" placeholder="Ingrese la cédula" aria-label="Cedula" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese el usuario" aria-label="Usuario" required>
                        </div>
                        <div class="col">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mínimo 6 caracteres" aria-label="Contraseña" minlength="6" autocomplete="new-password" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <input type="hidden" name="idEstado" id="idEstado" value="1">
                        <div class="col">
                            <label for="rol">Rol:</label>
                            <select class="form-select" aria-label="Default select example" name="idRol" id="idRol" required>
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
				</div>
				<div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Guardar</button> <!--Guardar, Registrar, Agregar-->
                </div>
			</form>
    	</div>
	</div>
</div>


