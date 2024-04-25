<?php include 'admin_header.php'; ?>
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <h2>Patient</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Phone</th>
                            <th>Sex</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../includes/config.php"; 
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_patient'])) {
                            $patient_id = $_POST['patient_id'];
                         
                            
                            // Delete associated record from the users table
                            $sql_delete_users = "DELETE FROM users WHERE id = (SELECT user_id FROM patients WHERE id = $patient_id)";
                            if ($conn->query($sql_delete_users) === FALSE) {
                                echo '<div class="alert alert-danger" role="alert">Error deleting associated user: ' . $conn->error . '</div>';
                            }
                            
                            // Delete patient record from the patients table
                            $sql_delete_patient = "DELETE FROM patients WHERE id = $patient_id";
                            if ($conn->query($sql_delete_patient) === TRUE) {
                                echo '<div class="alert alert-success" role="alert">Patient deleted successfully!</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Error deleting patient: ' . $conn->error . '</div>';
                            }
                        }

                        $sql = "SELECT * FROM patients";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['name'] . '</td>';
                                echo '<td>'. $row['address'] .'</td>';
                                echo '<td>'. $row['height'] .'</td>';
                                echo '<td>'. $row['weight'] .'</td>';
                                echo '<td>'. $row['phone'] .'</td>';
                                echo '<td>'. $row['sex'] .'</td>';
                                echo '<td>
                                        <form method="post" action="">
                                            <input type="hidden" name="patient_id" value="' . $row['id'] . '">
                                            <button type="submit" class="btn btn-danger" name="delete_patient">Delete</button>
                                        </form>
                                    </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7" class="text-center">No patients found</td></tr>';
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
