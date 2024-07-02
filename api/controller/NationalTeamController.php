<?php
require_once '../config/connection.php';
require_once '../model/NationalTeam.php';

$team = new NationalTeam($conn);
header('Content-Type: application/json');
$endpoint = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if ($endpoint === '/EuroSport-Score/national-team') {
            $response = $team->getNationalTeams();
            echo json_encode($response);
        } else if (preg_match('/\/EuroSport-Score\/national-team\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $team->getNationalTeamById($id);
            echo json_encode($response);
        }
        break;
    case 'POST':
        if ($endpoint === '/EuroSport-Score/national-team') {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $team->addNationalTeam($data);
            echo json_encode($response);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/EuroSport-Score\/national-team\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $team->deleteNationalTeam($id);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if (preg_match('/\/EuroSport-Score\/national-team\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $team->updateNationalTeam($id, $data);
            echo json_encode($response);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
        break;
}
?>
