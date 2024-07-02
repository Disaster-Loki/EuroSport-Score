<?php
class GroupParticipation {
    private $conn;
    private $table_name = "GroupParticipation";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getParticipations() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addParticipation($data) {
        $query = "INSERT INTO " . $this->table_name . " (team_id, group_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['team_id'], $data['group_id']]);
        return ['status' => 'success'];
    }

    public function getParticipationById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteParticipation($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateParticipation($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET team_id = ?, group_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['team_id'], $data['group_id'], $id]);
        return ['status' => 'success'];
    }
}
?>
