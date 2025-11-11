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
        $resultado = $this->conexion->query("SELECT token FROM tokens_api");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Obtener un token por su valor
    public function obtenerTokenPorToken($token) {
        $stmt = $this->conexion->prepare("SELECT token, estado FROM tokens_api WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Actualizar un token
    public function actualizarToken($token_viejo, $nuevo_token) {
        $stmt = $this->conexion->prepare("UPDATE tokens_api SET token = ? WHERE token = ?");
        $stmt->bind_param("ss", $nuevo_token, $token_viejo);
        return $stmt->execute();
    }

    // Validar token en la base de datos local
    public function validarTokenLocal($token) {
        $tokenData = $this->obtenerTokenPorToken($token);
        if (!$tokenData) {
            return ['status' => false, 'msg' => 'Token no encontrado en la base de datos local.'];
        }
        if ($tokenData['estado'] != 1) {
            return ['status' => false, 'msg' => 'Token inactivo en la base de datos local.'];
        }
        return ['status' => true, 'msg' => 'Token válido en la base de datos local.'];
    }
}
?>
