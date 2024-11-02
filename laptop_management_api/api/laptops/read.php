<?php
header("Content-Type: application/json");

include_once '../config.php';
include_once '../laptop.php';

$database = new Database();
$db = $database->getConnection();
$laptop = new Laptop($db);

$stmt = $laptop->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $laptops_arr = ["status" => "success", "data" => []];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $laptop_item = [
            "id" => $id,
            "brand" => $brand,
            "model" => $model,
            "price" => $price,
            "stock" => $stock
        ];
        array_push($laptops_arr["data"], $laptop_item);
    }
    echo json_encode($laptops_arr);
} else {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "No laptops found."]);
}
?>
