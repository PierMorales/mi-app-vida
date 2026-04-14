<?php
require_once __DIR__ . '/../models/Rutina.php';

class RutinaController {

    private $model;

    public function __construct($db) {
        $this->model = new Rutina($db);
    }

    public function index($usuario_id) {
        return $this->model->obtenerTodas($usuario_id);
    }

    public function store($usuario_id, $data) {
        if (empty($data['dia']) || empty($data['tipo']) || empty($data['ejercicios'])) {
            die("Datos incompletos");
        }
        return $this->model->crear($usuario_id, $data);
    }

    public function destroy($usuario_id, $id) {
        return $this->model->eliminar($id, $usuario_id);
    }
}
