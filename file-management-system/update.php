<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

header("Content-Type: application/json");
include 'db.php';

parse_str(file_get_contents("php://input"), $_PUT);

if (isset($_PUT['id']) && isset($_PUT['description'])) {
    $id = $_PUT['id'];
    $description = $_PUT['description'];

    $sql = "UPDATE files SET description = '$description' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "File updated successfully"]);
    } else {
        echo json_encode(["error" => "Failed to update file"]);
    }
} else {
    echo json_encode(["error" => "Invalid input"]);
}
?>
