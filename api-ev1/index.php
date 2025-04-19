<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once './config/database.php';
require_once './controllers/ServicioController.php';
require_once './controllers/NosotrosController.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

// Determinar la ruta solicitada
$request_uri = $_SERVER['REQUEST_URI'];
$uri_parts = explode('/', trim($request_uri, '/'));
$endpoint = end($uri_parts);

// Si estamos usando parámetros en la URL (por ejemplo: index.php?action=nosotros)
if (isset($_GET['action'])) {
    $endpoint = $_GET['action'];
} else {
    $endpoint = 'servicios';
}

$data = json_decode(file_get_contents("php://input"), true);
$id = isset($_GET['id']) ? $_GET['id'] : null;

$data = null;
if ($method === 'POST' || $method === 'PUT') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['mensaje' => 'JSON inválido: ' . json_last_error_msg()]);
        exit;
    }
}

switch ($endpoint) {
    case 'servicios':
        $servicioController = new ServicioController($db);
        
        switch ($method) {
            case 'GET':
                $servicioController->obtenerServicios();
                break;
                
            case 'POST':
                if (!empty($data['nombre'])) {
                    $descripcion = isset($data['descripcion']) ? $data['descripcion'] : '';
                    $servicioController->insertarServicio($data['nombre'], $descripcion);
                } else {
                    http_response_code(400);
                    echo json_encode(['mensaje' => 'El nombre del servicio es obligatorio']);
                }
                break;
                
            case 'PUT':
                if ($id && !empty($data['nombre'])) {
                    $descripcion = isset($data['descripcion']) ? $data['descripcion'] : '';
                    $servicioController->actualizarServicio($id, $data['nombre'], $descripcion);
                } else {
                    http_response_code(400);
                    echo json_encode(['mensaje' => 'Se requiere ID y nombre del servicio']);
                }
                break;
                
            case 'DELETE':
                if ($id) {
                    $servicioController->eliminarServicio($id);
                } else {
                    http_response_code(400);
                    echo json_encode(['mensaje' => 'Se requiere ID del servicio a eliminar']);
                }
                break;
                
            default:
                http_response_code(405);
                echo json_encode(['mensaje' => "Método $method no permitido para servicios"]);
                break;
        }
        break;
        
    case 'nosotros':
        $nosotrosController = new NosotrosController($db);
        
        switch ($method) {
            case 'GET':
                $nosotrosController->obtenerNosotros();
                break;
                
            case 'POST':
                if (!empty($data['titulo']) && !empty($data['descripcion'])) {
                    $nosotrosController->insertarSeccion($data['titulo'], $data['descripcion']);
                } else {
                    http_response_code(400);
                    echo json_encode(['mensaje' => 'Se requieren título y descripción']);
                }
                break;
                
            case 'PUT':
                if ($id && !empty($data['titulo']) && !empty($data['descripcion'])) {
                    $nosotrosController->actualizarSeccion($id, $data['titulo'], $data['descripcion']);
                } else {
                    http_response_code(400);
                    echo json_encode(['mensaje' => 'Se requieren ID, título y descripción']);
                }
                break;
                
            case 'DELETE':
                if ($id) {
                    $nosotrosController->eliminarSeccion($id);
                } else {
                    http_response_code(400);
                    echo json_encode(['mensaje' => 'Se requiere ID de la sección a eliminar']);
                }
                break;
                
            default:
                http_response_code(405);
                echo json_encode(['mensaje' => "Método $method no permitido para nosotros"]);
                break;
        }
        break;
        
    default:
        http_response_code(404);
        echo json_encode(['mensaje' => "Endpoint no encontrado"]);
        break;
}
?>