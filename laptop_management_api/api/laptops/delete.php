<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once '../config.php';
include_once '../laptop.php';

$database = new Database();
$db = $database->getConnection();

$laptop = new Laptop($db);

$laptop->id = isset($_GET['id']) ? intval($_GET['id']) : die(json_encode(["status" => "error", "message" => "ID is required"]));

if ($laptop->delete()) {
    echo json_encode(["status" => "success", "message" => "Laptop deleted successfully"]);
} else {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "Laptop not found or unable to delete"]);
}
?>
