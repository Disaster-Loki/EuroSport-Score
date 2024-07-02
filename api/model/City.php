<?php
class City {
    private $conn;
    private $table_name = "City";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCities() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCity($data) {
        $query = "INSERT INTO " . $this->table_name . " (name, country, population, points_of_interest, typical_climate) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['country'], $data['population'], $data['points_of_interest'], $data['typical_climate']]);
        return ['status' => 'success'];
    }

    public function getCityById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteCity($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateCity($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET name = ?, country = ?, population = ?, points_of_interest = ?, typical_climate = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['name'], $data['country'], $data['population'], $data['points_of_interest'], $data['typical_climate'], $id]);
        return ['status' => 'success'];
    }
}
?>
