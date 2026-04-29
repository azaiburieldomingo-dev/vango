<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "backend/db.php";

try {
    // Drop table if exists
    $dropSql = "DROP TABLE IF EXISTS seat_history";
    if ($conn->query($dropSql) === TRUE) {
        echo "Table seat_history dropped successfully.\n";
    } else {
        echo "Error dropping table: " . $conn->error . "\n";
    }

    // Create seat_history table with correct structure
    $createSql = "
        CREATE TABLE seat_history (
            id INT AUTO_INCREMENT PRIMARY KEY,
            driver_id INT NOT NULL,
            seat_number INT NOT NULL,
            status ENUM('onboard', 'dropped', 'available', 'maintenance') DEFAULT 'available',
            passenger_name VARCHAR(255),
            location VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";

    if ($conn->query($createSql) === TRUE) {
        echo "Table seat_history created successfully.\n";

        // Insert some sample data for testing
        $sampleData = [
            [1, 1, 'onboard', 'John Doe', 'Downtown'],
            [1, 2, 'available', null, 'Downtown'],
            [2, 1, 'dropped', 'Jane Smith', 'Airport'],
            [2, 2, 'available', null, 'Airport'],
            [3, 1, 'maintenance', null, 'Garage'],
        ];

        $stmt = $pdo->prepare("INSERT INTO seat_history (driver_id, seat_number, status, passenger_name, location) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE status = VALUES(status), passenger_name = VALUES(passenger_name), location = VALUES(location), updated_at = CURRENT_TIMESTAMP");

        foreach ($sampleData as $data) {
            $stmt->execute($data);
        }

        echo "Sample data inserted successfully.\n";
    } else {
        echo "Error creating table: " . $conn->error . "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

$conn->close();
?>
