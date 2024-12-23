<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM files WHERE id = $id");
    $file = $result->fetch_assoc();

    if ($file) {
        $filePath = $file['file_path'];
        $fileType = mime_content_type($filePath);

        header("Content-Type: $fileType");
        header("Content-Disposition: inline; filename=\"" . basename($filePath) . "\"");
        readfile($filePath);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "File not found"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "File ID is required"]);
}
?>
