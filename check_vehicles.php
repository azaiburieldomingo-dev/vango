<?php
/**
 * Script to check and display vehicle information from the drivers table.
 * Vehicles are stored in the drivers table as per the database schema.
 */

// Include database connection
include "backend/db.php";

// Configurable limit for sample vehicles
$limit = 5;

try {
    // Check if connection is established
    if (!$conn) {
        throw new Exception("Database connection failed.");
    }

    // Prepare and execute query to get sample vehicles and calculate total count
    $stmt = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS id, name as driver_name, vehicle_type, plate, color, capacity FROM drivers LIMIT ?");
    if (!$stmt) {
        throw new Exception("Failed to prepare sample query: " . $conn->error);
    }
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    // Get total count from FOUND_ROWS
    $countResult = $conn->query("SELECT FOUND_ROWS() as count");
    $countRow = $countResult->fetch_assoc();
    $totalVehicles = $countRow['count'];

    echo "Total vehicles: " . $totalVehicles . PHP_EOL;

    if ($totalVehicles > 0) {
        echo "Sample vehicles:" . PHP_EOL;
        while ($row = $result->fetch_assoc()) {
            echo "- {$row['driver_name']} ({$row['vehicle_type']}) - Plate: {$row['plate']}" . PHP_EOL;
        }
    }
    $stmt->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

// Close database connection
$conn->close();
?>
