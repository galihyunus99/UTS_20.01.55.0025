<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");


include_once '../config.php';
include_once '../laptop.php';

$database = new Database();
$db = $database->getConnection();

$laptop = new Laptop($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->brand) &&
    !empty($data->model) &&
    isset($data->price) &&
    isset($data->stock)
) {
 
    $laptop->brand = htmlspecialchars(strip_tags($data->brand));
    $laptop->model = htmlspecialchars(strip_tags($data->model));
    $laptop->price = floatval($data->price);
    $laptop->stock = intval($data->stock);

    if ($laptop->create()) {
        http_response_code(201);
        echo json_encode(["status" => "success", "message" => "Laptop created successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Unable to create laptop"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Incomplete data"]);
}
?>
