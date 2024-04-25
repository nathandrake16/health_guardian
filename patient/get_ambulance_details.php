<?php
require_once "../includes/config.php"; // Database connection

if (isset($_GET['ambulance_id'])) {
    $ambulanceId = $_GET['ambulance_id'];
    $query = "SELECT * FROM ambulances WHERE ambulance_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ambulanceId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $ambulanceDetails = $result->fetch_assoc();
        echo json_encode($ambulanceDetails);
    }
}
?>
