<?php

class Peso {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerTodos($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT * FROM peso
            WHERE usuario_id = ?
            ORDER BY fecha DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($usuario_id, $data) {
        $stmt = $this->db->prepare("
            INSERT INTO peso (usuario_id, fecha, peso)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([
            $usuario_id,
            $data['fecha'],
            $data['peso']
        ]);
    }
}
