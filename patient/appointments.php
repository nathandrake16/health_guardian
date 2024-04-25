<?php

include 'patient_header.php';

// Create logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user ID is set in the session
    if (!isset($_SESSION['user_id'])) {
        die("User ID not found in session.");
    }

    // Get form data
    $patient_id = $_SESSION['user_id'];
    $doctor_id = $_POST['specialization'] ?? ''; // Assuming doctor_id is selected specialization
    $name = $_POST['patient_name'] ?? '';
    $problem = $_POST['problem'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';

    // Validate form data
    if (empty($doctor_id) || empty($name) || empty($problem) || empty($date) || empty($time)) {
        die("All fields are required.");
    }

    // Fetch doctor's fee
    require_once "../includes/config.php";
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT fee FROM doctors WHERE id = ?");
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $stmt->store_result();

    // Check if doctor exists
    if ($stmt->num_rows == 0) {
        die("Selected doctor does not exist.");
    }

    $stmt->bind_result($fee);
    $stmt->fetch();
    $stmt->close();

    // Insert appointment into database
    $stmt = $conn->prepare("INSERT INTO appointments (doctor_id, patient_id, name, problem, fee, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisdsss", $doctor_id, $patient_id, $name, $problem, $fee, $date, $time);
    
    if ($stmt->execute()) {
        $bookingSuccessMessage = "Appointment booked successfully!";
    } else {
        $bookingSuccessMessage = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<div class="container mt-5">
    <?php if (!empty($bookingSuccessMessage)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $bookingSuccessMessage; ?>
                    </div>
                <?php endif; ?>
    <div class="card">
        <h5 class="card-header">Book an Appointment</h5>
        <div class="card-body">
            <form id="appointmentForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mb-3">
                    <label for="patient_name" class="form-label">Patient's Name:</label>
                    <input type="text" class="form-control" id="patient_name" name="patient_name" required>
                </div>

                <div class="mb-3">
                    <label for="problem" class="form-label">Patient's Problem:</label>
                    <input type="text" class="form-control" id="problem" name="problem" required>
                </div>

                <div class="mb-3">
                    <label for="specialization" class="form-label">Doctor's Specialization:</label>
                    <select class="form-select" id="specialization" name="specialization" required>
                        <option value="">Select Specialization</option>
                        <?php
                        // Database connection
                        require_once "../includes/config.php";
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $selectedSpecialization = isset($_POST['specialization']) ? $_POST['specialization'] : ''; // Retain selected specialization
                        $result = $conn->query("SELECT specialization, doctor_id FROM doctorspecialization");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $selected = ($selectedSpecialization == $row['specialization']) ? 'selected' : '';
                                echo "<option value='" . $row['doctor_id'] . "' $selected>" . $row['specialization'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div id="doctorDetails" class="mb-3"></div>

                <div class="mb-3">
                    <label for="date" class="form-label">Preferred Date:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                <div class="mb-3">
                    <label for="time" class="form-label">Preferred Time:</label>
                    <input type="time" class="form-control" id="time" name="time" required>
                </div>

                <button type="submit" class="btn btn-primary">Book Appointment</button>
            </form>
        </div>
    </div>
</div>

<?php include 'patient_footer.php'; ?>

<script>
    // Function to fetch and display doctor's details without page refresh
    document.getElementById('specialization').addEventListener('change', function() {
        var specialization = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('doctorDetails').innerHTML = this.responseText;
            }
        };
        xhr.open('POST', 'fetch_doctor_details.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('specialization=' + specialization);
    });
</script>
