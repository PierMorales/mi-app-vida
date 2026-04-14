<?php

class Rutina {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerTodas($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM rutinas
            WHERE usuario_id = ?
            ORDER BY CASE dia WHEN 'Lunes' THEN 1 WHEN 'Martes' THEN 2 WHEN 'Miércoles' THEN 3 WHEN 'Jueves' THEN 4 WHEN 'Viernes' THEN 5 WHEN 'Sábado' THEN 6 WHEN 'Domingo' THEN 7 END
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($usuario_id, $data) {
        $stmt = $this->db->prepare("
            INSERT INTO rutinas (usuario_id, dia, tipo, ejercicios)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([
            $usuario_id,
            $data['dia'],
            $data['tipo'],
            $data['ejercicios']
        ]);
    }

    public function eliminar($id, $usuario_id) {
        $stmt = $this->db->prepare("
            DELETE FROM rutinas
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$id, $usuario_id]);
    }
}
