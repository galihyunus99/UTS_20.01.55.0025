<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");


include_once '../config.php';
include_once '../laptop.php';

$database = new Database();
$db = $database->getConnection();

$laptop = new Laptop($db);

$data = json_decode(file_get_contents("php://input"));

$laptop->id = isset($_GET['id']) ? intval($_GET['id']) : die(json_encode(["status" => "error", "message" => "ID is required"]));

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

    if ($laptop->update()) {
        echo json_encode(["status" => "success", "message" => "Laptop updated successfully"]);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Laptop not found"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Incomplete data"]);
}
?>
