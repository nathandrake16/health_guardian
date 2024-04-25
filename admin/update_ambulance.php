<?php
require_once "../includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are set
    if (isset($_POST['updateId'], $_POST['updateDriverName'], $_POST['updateContact'], $_POST['updateAvailable'])) {
        $ambulanceId = $_POST['updateId'];
        $driverName = $_POST['updateDriverName'];
        $contact = $_POST['updateContact'];
        $available = $_POST['updateAvailable'];

        // Prepare and execute update query
        $stmt = $conn->prepare("UPDATE ambulances SET driver_name = ?, contact = ?, available = ? WHERE ambulance_id = ?");
        $stmt->bind_param("ssii", $driverName, $contact, $available, $ambulanceId);

        if ($stmt->execute()) {
            // Redirect to ambulances.php with success message
            header("Location: ambulances.php?success=1");
            exit(); // Ensure script execution stops after redirect
        } else {
            echo "Error updating ambulance details: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
