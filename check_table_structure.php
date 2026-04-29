<?php
include "backend/db.php";

try {
    // Check drivers table structure
    $result = $conn->query("DESCRIBE drivers");
    echo "Drivers table structure:\n";
    while ($row = $result->fetch_assoc()) {
        echo $row['Field'] . " - " . $row['Type'] . "\n";
    }

    echo "\n";

    // Check if seat_history table exists
    $result = $conn->query("SHOW TABLES LIKE 'seat_history'");
    if ($result->num_rows > 0) {
        echo "seat_history table exists.\n";
        $result = $conn->query("DESCRIBE seat_history");
        echo "Seat_history table structure:\n";
        while ($row = $result->fetch_assoc()) {
            echo $row['Field'] . " - " . $row['Type'] . "\n";
        }
    } else {
        echo "seat_history table does not exist.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

$conn->close();
?>
