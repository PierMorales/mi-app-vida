<?php
require_once __DIR__ . '/../models/Gasto.php';

class GastoController {

    private $gasto;

    public function __construct($db) {
        $this->gasto = new Gasto($db);
    }

    public function index($usuario_id) {
        return $this->gasto->obtenerPorUsuario($usuario_id);
    }

    public function store($usuario_id, $data) {

        if ($data['monto'] <= 0) {
            die("Monto inválido");
        }

        return $this->gasto->crear(
            $usuario_id,
            $data['fecha'],
            $data['categoria'],
            $data['monto'],
            $data['descripcion']
        );
    }

    public function destroy($id, $usuario_id) {
        return $this->gasto->eliminar($id, $usuario_id);
    }

    public function totalMes($usuario_id) {
        return $this->gasto->totalMes($usuario_id);
    }
}
