<?php
class Laptop {
    private $conn;
    private $table = "laptops";

    public $id;
    public $brand;
    public $model;
    public $price;
    public $stock;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function read_single() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->brand = $row['brand'];
            $this->model = $row['model'];
            $this->price = $row['price'];
            $this->stock = $row['stock'];
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " SET brand=:brand, model=:model, price=:price, stock=:stock";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":brand", $this->brand);
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":stock", $this->stock);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET brand=:brand, model=:model, price=:price, stock=:stock WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":brand", $this->brand);
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
