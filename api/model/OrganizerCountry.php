<?php
class OrganizerCountry {
    private $conn;
    private $table_name = "OrganizerCountry";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCountries() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCountry($data) {
        $query = "INSERT INTO " . $this->table_name . " (name, code) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['code']]);
        return ['status' => 'success'];
    }

    public function getCountryById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteCountry($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateCountry($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET name = ?, code = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['code'], $id]);
        return ['status' => 'success'];
    }
}
?>
