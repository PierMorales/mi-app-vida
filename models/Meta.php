<?php

class Meta {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerPorUsuario($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM metas
            WHERE usuario_id = ?
            ORDER BY created_at DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($usuario_id, $nombre, $objetivo, $fecha_objetivo, $tipo) {
        $stmt = $this->db->prepare("
            INSERT INTO metas (usuario_id, nombre_meta, monto_objetivo, monto_actual, fecha_objetivo, tipo)
            VALUES (?, ?, ?, 0, ?, ?)
        ");
        return $stmt->execute([$usuario_id, $nombre, $objetivo, $fecha_objetivo, $tipo]);
    }

    public function agregarAporte($id, $usuario_id, $monto) {
        $stmt = $this->db->prepare("
            UPDATE metas
            SET monto_actual = monto_actual + ?
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$monto, $id, $usuario_id]);
    }

    public function eliminar($id, $usuario_id) {
        $stmt = $this->db->prepare("
            DELETE FROM metas
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$id, $usuario_id]);
    }
}
