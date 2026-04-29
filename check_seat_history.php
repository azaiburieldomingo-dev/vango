<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";
header('Content-Type: application/json');

// Check if seat_history table exists
$result = $conn->query("SHOW TABLES LIKE 'seat_history'");
$tableExists = $result->num_rows > 0;

if ($tableExists) {
    // Get seat_history table columns
    $result = $conn->query("DESCRIBE seat_history");
    $columns = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row;
        }
        echo json_encode(['status' => 'success', 'table_exists' => true, 'columns' => $columns]);
    } else {
        echo json_encode(['status' => 'error', 'error' => $conn->error]);
    }
} else {
    echo json_encode(['status' => 'success', 'table_exists' => false, 'message' => 'seat_history table does not exist']);
}

$conn->close();
?>
