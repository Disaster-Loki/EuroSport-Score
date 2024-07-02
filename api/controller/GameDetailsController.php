<?php
require_once './api/config/connection.php';
require_once './api/model/GameDetails.php';

$details = new GameDetails($conn);
header('Content-Type: application/json');
$endpoint = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if ($endpoint === '/EuroSport-Score/game-details') {
            $response = $details->getDetails();
            echo json_encode($response);
        } else if (preg_match('/\/EuroSport-Score\/game-details\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $details->getDetailById($id);
            echo json_encode($response);
        }
        break;
    case 'POST':
        if ($endpoint === '/EuroSport-Score/game-details') {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $details->addDetail($data);
            echo json_encode($response);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/EuroSport-Score\/game-details\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $details->deleteDetail($id);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if (preg_match('/\/EuroSport-Score\/game-details\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $details->updateDetail($id, $data);
            echo json_encode($response);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
        break;
}
?>
