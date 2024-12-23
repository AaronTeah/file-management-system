<?php
include 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_FILES['file']['type'] !== 'text/csv') {
    echo json_encode(["error" => "Only CSV files are allowed."]);
    exit;
}

$fileName = $_FILES['file']['name'];
$filePath = "uploads/" . basename($fileName);

if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
    $conn->query("INSERT INTO files (file_name, file_path) VALUES ('$fileName', '$filePath')");
    echo json_encode(["message" => "File uploaded successfully"]);
} else {
    echo json_encode(["error" => "File upload failed"]);
}
?>
