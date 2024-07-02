<?php
class Calendar {
    private $conn;
    private $table_name = "Calendar";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCalendars() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCalendar($data) {
        $query = "INSERT INTO " . $this->table_name . " (event_date, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['event_date'], $data['description']]);
        return ['status' => 'success'];
    }

    public function getCalendarById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteCalendar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateCalendar($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET event_date = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['event_date'], $data['description'], $id]);
        return ['status' => 'success'];
    }
}
?>
