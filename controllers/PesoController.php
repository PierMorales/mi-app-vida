<?php
require_once __DIR__ . '/../models/Peso.php';

class PesoController {

    private $model;

    public function __construct($db) {
        $this->model = new Peso($db);
    }

    public function index($usuario_id) {
        return $this->model->obtenerTodos($usuario_id);
    }

    public function store($usuario_id, $data) {
        return $this->model->crear($usuario_id, $data);
    }
}
