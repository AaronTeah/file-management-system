<?php
include 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

$result = $conn->query("SELECT * FROM files");
$files = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($files);
?>
