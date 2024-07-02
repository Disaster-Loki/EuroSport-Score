<?php
class GroupTable {
    private $conn;
    private $table_name = "GroupTable";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getGroups() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGroup($data) {
        $query = "INSERT INTO " . $this->table_name . " (group_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['group_name']]);
        return ['status' => 'success'];
    }

    public function getGroupById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteGroup($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateGroup($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET group_name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['group_name'], $id]);
        return ['status' => 'success'];
    }
}
?>
