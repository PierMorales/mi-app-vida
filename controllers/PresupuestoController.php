<?php
require_once __DIR__ . '/../models/Presupuesto.php';

class PresupuestoController {

    private $model;

    public function __construct($db) {
        $this->model = new Presupuesto($db);
    }

    public function index($usuario_id) {
        return $this->model->obtenerTodos($usuario_id);
    }

    public function show($id, $usuario_id) {
        return $this->model->obtenerPorId($id, $usuario_id);
    }

    public function store($usuario_id, $data) {
        if ($data['monto'] <= 0) die("Monto inválido");

        return $this->model->crear($usuario_id, $data);
    }

    public function update($id, $usuario_id, $data) {
        return $this->model->actualizar($id, $usuario_id, $data);
    }

    public function destroy($usuario_id, $id) {
        return $this->model->eliminar($id, $usuario_id);
    }
}
