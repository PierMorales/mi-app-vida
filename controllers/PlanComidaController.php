<?php
require_once __DIR__ . '/../models/PlanComida.php';

class PlanComidaController {
    private $model;

    public function __construct($db) {
        $this->model = new PlanComida($db);
    }

    public function index($usuario_id) {
        return $this->model->obtenerTodos($usuario_id);
    }

    public function store($usuario_id, $data) {
        if (empty($data['dia'])) {
            die("Día inválido");
        }
        return $this->model->crear($usuario_id, $data);
    }

    public function destroy($usuario_id, $id) {
        return $this->model->eliminar($id, $usuario_id);
    }
}
