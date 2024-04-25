<?php
require_once "../includes/config.php";

// Check if ambulance ID is provided
if (isset($_POST['ambulance_id'])) {
    $ambulanceId = $_POST['ambulance_id'];

    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM ambulances WHERE ambulance_id = ?");
    $stmt->bind_param("i", $ambulanceId);

    if ($stmt->execute()) {
        // Redirect to ambulances.php with success message
        header("Location: ambulances.php?success=1");
        exit(); // Ensure script execution stops after redirect
    } else {
        echo "Error deleting ambulance: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Ambulance ID not provided.";
}
?>