<?php
require_once '../config/connection.php';
require_once '../model/Player.php';

$database = new Connection();
$db = $database->getConnection();
$player = new Player($db);

header('Content-Type: application/json');
$endpoint = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if ($endpoint === '/EuroSport-Score/player') {
            $response = $player->getPlayers();
            echo json_encode($response);
        } else if (preg_match('/^\/EuroSport-Score\/player\/(\d+)$/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $player->getPlayerById($id);
            echo json_encode($response);
        }
        break;
    case 'POST':
        if ($endpoint === '/EuroSport-Score/player') {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $player->addPlayer($data);
            echo json_encode($response);
        }
        break;        
    case 'DELETE':
        if (preg_match('/^\/EuroSport-Score\/player\/(\d+)$/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $player->deletePlayer($id);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if (preg_match('/^\/EuroSport-Score\/player\/(\d+)$/', $endpoint, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $player->updatePlayer($id, $data);
            echo json_encode($response);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Método não permitido']);
}
?>
