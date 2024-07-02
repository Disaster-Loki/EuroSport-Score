<?php
class Player {
    private $conn;
    private $table_name = "Player";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPlayers() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPlayer($data) {
        $query = "INSERT INTO " . $this->table_name . " (name, position, date_of_birth) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['position'], $data['date_of_birth']]);
        return ['status' => 'success'];
    }

    public function getPlayerById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletePlayer($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updatePlayer($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET name = ?, position = ?, date_of_birth = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['position'], $data['date_of_birth'], $id]);
        return ['status' => 'success'];
    }
}
?>
