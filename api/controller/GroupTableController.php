<?php
require_once './api/config/connection.php';
require_once './api/model/GroupTable.php';

$table = new GroupTable($conn);
header('Content-Type: application/json');
$endpoint = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if ($endpoint === '/EuroSport-Score/group-table') {
            $response = $table->getGroups();
            echo json_encode($response);
        } else if (preg_match('/\/EuroSport-Score\/group-table\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $table->getGroupById($id);
            echo json_encode($response);
        }
        break;
    case 'POST':
        if ($endpoint === '/EuroSport-Score/group-table') {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $table->addGroup($data);
            echo json_encode($response);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/EuroSport-Score\/group-table\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $table->deleteGroup($id);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if (preg_match('/\/EuroSport-Score\/group-table\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $table->updateGroup($id, $data);
            echo json_encode($response);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
        break;
}
?>
