<?php
// models/Token.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config/database.php';

class Token {
    private $conexion;

    public function __construct() {
        $this->conexion = conectarDB();
    }

    // Obtener todos los tokens
    public function obtenerTokens() {
        $resultado = $this->conexion->query("SELECT id_client_api, token FROM tokens_api");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener un token por ID
    public function obtenerTokenPorId($id_client_api) {
        $stmt = $this->conexion->prepare("SELECT id_client_api, token FROM tokens_api WHERE id_client_api = ?");
        $stmt->bind_param("i", $id_client_api);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Actualizar un token
    public function actualizarToken($id_client_api, $nuevo_token) {
        $stmt = $this->conexion->prepare("UPDATE tokens_api SET token = ? WHERE id_client_api = ?");
        $stmt->bind_param("si", $nuevo_token, $id_client_api);
        return $stmt->execute();
    }
}
    