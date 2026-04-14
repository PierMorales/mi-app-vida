<?php

class Compra {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerTodas($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM compras
            WHERE usuario_id = ?
            ORDER BY created_at DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($usuario_id, $data) {
        $stmt = $this->db->prepare("
            INSERT INTO compras (usuario_id, nombre_producto, cantidad, precio_estimado, comprado)
            VALUES (?, ?, ?, ?, FALSE)
        ");
        return $stmt->execute([
            $usuario_id,
            $data['nombre_producto'],
            $data['cantidad'],
            $data['precio_estimado']
        ]);
    }

    public function toggleComprado($id, $usuario_id) {
        $stmt = $this->db->prepare("
            UPDATE compras
            SET comprado = NOT comprado
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$id, $usuario_id]);
    }

    public function eliminar($id, $usuario_id) {
        $stmt = $this->db->prepare("
            DELETE FROM compras
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$id, $usuario_id]);
    }

    public function totales($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT
                COALESCE(SUM(CASE WHEN comprado = FALSE THEN (cantidad * precio_estimado) ELSE 0 END), 0) AS total_pendiente,
                COALESCE(SUM(CASE WHEN comprado = TRUE THEN (cantidad * precio_estimado) ELSE 0 END), 0) AS total_comprado,
                COALESCE(SUM(cantidad * precio_estimado), 0) AS total_general
            FROM compras
            WHERE usuario_id = ?
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
