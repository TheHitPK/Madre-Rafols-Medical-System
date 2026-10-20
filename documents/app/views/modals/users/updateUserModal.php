<!-- Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header bg-warning">
				<h1 class="modal-title fs-5">
					<i class="fa-solid fa-user-pen"></i> Editar Usuario
				</h1>
				<button type="button" class="btn btn-sm text-dark" data-bs-dismiss="modal" aria-label="Close" style="font-size: 30px;">
					<i class="fa-solid fa-xmark"></i>
				</button>
      		</div>

			<form id="updateUserForm" onsubmit="return updateUserData()" method="post">
                <input type="hidden" name="idUsuario" id="idUsuario">
				<div class="modal-body">
					<div class="row mb-3">
                        <div class="col">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre_usuario_update" id="nombre_usuario_update" class="form-control" placeholder="Ingrese el nombre" aria-label="Nombre" required>
                        </div>
                        <div class="col">
                            <label for="apellido">Apellido:</label>
                            <input type="text" name="apellido_usuario_update" id="apellido_usuario_update" class="form-control" placeholder="Ingrese el apellido" aria-label="Apellido" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="cedula">Cédula:</label>
                            <input type="number" name="cedula_usuario_update" id="cedula_usuario_update" class="form-control" placeholder="Ingrese la cédula" aria-label="Cedula" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario_update" id="usuario_update" class="form-control" placeholder="Ingrese el usuario" aria-label="Usuario" required>
                        </div>
                        <div class="col">
                            <label for="rol">Rol:</label>
                            <select class="form-select" aria-label="Default select example" name="idRol_update" id="idRol_update" required>
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
                            <label for="password_update">Nueva contraseña:</label>
                            <input type="password" name="password_update" id="password_update" class="form-control" placeholder="Dejar en blanco para no cambiarla" aria-label="Nueva contraseña" autocomplete="new-password">
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
