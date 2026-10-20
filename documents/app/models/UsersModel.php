<?php
    require_once "Connection.php";

    class Users extends Connection{
        public function showUserData(){//READ
            $showUserDataSQL = "SELECT A.idUsuario,
                                       A.idEstado,
                                       B.estado,
                                       A.idRol,
                                       C.rol,
                                       A.idDepartamento,
                                       D.departamento,
                                       A.nombre_usuario,
                                       A.apellido_usuario,
                                       A.cedula_usuario,
                                       A.usuario
                                FROM usuarios A
                                INNER JOIN estado B        ON A.idEstado = B.idEstado
                                INNER JOIN rol C           ON A.idRol = C.idRol
                                INNER JOIN departamentos D ON A.idDepartamento = D.idDepartamento
                                WHERE A.idUsuario <> :superAdmin";
            $query_showUserData = Connection::connect() -> prepare($showUserDataSQL);
            $query_showUserData -> bindValue(":superAdmin", SUPER_ADMIN_ID, PDO::PARAM_INT);
            $query_showUserData -> execute();
            return $query_showUserData -> fetchAll();
        }

        public function showCountUsersData(){//COUNT READED DATA
            return Connection::connect() -> query("SELECT COUNT(*) FROM usuarios") -> fetchAll();
        }

        public function showCountUsersAdminData(){//COUNT READED USER DATA ADMIN
            return self::countUsersByRole(ROL_ADMIN);
        }

        public function showCountUsersEmpleadosData(){//COUNT READED USER DATA EMPLEADO
            return self::countUsersByRole(ROL_EMPLEADO);
        }

        private function countUsersByRole($idRol){
            $query_countUsersByRole = Connection::connect() -> prepare("SELECT COUNT(*) FROM usuarios WHERE idRol = :idRol");
            $query_countUsersByRole -> bindValue(":idRol", $idRol, PDO::PARAM_INT);
            $query_countUsersByRole -> execute();
            return $query_countUsersByRole -> fetchAll();
        }

        // true si la cédula o el usuario ya pertenecen a otro usuario (se excluye $idUsuarioExcluir al editar).
        public function existsUser($cedula_usuario, $usuario, $idUsuarioExcluir = 0){
            $existsUserSQL = "SELECT COUNT(*)
                              FROM usuarios
                              WHERE (cedula_usuario = :cedula_usuario OR usuario = :usuario)
                              AND idUsuario <> :idUsuario";
            $query_existsUser = Connection::connect() -> prepare($existsUserSQL);
            $query_existsUser -> bindValue(":cedula_usuario", $cedula_usuario, PDO::PARAM_INT);
            $query_existsUser -> bindValue(":usuario", $usuario, PDO::PARAM_STR);
            $query_existsUser -> bindValue(":idUsuario", $idUsuarioExcluir, PDO::PARAM_INT);
            $query_existsUser -> execute();
            return (int)$query_existsUser -> fetchColumn() > 0;
        }

        public function addUserData($formAddUserData){//CREATE
            if (self::existsUser($formAddUserData["cedula_usuario"], $formAddUserData["usuario"])) {
                return 2;
            }
            $addUserDataSQL = "INSERT INTO usuarios (idEstado,
                                                     idRol,
                                                     idDepartamento,
                                                     nombre_usuario,
                                                     apellido_usuario,
                                                     cedula_usuario,
                                                     usuario,
                                                     password)
                               VALUES (:idEstado,
                                       :idRol,
                                       :idDepartamento,
                                       :nombre_usuario,
                                       :apellido_usuario,
                                       :cedula_usuario,
                                       :usuario,
                                       :password)";
            $query_addUserData = Connection::connect() -> prepare($addUserDataSQL);
            $query_addUserData -> bindValue(":idEstado", ESTADO_ACTIVO, PDO::PARAM_INT);
            $query_addUserData -> bindValue(":idRol", $formAddUserData["idRol"], PDO::PARAM_INT);
            $query_addUserData -> bindValue(":idDepartamento", $formAddUserData["idDepartamento"], PDO::PARAM_INT);
            $query_addUserData -> bindValue(":nombre_usuario", $formAddUserData["nombre_usuario"], PDO::PARAM_STR);
            $query_addUserData -> bindValue(":apellido_usuario", $formAddUserData["apellido_usuario"], PDO::PARAM_STR);
            $query_addUserData -> bindValue(":cedula_usuario", $formAddUserData["cedula_usuario"], PDO::PARAM_INT);
            $query_addUserData -> bindValue(":usuario", $formAddUserData["usuario"], PDO::PARAM_STR);
            $query_addUserData -> bindValue(":password", self::hashPassword($formAddUserData["password"]), PDO::PARAM_STR);
            return $query_addUserData -> execute() ? 1 : 0;
        }

        public function obtainUserData($idUsuario){//READ ONLY ONE (sin la contraseña)
            $obtainUserDataSQL = "SELECT A.idUsuario,
                                         A.idEstado,
                                         B.estado,
                                         A.idRol,
                                         C.rol,
                                         A.idDepartamento,
                                         D.departamento,
                                         A.nombre_usuario,
                                         A.apellido_usuario,
                                         A.cedula_usuario,
                                         A.usuario
                                  FROM usuarios A
                                  INNER JOIN estado B        ON A.idEstado = B.idEstado
                                  INNER JOIN rol C           ON A.idRol = C.idRol
                                  INNER JOIN departamentos D ON A.idDepartamento = D.idDepartamento
                                  WHERE A.idUsuario = :idUsuario";
            $query_obtainUserData = Connection::connect() -> prepare($obtainUserDataSQL);
            $query_obtainUserData -> bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $query_obtainUserData -> execute();
            return $query_obtainUserData -> fetch(PDO::FETCH_ASSOC);
        }

        public function updateUserData($formUpdateUserData){//UPDATE (la contraseña solo cambia si se envía una nueva)
            if (self::existsUser($formUpdateUserData["cedula_usuario_update"], $formUpdateUserData["usuario_update"], $formUpdateUserData["idUsuario"])) {
                return 2;
            }
            $cambiarPassword = $formUpdateUserData["password_update"] !== '';
            $updateUserDataSQL = "UPDATE usuarios
                                  SET idRol            = :idRol_update,
                                      idDepartamento   = :idDepartamento_update,
                                      nombre_usuario   = :nombre_usuario_update,
                                      apellido_usuario = :apellido_usuario_update,
                                      cedula_usuario   = :cedula_usuario_update,
                                      usuario          = :usuario_update"
                                  . ($cambiarPassword ? ", password = :password_update" : "") . "
                                  WHERE idUsuario = :idUsuario";
            $query_updateUserData = Connection::connect() -> prepare($updateUserDataSQL);
            $query_updateUserData -> bindValue(":idUsuario", $formUpdateUserData["idUsuario"], PDO::PARAM_INT);
            $query_updateUserData -> bindValue(":idRol_update", $formUpdateUserData["idRol_update"], PDO::PARAM_INT);
            $query_updateUserData -> bindValue(":idDepartamento_update", $formUpdateUserData["idDepartamento_update"], PDO::PARAM_INT);
            $query_updateUserData -> bindValue(":nombre_usuario_update", $formUpdateUserData["nombre_usuario_update"], PDO::PARAM_STR);
            $query_updateUserData -> bindValue(":apellido_usuario_update", $formUpdateUserData["apellido_usuario_update"], PDO::PARAM_STR);
            $query_updateUserData -> bindValue(":cedula_usuario_update", $formUpdateUserData["cedula_usuario_update"], PDO::PARAM_INT);
            $query_updateUserData -> bindValue(":usuario_update", $formUpdateUserData["usuario_update"], PDO::PARAM_STR);
            if ($cambiarPassword) {
                $query_updateUserData -> bindValue(":password_update", self::hashPassword($formUpdateUserData["password_update"]), PDO::PARAM_STR);
            }
            return $query_updateUserData -> execute() ? 1 : 0;
        }

        public function deleteUserData($idUsuario){//DELETE
            $query_deleteUserData = Connection::connect() -> prepare("DELETE FROM usuarios WHERE idUsuario = :idUsuario");
            $query_deleteUserData -> bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
            return $query_deleteUserData -> execute() ? 1 : 0;
        }

        public function obtainUserStatus($idUsuario){
            $query_obtainUserStatus = Connection::connect() -> prepare("SELECT idEstado FROM usuarios WHERE idUsuario = :idUsuario");
            $query_obtainUserStatus -> bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $query_obtainUserStatus -> execute();
            return $query_obtainUserStatus -> fetch();
        }

        public function changeUserStatus($idUsuario, $idEstado){
            $query_changeUserStatus = Connection::connect() -> prepare("UPDATE usuarios SET idEstado = :idEstado WHERE idUsuario = :idUsuario");
            $query_changeUserStatus -> bindValue(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $query_changeUserStatus -> bindValue(":idEstado", $idEstado, PDO::PARAM_INT);
            return $query_changeUserStatus -> execute();
        }

        // Devuelve los datos del usuario si el usuario y la contraseña son correctos; false en caso contrario.
        // No toca la sesión: eso lo decide el controlador según el estado del usuario.
        public function userLogin($usuario, $password){//USER LOGIN
            $userLoginSQL = "SELECT A.idUsuario,
                                    A.idEstado,
                                    B.estado,
                                    A.idRol,
                                    C.rol,
                                    A.idDepartamento,
                                    D.departamento,
                                    A.nombre_usuario,
                                    A.apellido_usuario,
                                    A.cedula_usuario,
                                    A.usuario,
                                    A.password
                             FROM usuarios A
                             INNER JOIN estado B        ON A.idEstado = B.idEstado
                             INNER JOIN rol C           ON A.idRol = C.idRol
                             INNER JOIN departamentos D ON A.idDepartamento = D.idDepartamento
                             WHERE A.usuario = :usuario
                             LIMIT 1";
            $query_userLogin = Connection::connect() -> prepare($userLoginSQL);
            $query_userLogin -> bindValue(":usuario", $usuario, PDO::PARAM_STR);
            $query_userLogin -> execute();
            $userLogin = $query_userLogin -> fetch(PDO::FETCH_ASSOC);

            if (!$userLogin || !self::verifyPassword($password, $userLogin['password'])) {
                return false;
            }

            // Contraseña antigua en MD5: se convierte a un hash seguro en este momento,
            // aprovechando que tenemos la contraseña en texto plano.
            if (self::isLegacyHash($userLogin['password']) && self::passwordColumnSupportsHash()) {
                $query_rehash = Connection::connect() -> prepare("UPDATE usuarios SET password = :password WHERE idUsuario = :idUsuario");
                $query_rehash -> bindValue(":password", password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
                $query_rehash -> bindValue(":idUsuario", $userLogin['idUsuario'], PDO::PARAM_INT);
                $query_rehash -> execute();
            }

            unset($userLogin['password']);
            return $userLogin;
        }

        public function showRoleData(){
            return Connection::connect() -> query("SELECT idRol, rol FROM rol") -> fetchAll();
        }

        public function showDepartamentoData(){
            return Connection::connect() -> query("SELECT idDepartamento, departamento FROM departamentos ORDER BY idDepartamento") -> fetchAll();
        }

        public function showCountUsersAreaData($idDepartamento){
            $query_countUsersArea = Connection::connect() -> prepare("SELECT COUNT(*) FROM usuarios WHERE idDepartamento = :idDepartamento AND idRol = :idRol");
            $query_countUsersArea -> bindValue(":idDepartamento", $idDepartamento, PDO::PARAM_INT);
            $query_countUsersArea -> bindValue(":idRol", ROL_EMPLEADO, PDO::PARAM_INT);
            $query_countUsersArea -> execute();
            return (int)$query_countUsersArea -> fetchColumn();
        }

        // ---------- CONTRASEÑAS ----------

        private static function isLegacyHash($hash){
            return strlen($hash) === 32 && ctype_xdigit($hash);
        }

        private static function verifyPassword($password, $hash){
            if (self::isLegacyHash($hash)) {
                return hash_equals(strtolower($hash), md5($password));
            }
            return password_verify($password, $hash);
        }

        // Mientras no se ejecute la migración, la columna `password` mide 32 caracteres y no cabe
        // un hash seguro (60+). En ese caso se sigue usando MD5 para no romper el sistema.
        private static function passwordColumnSupportsHash(){
            static $supports = null;
            if ($supports === null) {
                $query_column = Connection::connect() -> prepare("SELECT CHARACTER_MAXIMUM_LENGTH
                                                                  FROM information_schema.COLUMNS
                                                                  WHERE TABLE_SCHEMA = :db
                                                                  AND TABLE_NAME = 'usuarios'
                                                                  AND COLUMN_NAME = 'password'");
                $query_column -> bindValue(":db", DB_NAME, PDO::PARAM_STR);
                $query_column -> execute();
                $supports = (int)$query_column -> fetchColumn() >= 255;
            }
            return $supports;
        }

        private static function hashPassword($password){
            if (self::passwordColumnSupportsHash()) {
                return password_hash($password, PASSWORD_DEFAULT);
            }
            error_log("[cardiologia] La columna usuarios.password sigue en 32 caracteres: ejecute database/migracion_01_seguridad.sql");
            return md5($password);
        }
    }
?>
