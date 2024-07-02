<?php
class Card {
    private $conn;
    private $table_name = "Card";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCards() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCard($data) {
        $query = "INSERT INTO " . $this->table_name . " (player_id, card_type, minute) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['player_id'], $data['card_type'], $data['minute']]);
        return ['status' => 'success'];
    }

    public function getCardById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteCard($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
    }

    public function updateCard($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET player_id = ?, card_type = ?, minute = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$data['player_id'], $data['card_type'], $data['minute'], $id]);
        return ['status' => 'success'];
    }
}
?>
