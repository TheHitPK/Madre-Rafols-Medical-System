<?php
    require_once "Connection.php";

    class Auditoria extends Connection{
        public function registrar($entrada){
            $registrarSQL = "INSERT INTO auditoria (fecha, idUsuario, usuario, accion, modulo, registro_id, descripcion, datos_antes, datos_despues, ip)
                             VALUES (NOW(), :idUsuario, :usuario, :accion, :modulo, :registro_id, :descripcion, :datos_antes, :datos_despues, :ip)";
            $query_registrar = Connection::connect() -> prepare($registrarSQL);
            $query_registrar -> bindValue(":idUsuario", $entrada['idUsuario'], $entrada['idUsuario'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $query_registrar -> bindValue(":usuario", $entrada['usuario'], PDO::PARAM_STR);
            $query_registrar -> bindValue(":accion", $entrada['accion'], PDO::PARAM_STR);
            $query_registrar -> bindValue(":modulo", $entrada['modulo'], PDO::PARAM_STR);
            $query_registrar -> bindValue(":registro_id", $entrada['registro_id'], $entrada['registro_id'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $query_registrar -> bindValue(":descripcion", $entrada['descripcion'], PDO::PARAM_STR);
            $query_registrar -> bindValue(":datos_antes", $entrada['datos_antes'], $entrada['datos_antes'] === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $query_registrar -> bindValue(":datos_despues", $entrada['datos_despues'], $entrada['datos_despues'] === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $query_registrar -> bindValue(":ip", $entrada['ip'], PDO::PARAM_STR);
            return $query_registrar -> execute();
        }

        // Últimos movimientos, del más reciente al más antiguo.
        public function listar($limite = 2000){
            $query_listar = Connection::connect() -> prepare("SELECT idAuditoria, fecha, usuario, accion, modulo, registro_id, descripcion, datos_antes, datos_despues, ip
                                                              FROM auditoria
                                                              ORDER BY idAuditoria DESC
                                                              LIMIT :limite");
            $query_listar -> bindValue(":limite", $limite, PDO::PARAM_INT);
            $query_listar -> execute();
            return $query_listar -> fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
