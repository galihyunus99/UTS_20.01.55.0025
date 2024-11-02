<?php
header("Content-Type: application/json");

include_once '../config.php';
include_once '../laptop.php';

$database = new Database();
$db = $database->getConnection();

$laptop = new Laptop($db);

$laptop->id = isset($_GET['id']) ? intval($_GET['id']) : die(json_encode(["status" => "error", "message" => "ID is required"]));

if ($laptop->read_single()) {
    $laptop_arr = [
        "status" => "success",
        "data" => [
            "id" => $laptop->id,
            "brand" => $laptop->brand,
            "model" => $laptop->model,
            "price" => $laptop->price,
            "stock" => $laptop->stock
        ]
    ];

    echo json_encode($laptop_arr);
} else {

    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "Laptop not found"]);
}
?>
