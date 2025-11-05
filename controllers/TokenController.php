<?php
// controllers/TokenController.php
require_once __DIR__ . '/../models/Token.php';

class TokenController {
    private $tokenModel;

    public function __construct() {
        $this->tokenModel = new Token();
    }

    // Listar todos los tokens
    public function listarTokens() {
        return $this->tokenModel->obtenerTokens();
    }

    // Obtener un token por ID
    public function obtenerToken($id_client_api) {
        return $this->tokenModel->obtenerTokenPorId($id_client_api);
    }

    // Actualizar un token
    public function actualizar($id_client_api, $nuevo_token) {
        return $this->tokenModel->actualizarToken($id_client_api, $nuevo_token);
    }
}
