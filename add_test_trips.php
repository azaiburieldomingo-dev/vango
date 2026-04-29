<?php
/**
 * Script to add test trips to the database
 * This helps populate the trips table with sample data for testing
 */

include "backend/db.php";

try {
    // Check if connection is established
    if (!$conn) {
        throw new Exception("Database connection failed.");
    }

    // Insert test trips
    $testTrips = [
        [
            'driver_id' => 2,
            'vehicle_type' => 'van',
            'vehicle_plate' => '13132243555',
            'vehicle_color' => 'red',
            'capacity' => 12,
            'origin' => 'Bongabong',
            'destination' => 'Pinamalayan',
            'booking_status' => 'Available',
            'travel_status' => 'Stationed'
        ],
        [
            'driver_id' => 2,
            'vehicle_type' => 'van',
            'vehicle_plate' => '13132243555',
            'vehicle_color' => 'red',
            'capacity' => 12,
            'origin' => 'Gloria',
            'destination' => 'Padayan',
            'booking_status' => 'Available',
            'travel_status' => 'Stationed'
        ],
        [
            'driver_id' => 2,
            'vehicle_type' => 'van',
            'vehicle_plate' => '13132243555',
            'vehicle_color' => 'red',
            'capacity' => 12,
            'origin' => 'Pasig',
            'destination' => 'Naujan',
            'booking_status' => 'Available',
            'travel_status' => 'Stationed'
        ],
        [
            'driver_id' => 2,
            'vehicle_type' => 'van',
            'vehicle_plate' => '13132243555',
            'vehicle_color' => 'red',
            'capacity' => 12,
            'origin' => 'Bayan ng Victoria',
            'destination' => 'Centro Mall',
            'booking_status' => 'Available',
            'travel_status' => 'Stationed'
        ],
        [
            'driver_id' => 2,
            'vehicle_type' => 'van',
            'vehicle_plate' => '13132243555',
            'vehicle_color' => 'red',
            'capacity' => 12,
            'origin' => 'Calapan',
            'destination' => 'Bongabong',
            'booking_status' => 'Available',
            'travel_status' => 'Stationed'
        ]
    ];

    $inserted = 0;
    foreach ($testTrips as $trip) {
        $sql = "INSERT INTO trips 
                (driver_id, vehicle_type, vehicle_plate, vehicle_color, capacity, origin, destination, booking_status, travel_status)
                VALUES (
                    {$trip['driver_id']},
                    '{$trip['vehicle_type']}',
                    '{$trip['vehicle_plate']}',
                    '{$trip['vehicle_color']}',
                    {$trip['capacity']},
                    '{$trip['origin']}',
                    '{$trip['destination']}',
                    '{$trip['booking_status']}',
                    '{$trip['travel_status']}'
                )";
        
        if ($conn->query($sql)) {
            $inserted++;
            echo "✓ Inserted trip: {$trip['origin']} → {$trip['destination']}" . PHP_EOL;
        } else {
            echo "✗ Failed to insert trip: {$trip['origin']} → {$trip['destination']}" . PHP_EOL;
            echo "Error: " . $conn->error . PHP_EOL;
        }
    }

    echo PHP_EOL . "Total trips inserted: $inserted" . PHP_EOL;

    // Display all trips
    echo PHP_EOL . "All trips in database:" . PHP_EOL;
    $res = $conn->query("SELECT id, origin, destination, capacity, booking_status FROM trips ORDER BY id");
    while ($row = $res->fetch_assoc()) {
        echo "- ID: {$row['id']}, {$row['origin']} → {$row['destination']}, Capacity: {$row['capacity']}, Status: {$row['booking_status']}" . PHP_EOL;
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

$conn->close();
?>
