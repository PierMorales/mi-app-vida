<?php

class Gasto {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerPorUsuario($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM gastos
            WHERE usuario_id = ?
            ORDER BY fecha DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($usuario_id, $fecha, $categoria, $monto, $descripcion) {
        $stmt = $this->db->prepare("
            INSERT INTO gastos (usuario_id, fecha, categoria, monto, descripcion)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$usuario_id, $fecha, $categoria, $monto, $descripcion]);
    }

    public function eliminar($id, $usuario_id) {
        $stmt = $this->db->prepare("
            DELETE FROM gastos
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$id, $usuario_id]);
    }

    public function totalMes($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT SUM(monto)
            FROM gastos
            WHERE usuario_id = ?
            AND EXTRACT(MONTH FROM fecha) = EXTRACT(MONTH FROM CURRENT_DATE)
            AND EXTRACT(YEAR FROM fecha) = EXTRACT(YEAR FROM CURRENT_DATE)
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchColumn() ?? 0;
    }

    public function totalPeriodo($usuario_id, $fecha_inicio) {
    $stmt = $this->db->prepare("
        SELECT COALESCE(SUM(monto),0)
        FROM gastos
        WHERE usuario_id = ?
        AND fecha >= ?
    ");
    $stmt->execute([$usuario_id, $fecha_inicio]);
    return $stmt->fetchColumn();
}

}

