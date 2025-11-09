<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

// Obtener el token
$token = $_POST['token'] ?? '';

// Validar que el token no esté vacío
if (empty($token)) {
    echo json_encode([
        'status' => false,
        'type' => 'error',
        'msg' => 'Token no proporcionado.'
    ]);
    exit();
}

// Validar el token en la base de datos de CLIENTEAPI
$conexion = conectarDB();
$stmt = $conexion->prepare("SELECT * FROM tokens_api WHERE token = ? AND estado = 1");
$stmt->bind_param("s", $token);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo json_encode([
        'status' => false,
        'type' => 'error',
        'msg' => 'Token no encontrado o inactivo en CLIENTEAPI.'
    ]);
    exit();
}

// Validar el token en APIDOCENTES
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://tudominio.com/APIDOCENTES/api_handler.php?action=validarToken');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['token' => $token]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode([
        'status' => false,
        'type' => 'error',
        'msg' => 'Error al conectar con APIDOCENTES.'
    ]);
    exit();
}

echo $response;
?>
