<?php
header('Content-Type: application/json');

// URL del API de Docentes (cambia por la URL real de tu API de Docentes)
define('API_DOCENTES_URL', 'https://apidocentes.404brothers.com.pe/api_handler.php');

// Obtener el token y la acción
$token = $_POST['token'] ?? '';
$action = $_GET['action'] ?? '';
$search = $_POST['search'] ?? '';

// Validar que el token no esté vacío
if (empty($token)) {
    echo json_encode([
        'status' => false,
        'type' => 'error',
        'msg' => 'Token no proporcionado.'
    ]);
    exit();
}

// Redirigir la petición al API de Docentes
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, API_DOCENTES_URL . '?' . http_build_query(['action' => $action]));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['token' => $token, 'search' => $search]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Devolver la respuesta del API de Docentes
if ($httpCode === 200) {
    echo $response;
} else {
    echo json_encode([
        'status' => false,
        'type' => 'error',
        'msg' => 'Error al conectar con el API de Docentes.'
    ]);
}
?>

