<?php
class Stadium {
    private $conn;
    private $table_name = "Stadium";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getStadiums() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addStadium($data) {
        $query = "INSERT INTO " . $this->table_name . " (name, city, capacity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['city'], $data['capacity']]);
        return ['status' => 'success'];
    }

    public function getStadiumById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteStadium($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateStadium($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET name = ?, city = ?, capacity = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['city'], $data['capacity'], $id]);
        return ['status' => 'success'];
    }
}
?>
