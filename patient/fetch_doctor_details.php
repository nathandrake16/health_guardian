<?php
// Fetch doctor's details based on selected specialization and return HTML response

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['specialization'])) {
    $selectedDoctorId = $_POST['specialization'];
    // Database connection
    require_once "../includes/config.php";
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT name, fee FROM doctors WHERE id = ?");
    $stmt->bind_param("i", $selectedDoctorId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($doctorName, $fee);
    $stmt->fetch();

    // Display doctor's name and fee
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<p class='card-text'>Doctor's Name: <strong>$doctorName</strong></p>";
    echo "<p class='card-text'>Consultation Fee (Taka): <strong>$fee</strong></p>";
    echo "</div>";
    echo "</div>";

    $stmt->close(); // Close statement
    $conn->close(); // Close connection
}
?>
