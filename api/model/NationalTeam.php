<?php
class NationalTeam {
    private $conn;
    private $table_name = "NationalTeam";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTeams() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTeam($data) {
        $query = "INSERT INTO " . $this->table_name . " (name, coach, ranking) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['coach'], $data['ranking']]);
        return ['status' => 'success'];
    }

    public function getTeamById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteTeam($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateTeam($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET name = ?, coach = ?, ranking = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['coach'], $data['ranking'], $id]);
        return ['status' => 'success'];
    }
}
?>
