<?php
require_once '../config/connection.php';
require_once '../model/GameResult.php';

$result = new GameResult($conn);
header('Content-Type: application/json');
$endpoint = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if ($endpoint === '/EuroSport-Score/game-result') {
            $response = $result->getResults();
            echo json_encode($response);
        } else if (preg_match('/\/EuroSport-Score\/game-result\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $result->getResultById($id);
            echo json_encode($response);
        }
        break;
    case 'POST':
        if ($endpoint === '/EuroSport-Score/game-result') {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $result->addResult($data);
            echo json_encode($response);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/EuroSport-Score\/game-result\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $result->deleteResult($id);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if (preg_match('/\/EuroSport-Score\/game-result\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $result->updateResult($id, $data);
            echo json_encode($response);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
        break;
}
?>
