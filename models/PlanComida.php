<?php

class PlanComida {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerTodos($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM plan_comidas
            WHERE usuario_id = ?
            ORDER BY CASE dia WHEN 'Lunes' THEN 1 WHEN 'Martes' THEN 2 WHEN 'Miércoles' THEN 3 WHEN 'Jueves' THEN 4 WHEN 'Viernes' THEN 5 WHEN 'Sábado' THEN 6 WHEN 'Domingo' THEN 7 END
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($usuario_id, $data) {
        $stmt = $this->db->prepare("
            INSERT INTO plan_comidas (usuario_id, dia, desayuno, almuerzo, cena, calorias_estimadas)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $usuario_id,
            $data['dia'],
            $data['desayuno'] ?? '',
            $data['almuerzo'] ?? '',
            $data['cena'] ?? '',
            $data['calorias_estimadas'] ?? null
        ]);
    }

    public function eliminar($id, $usuario_id) {
        $stmt = $this->db->prepare("
            DELETE FROM plan_comidas
            WHERE id = ? AND usuario_id = ?
        ");
        return $stmt->execute([$id, $usuario_id]);
    }
}
