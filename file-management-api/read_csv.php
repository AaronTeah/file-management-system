<?php
include 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $fileId = intval($_GET['id']);
    $result = $conn->query("SELECT file_path FROM files WHERE id = $fileId");

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = $row['file_path'];

        if (file_exists($filePath)) {
            $csvData = [];
            if (($handle = fopen($filePath, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $csvData[] = $data;
                }
                fclose($handle);
            }
            echo json_encode($csvData);
        } else {
            echo json_encode(["error" => "File does not exist at the specified path: $filePath"]);
        }
    } else {
        echo json_encode(["error" => "File not found in database"]);
    }
} else {
    echo json_encode(["error" => "Invalid or missing 'id' parameter"]);
}
?>
