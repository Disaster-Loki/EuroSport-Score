<?php
require_once '../config/connection.php';
require_once '../model/City.php';

$city = new City($conn);
header('Content-Type: application/json');
$endpoint = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if ($endpoint === '/EuroSport-Score/city') {
            $response = $city->getCities();
            echo json_encode($response);
        } else if (preg_match('/^\/EuroSport-Score\/city\/(\d+)$/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $city->getCityById($id);
            echo json_encode($response);
        }
        break;
    case 'POST':
        if ($endpoint === '/EuroSport-Score/city') {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $city->addCity($data);
            echo json_encode($response);
        }
        break;        
    case 'DELETE':
        if (preg_match('/^\/EuroSport-Score\/city\/(\d+)$/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $city->deleteCity($id);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if (preg_match('/^\/EuroSport-Score\/city\/(\d+)$/', $endpoint, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $city->updateCity($id, $data);
            echo json_encode($response);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Método não permitido']);
}

?>
