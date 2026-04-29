<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "backend/db.php";

try {
    // Check if passenger_name column exists
    $result = $conn->query("SHOW COLUMNS FROM seat_history LIKE 'passenger_name'");
    if ($result->num_rows == 0) {
        // Add passenger_name column
        $sql1 = "ALTER TABLE seat_history ADD COLUMN passenger_name VARCHAR(255) DEFAULT NULL";
        if ($conn->query($sql1) === TRUE) {
            echo "Added passenger_name column successfully.\n";
        } else {
            echo "Error adding passenger_name column: " . $conn->error . "\n";
        }
    } else {
        echo "passenger_name column already exists.\n";
    }

    // Modify status enum to include 'onboard', 'dropped', 'available'
    $sql2 = "ALTER TABLE seat_history MODIFY COLUMN status ENUM('onboard', 'dropped', 'available', 'maintenance') DEFAULT 'available'";
    if ($conn->query($sql2) === TRUE) {
        echo "Updated status enum successfully.\n";
    } else {
        echo "Error updating status enum: " . $conn->error . "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

$conn->close();
?>
