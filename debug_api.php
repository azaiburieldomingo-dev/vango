<?php
/**
 * Debug script to check what the trips API returns
 */

include "backend/db.php";

try {
    echo "=== TRIPS API RESPONSE ===" . PHP_EOL;
    $res = $conn->query("SELECT * FROM trips");
    $trips = [];
    while ($row = $res->fetch_assoc()) {
        $trips[] = $row;
    }
    echo json_encode($trips, JSON_PRETTY_PRINT) . PHP_EOL;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

$conn->close();
?>
