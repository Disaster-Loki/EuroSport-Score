<?php
require_once './api/config/connection.php';
require_once './api/model/Card.php';

$card = new Card($conn);

header('Content-Type: application/json');
$endpoint = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if ($endpoint === '/EuroSport-Score/card') {
            $response = $card->getCards();
            echo json_encode($response);
        } else if (preg_match('/\/EuroSport-Score\/card\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $card->getCardById($id);
            echo json_encode($response);
        }
        break;
    case 'POST':
        if ($endpoint === '/EuroSport-Score/card') {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $card->addCard($data);
            echo json_encode($response);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/EuroSport-Score\/card\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $card->deleteCard($id);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if (preg_match('/\/EuroSport-Score\/card\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $card->updateCard($id, $data);
            echo json_encode($response);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
        break;
}
?>
