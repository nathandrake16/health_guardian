<?php include 'patient_header.php'; ?>
<?php


require_once "../includes/config.php"; // Database connection

// Fetch ambulances data
$query = "SELECT * FROM ambulances";
$result = $conn->query($query);

$ambulances = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ambulances[] = $row;
    }
}

$bookingSuccessMessage = ''; // Initialize empty message

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $ambulanceId = $_POST['ambulance_id'];
    $patientId = $_SESSION['user_id']; // Assuming patient ID is stored in session
    $bookingTime = date('Y-m-d H:i:s');

    // Insert booking into database
    $stmt = $conn->prepare("INSERT INTO ambulance_bookings (ambulance_id, patient_id, booking_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $ambulanceId, $patientId, $bookingTime);
    if ($stmt->execute()) {
        $bookingSuccessMessage = "Ambulance booking successful!";
    } else {
        $bookingSuccessMessage = "Ambulance booking failed!";
    }
}
?>

<div class="container mt-5 mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Ambulance Booking</h5>
                <div class="card-body">
                    <?php if (!empty($bookingSuccessMessage)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $bookingSuccessMessage; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label for="ambulance" class="form-label">Select Ambulance</label>
                            <select class="form-select" id="ambulance" name="ambulance_id" required>
                                <option value="" selected disabled>Select Ambulance</option>
                                <?php foreach ($ambulances as $ambulance): ?>
                                    <option value="<?php echo $ambulance['ambulance_id']; ?>"><?php echo $ambulance['driver_name']; ?></option>
                                <?php endforeach; ?>
                                
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Book Ambulance</button>
                    </form>
                </div>
            </div>
            <div id="ambulanceDetails" class="mt-3" style="display: none;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" id="driverName"></h5>
                        <p class="card-text">Contact: <span id="contact"></span></p>
                        <!-- Add more details here as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'patient_footer.php'; ?>

<script>
    document.getElementById('ambulance').addEventListener('change', function() {
        var ambulanceId = this.value;
        if (ambulanceId) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_ambulance_details.php?ambulance_id=' + encodeURIComponent(ambulanceId), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('driverName').textContent = data.driver_name;
                    document.getElementById('contact').textContent = data.contact;
                    document.getElementById('ambulanceDetails').style.display = 'block';
                }
            };
            xhr.send();
        } else {
            document.getElementById('ambulanceDetails').style.display = 'none';
        }
    });
</script>
