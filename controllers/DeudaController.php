<?php
require_once __DIR__ . '/../models/Deuda.php';

class DeudaController {

    private $model;

    public function __construct($db) {
        $this->model = new Deuda($db);
    }

    public function index($usuario_id) {
        return $this->model->obtenerTodas($usuario_id);
    }

    public function store($usuario_id, $data) {
        return $this->model->crear($usuario_id, $data);
    }

    public function pagar($usuario_id, $id) {
        return $this->model->marcarPagada($id, $usuario_id);
    }

    public function destroy($usuario_id, $id) {
        return $this->model->eliminar($id, $usuario_id);
    }

    public function totalPendiente($usuario_id) {
        return $this->model->totalPendiente($usuario_id);
    }
}
