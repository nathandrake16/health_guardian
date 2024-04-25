<?php include 'admin_header.php'; ?>
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <h2>Appointments</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
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
                        $sql_appointments = "SELECT * FROM appointments";
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
<?php include 'admin_footer.php'; ?>
