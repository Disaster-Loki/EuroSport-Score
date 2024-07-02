<?php
require_once '../config/connection.php';
require_once '../model/Stadium.php';

$stadium = new Stadium($conn);

header('Content-Type: application/json');
$endpoint = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if ($endpoint === '/EuroSport-Score/stadium') {
            $response = $stadium->getStadiums();
            echo json_encode($response);
        } else if (preg_match('/\/EuroSport-Score\/stadium\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $stadium->getStadiumById($id);
            echo json_encode($response);
        }
        break;
    case 'POST':
        if ($endpoint === '/EuroSport-Score/stadium') {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $stadium->addStadium($data);
            echo json_encode($response);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/EuroSport-Score\/stadium\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $stadium->deleteStadium($id);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if (preg_match('/\/EuroSport-Score\/stadium\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $stadium->updateStadium($id, $data);
            echo json_encode($response);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
        break;
}
?>
