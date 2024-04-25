<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle user roles
if ($_SESSION['role'] == 'doctor') {
    header("Location: ../doctor/doctor_dashboard.php");
} elseif ($_SESSION['role'] == 'patient') {
    header("Location: ../patient/patient_dashboard.php");
} elseif ($_SESSION['role'] == 'admin') {
    header("Location: ../admin/admin_dashboard.php");
} else {
    // Invalid role
    echo "Invalid role";
    exit();
}
?>
