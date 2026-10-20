<?php
    require_once __DIR__ . "/../../../core/bootstrap.php";
    require_once __DIR__ . "/../../../models/UsersModel.php";
    api_lectura();
    requerir_admin_api();

    $Users = new Users();
    $showUserData = $Users -> showUserData();
?>
    <table class="table table-hover text-center display compact nowrap animate__animated animate__fadeIn" style="width: 100%;" id="tableUsers">
		<thead class="text-light" style="background-color: #001d3d;">
			<tr>
				<th class="text-center">Nombre</th>
				<th class="text-center">Apellido</th>
				<th class="text-center">Cédula</th>
				<th class="text-center">Usuario</th>
				<th class="text-center">Rol</th>
				<th class="text-center">Estado</th>
				<th class="text-center"><span class="visually-hidden">Acciones</span></th>
			</tr>
		</thead>
		<tbody>
            <?php
                foreach ($showUserData as $value) {
                    $idUsuario = (int)$value['idUsuario'];
                    $esAdmin   = (int)$value['idRol'] === ROL_ADMIN;
                    $activo    = (int)$value['idEstado'] === ESTADO_ACTIVO;
            ?>
                    <tr>
                        <td><?php echo e($value['nombre_usuario']);?></td>
                        <td><?php echo e($value['apellido_usuario']);?></td>
                        <td><?php echo e($value['cedula_usuario']);?></td>
                        <td><?php echo e($value['usuario']);?></td>
                        <td>
                            <span style="font-size: 15px; width: 140px;" class="badge shadow <?php echo $esAdmin ? "bg-primary text-light" : "bg-info text-dark";?>">
                                <i class="fa-solid <?php echo $esAdmin ? "fa-user-tie" : "fa-user";?>" aria-hidden="true"></i>&nbsp;<?php echo e($value['rol']);?>
                            </span>
                        </td>
                        <td>
                            <span style="font-size: 15px; width: 100px;" class="badge text-light shadow <?php echo $activo ? "bg-success" : "bg-danger";?>">
                                <i class="fa-solid <?php echo $activo ? "fa-user-check" : "fa-user-lock";?>" aria-hidden="true"></i>&nbsp;<?php echo e($value['estado']);?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group shadow acciones-fila" role="group" aria-label="Acciones">
                                <?php if (!$esAdmin && $idUsuario !== usuario_actual_id()) { ?>
                                    <button type="button" class="btn btn-sm btn-secondary" onclick="changeUserStatus(<?php echo $idUsuario;?>)" title="<?php echo $activo ? 'Desactivar' : 'Activar';?>" aria-label="<?php echo ($activo ? 'Desactivar' : 'Activar') . ' a ' . e($value['usuario']);?>">
                                        <span class="fa-solid fa-user-gear" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-warning" onclick="obtainUserData(<?php echo $idUsuario;?>)" data-bs-toggle="modal" data-bs-target="#updateUserModal" title="Editar" aria-label="Editar a <?php echo e($value['usuario']);?>">
                                        <span class="fa-solid fa-user-pen" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteUserData(<?php echo $idUsuario;?>)" title="Eliminar" aria-label="Eliminar a <?php echo e($value['usuario']);?>">
                                        <span class="fa-solid fa-user-slash" aria-hidden="true"></span>
                                    </button>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
	</table>

    <script>
        initTablaUsuarios({ id: 'tableUsers', modalNuevo: '#addUserModal', titulo: 'Reporte de Usuarios' });
    </script>
