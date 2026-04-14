<?php
require_once __DIR__ . '/../models/Meta.php';

class MetaController {

    private $meta;

    public function __construct($db) {
        $this->meta = new Meta($db);
    }

    public function index($usuario_id) {
        return $this->meta->obtenerPorUsuario($usuario_id);
    }

    public function store($usuario_id, $data) {

        if ($data['monto_objetivo'] <= 0) {
            die("Monto objetivo inválido");
        }

        return $this->meta->crear(
            $usuario_id,
            $data['nombre_meta'],
            $data['monto_objetivo'],
            $data['fecha_objetivo'],
            $data['tipo']
        );
    }

    public function aportar($id, $usuario_id, $monto) {

        if ($monto <= 0) {
            die("Aporte inválido");
        }

        return $this->meta->agregarAporte($id, $usuario_id, $monto);
    }

    public function destroy($id, $usuario_id) {
        return $this->meta->eliminar($id, $usuario_id);
    }
}
