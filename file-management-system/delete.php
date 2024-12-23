<?php
include 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Enable error logging for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    error_log("Delete request received for ID: $id");

    $result = $conn->query("SELECT file_path FROM files WHERE id = $id");
    $file = $result->fetch_assoc();

    if ($file) {
        $filePath = $file['file_path'];
        error_log("File path from database: $filePath");

        // Check if the file exists
        if (file_exists($filePath)) {
            error_log("File exists on the server. Attempting to delete...");
            if (unlink($filePath)) { // Delete the file
                error_log("File deleted successfully");
                // Delete the record from the database
                $conn->query("DELETE FROM files WHERE id = $id");
                echo json_encode(["message" => "File and record deleted successfully"]);
                http_response_code(200);
            } else {
                error_log("Failed to delete file from the server");
                echo json_encode(["error" => "Failed to delete the file from the server"]);
                http_response_code(500);
            }
        } else {
            // File already deleted, remove only the database record
            error_log("File not found on the server. Removing record from database...");
            $conn->query("DELETE FROM files WHERE id = $id");
            echo json_encode(["message" => "Record deleted, but file not found on the server"]);
            http_response_code(200);
        }
    } else {
        error_log("File record not found in the database for ID: $id");
        echo json_encode(["error" => "File record not found in the database"]);
        http_response_code(404);
    }
} else {
    error_log("Invalid delete request: No ID provided");
    echo json_encode(["error" => "Invalid request"]);
    http_response_code(400);
}
?>
