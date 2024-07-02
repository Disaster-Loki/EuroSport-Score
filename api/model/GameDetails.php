<?php
class GameDetails {
    private $conn;
    private $table_name = "GameDetails";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDetails() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addDetail($data) {
        $query = "INSERT INTO " . $this->table_name . " (game_id, player_id, action, minute) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['game_id'], $data['player_id'], $data['action'], $data['minute']]);
        return ['status' => 'success'];
    }

    public function getDetailById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteDetail($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateDetail($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET game_id = ?, player_id = ?, action = ?, minute = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['game_id'], $data['player_id'], $data['action'], $data['minute'], $id]);
        return ['status' => 'success'];
    }
}
?>
