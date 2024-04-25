<?php include 'admin_header.php'; ?>
<div class="container-fluid">
<div class="row mt-3">
        <div class="col">
            <h2>Doctors</h2>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <a href="add_doctor.php" class="btn btn-primary">Add Doctor</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Qualification</th>
                            <th>Phone</th>
                            <th>Points</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../includes/config.php";
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_doctor'])) {
                            $doctor_id = $_POST['doctor_id'];

                            // Delete associated record from the users table
                            $sql_delete_users = "DELETE FROM users WHERE id = (SELECT user_id FROM doctors WHERE id = $doctor_id)";
                            if ($conn->query($sql_delete_users) === FALSE) {
                                echo '<div class="alert alert-danger" role="alert">Error deleting associated user: ' . $conn->error . '</div>';
                            }

                            // Delete doctor record from the doctors table
                            $sql_delete_doctor = "DELETE FROM doctors WHERE id = $doctor_id";
                            if ($conn->query($sql_delete_doctor) === TRUE) {
                                echo '<div class="alert alert-success" role="alert">Doctor deleted successfully!</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Error deleting doctor: ' . $conn->error . '</div>';
                            }
                        }

                        $sql = "SELECT * FROM doctors";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['name'] . '</td>';
                                echo '<td>' . $row['specialization'] . '</td>';
                                echo '<td>' . $row['phone'] . '</td>';
                                echo '<td>' . $row['fee'] . '</td>';
                                echo '<td>
                                        <form method="post" action="">
                                            <input type="hidden" name="doctor_id" value="' . $row['id'] . '">
                                            <button type="submit" class="btn btn-danger" name="delete_doctor">Delete</button>
                                        </form>
                                    </td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5" class="text-center">No doctors found</td></tr>';
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