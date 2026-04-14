<?php

class Presupuesto {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerTodos($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM presupuestos
            WHERE usuario_id = ?
            ORDER BY fecha_inicio DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id, $usuario_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM presupuestos
            WHERE id = ? AND usuario_id = ?
        ");
        $stmt->execute([$id, $usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($usuario_id, $data) {
        $stmt = $this->db->prepare("
            INSERT INTO presupuestos (usuario_id, monto, tipo_periodo, fecha_inicio)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $usuario_id,
            $data['monto'],
            $data['tipo_periodo'],
            $data['fecha_inicio']
        ]);
    }

    public function actualizar($id, $usuario_id, $data) {
        $stmt = $this->db->prepare("
            UPDATE presupuestos
            SET monto = ?, tipo_periodo = ?, fecha_inicio = ?
            WHERE id = ? AND usuario_id = ?
        ");

        return $stmt->execute([
            $data['monto'],
            $data['tipo_periodo'],
            $data['fecha_inicio'],
            $id,
            $usuario_id
        ]);
    }

    public function eliminar($id, $usuario_id) {
        $stmt = $this->db->prepare("
            DELETE FROM presupuestos
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$id, $usuario_id]);
    }

    public function obtenerActivo($usuario_id) {
    $stmt = $this->db->prepare("
        SELECT * FROM presupuestos
        WHERE usuario_id = ?
        ORDER BY fecha_inicio DESC
        LIMIT 1
    ");
    $stmt->execute([$usuario_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}

