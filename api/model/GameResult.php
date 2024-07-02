<?php
class GameResult {
    private $conn;
    private $table_name = "GameResult";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getResults() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addResult($data) {
        $query = "INSERT INTO " . $this->table_name . " (team_1, team_2, score_1, score_2, date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['team_1'], $data['team_2'], $data['score_1'], $data['score_2'], $data['date']]);
        return ['status' => 'success'];
    }

    public function getResultById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteResult($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateResult($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET team_1 = ?, team_2 = ?, score_1 = ?, score_2 = ?, date = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['team_1'], $data['team_2'], $data['score_1'], $data['score_2'], $data['date'], $id]);
        return ['status' => 'success'];
    }
}
?>
