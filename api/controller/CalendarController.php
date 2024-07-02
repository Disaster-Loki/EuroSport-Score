<?php
require_once '../config/connection.php';
require_once '../model/Calendar.php';

$calendar = new Calendar($conn);
header('Content-Type: application/json');
$endpoint = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if ($endpoint === '/EuroSport-Score/calendar') {
            $response = $calendar->getCalendars();
            echo json_encode($response);
        } else if (preg_match('/\/EuroSport-Score\/calendar\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $calendar->getCalendarById($id);
            echo json_encode($response);
        }
        break;
    case 'POST':
        if ($endpoint === '/EuroSport-Score/calendar') {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $calendar->addCalendar($data);
            echo json_encode($response);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/EuroSport-Score\/calendar\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $response = $calendar->deleteCalendar($id);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if (preg_match('/\/EuroSport-Score\/calendar\/(\d+)/', $endpoint, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $calendar->updateCalendar($id, $data);
            echo json_encode($response);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
        break;
}
?>
