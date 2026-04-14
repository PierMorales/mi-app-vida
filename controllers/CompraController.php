<?php
require_once __DIR__ . '/../models/Compra.php';

class CompraController {
    private $model;

    public function __construct($db) {
        $this->model = new Compra($db);
    }

    public function index($usuario_id) {
        return $this->model->obtenerTodas($usuario_id);
    }

    public function store($usuario_id, $data) {
        $cantidad = (int)($data['cantidad'] ?? 0);
        $precio = (float)($data['precio_estimado'] ?? 0);

        if (!$data['nombre_producto']) die("Producto inválido");
        if ($cantidad <= 0) die("Cantidad inválida");
        if ($precio < 0) die("Precio inválido");

        return $this->model->crear($usuario_id, $data);
    }

    public function toggle($usuario_id, $id) {
        return $this->model->toggleComprado($id, $usuario_id);
    }

    public function destroy($usuario_id, $id) {
        return $this->model->eliminar($id, $usuario_id);
    }

    public function totales($usuario_id) {
        return $this->model->totales($usuario_id);
    }
}
