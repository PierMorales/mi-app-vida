<?php

class Deuda {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerTodas($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM deudas
            WHERE usuario_id = ?
            ORDER BY fecha_limite ASC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($usuario_id, $data) {
        $stmt = $this->db->prepare("
            INSERT INTO deudas (usuario_id, descripcion, monto, fecha_limite)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $usuario_id,
            $data['descripcion'],
            $data['monto'],
            $data['fecha_limite']
        ]);
    }

    public function marcarPagada($id, $usuario_id) {
        $stmt = $this->db->prepare("
            UPDATE deudas
            SET estado = 'pagada'
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$id, $usuario_id]);
    }

    public function eliminar($id, $usuario_id) {
        $stmt = $this->db->prepare("
            DELETE FROM deudas
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$id, $usuario_id]);
    }

    public function totalPendiente($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT SUM(monto) FROM deudas
            WHERE usuario_id = ? AND estado = 'pendiente'
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchColumn() ?? 0;
    }
}
