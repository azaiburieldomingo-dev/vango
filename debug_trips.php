<?php
/**
 * Debug script to check trips and test booking query
 */

include "backend/db.php";

try {
    echo "=== TRIPS TABLE ===" . PHP_EOL;
    $res = $conn->query("SELECT * FROM trips");
    while ($row = $res->fetch_assoc()) {
        echo "ID: {$row['id']}, Origin: {$row['origin']}, Destination: {$row['destination']}, Capacity: {$row['capacity']}" . PHP_EOL;
    }

    echo PHP_EOL . "=== TEST BOOKING QUERY FOR TRIP ID 8 ===" . PHP_EOL;
    $trip_id = 8;
    $trip_check = $conn->query("
        SELECT t.capacity, COALESCE(SUM(b.passengers), 0) as booked_seats
        FROM trips t
        LEFT JOIN bookings b ON t.id = b.assigned_vehicle AND b.status='Approved'
        WHERE t.id=$trip_id
        GROUP BY t.id
    ");
    
    if ($trip_check && $trip_data = $trip_check->fetch_assoc()) {
        echo "Trip found!" . PHP_EOL;
        echo "Capacity: {$trip_data['capacity']}" . PHP_EOL;
        echo "Booked seats: {$trip_data['booked_seats']}" . PHP_EOL;
    } else {
        echo "Trip NOT found!" . PHP_EOL;
        echo "Error: " . $conn->error . PHP_EOL;
    }

    echo PHP_EOL . "=== TEST BOOKING QUERY FOR TRIP ID 3 ===" . PHP_EOL;
    $trip_id = 3;
    $trip_check = $conn->query("
        SELECT t.capacity, COALESCE(SUM(b.passengers), 0) as booked_seats
        FROM trips t
        LEFT JOIN bookings b ON t.id = b.assigned_vehicle AND b.status='Approved'
        WHERE t.id=$trip_id
        GROUP BY t.id
    ");
    
    if ($trip_check && $trip_data = $trip_check->fetch_assoc()) {
        echo "Trip found!" . PHP_EOL;
        echo "Capacity: {$trip_data['capacity']}" . PHP_EOL;
        echo "Booked seats: {$trip_data['booked_seats']}" . PHP_EOL;
    } else {
        echo "Trip NOT found!" . PHP_EOL;
        echo "Error: " . $conn->error . PHP_EOL;
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

$conn->close();
?>
