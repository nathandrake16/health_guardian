<?php include 'doctor_header.php'; ?>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <h2>Appointments</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search by patient name..." onkeyup="searchPatients()">
            </div>
            
            <!-- Appointments Table -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../includes/config.php";
                        
                        // Fetch appointments data
                        $sql_appointments = "SELECT * FROM users inner join doctors on users.id = doctors.user_id inner join appointments on doctors.id = appointments.doctor_id where doctors.user_id = $_SESSION[user_id]";
                        $result_appointments = $conn->query($sql_appointments);
                        $appointments = array();

                        if ($result_appointments->num_rows > 0) {
                            while ($row_appointment = $result_appointments->fetch_assoc()) {
                                $appointments[$row_appointment['doctor_id']][] = $row_appointment;
                            }

                            foreach ($appointments as $doctor_id => $doctor_appointments) {
                                $sql_doctor = "SELECT name FROM doctors WHERE id = $doctor_id";
                                $result_doctor = $conn->query($sql_doctor);
                                $row_doctor = $result_doctor->fetch_assoc();
                                
                                foreach ($doctor_appointments as $appointment) {
                                    echo '<tr>';
                                    echo '<td>' . $appointment['name'] . '</td>';
                                    echo '<td>' . $row_doctor['name'] . '</td>';
                                    echo '<td>' . $appointment['date'] . '</td>';
                                    echo '<td>' . $appointment['time'] . '</td>';
                                    echo '</tr>';
                                }
                            }
                        } else {
                            echo '<tr><td colspan="5" class="text-center">No appointments found</td></tr>';
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'doctor_footer.php'; ?>

<script>
function searchPatients() {
    // Get the input value
    var input = document.getElementById("searchInput").value.toUpperCase();

    // Get the table rows
    var table = document.querySelector(".table-striped");
    var rows = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (var i = 0; i < rows.length; i++) {
        var patientName = rows[i].getElementsByTagName("td")[0]; // Assuming the patient name is in the first column
        if (patientName) {
            var txtValue = patientName.textContent || patientName.innerText;
            if (txtValue.toUpperCase().indexOf(input) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}
</script>
