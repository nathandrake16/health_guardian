<?php include 'admin_header.php'; ?>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <h2>Ambulance</h2>
        </div>
    </div>
    <?php

    if (isset($_GET['success']) && $_GET['success'] == 1) {
        // Display success Bootstrap alert
        echo '<div class="alert alert-success" role="alert">
            Ambulance details updated successfully!
          </div>';

    }
    
    ?>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Driver Name</th>
                            <th>Contact</th>
                            <th>Available</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../includes/config.php";
                        $sql = "SELECT * FROM ambulances";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['ambulance_id'] . '</td>';
                                echo '<td>' . $row['driver_name'] . '</td>';
                                echo '<td>' . $row['contact'] . '</td>';
                                echo '<td>' . ($row['available'] == 0 ? 'Available' : 'Not Available') . '</td>';
                                echo '<td>';
                                echo '<button type="button" class="btn btn-danger btn-sm me-2" onclick="deleteAmbulance(' . $row['ambulance_id'] . ')">Delete</button>';
                                echo '<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="' . $row['ambulance_id'] . '" data-driver="' . $row['driver_name'] . '" data-contact="' . $row['contact'] . '" data-available="' . $row['available'] . '">Update</button>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5" class="text-center">No ambulances found</td></tr>';
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Ambulance Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" method="post" action="update_ambulance.php">
                    <div class="mb-3">
                        <label for="updateDriverName" class="form-label">Driver Name:</label>
                        <input type="text" class="form-control" id="updateDriverName" name="updateDriverName" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateContact" class="form-label">Contact:</label>
                        <input type="text" class="form-control" id="updateContact" name="updateContact" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateAvailable" class="form-label">Available:</label>
                        <select class="form-select" id="updateAvailable" name="updateAvailable" required>
                            <option value="0">Available</option>
                            <option value="1">Not Available</option>
                        </select>
                    </div>
                    <input type="hidden" id="updateId" name="updateId">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'admin_footer.php'; ?>

<script>
    // JavaScript function for handling ambulance deletion
    function deleteAmbulance(ambulanceId) {
        if (confirm('Are you sure you want to delete this ambulance?')) {
            // Send AJAX request to delete_ambulance.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle response
                    alert(this.responseText); // Display success/failure message
                    // Reload the page or update the table as needed
                    location.reload(); // Reload the page to reflect changes
                }
            };
            xhr.open('POST', 'delete_ambulance.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('ambulance_id=' + ambulanceId);
        }
    }

    // JavaScript function for handling update modal
    var updateModal = document.getElementById('updateModal');
    updateModal.addEventListener('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        var button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        var ambulanceId = button.getAttribute('data-id');
        var driverName = button.getAttribute('data-driver');
        var contact = button.getAttribute('data-contact');
        var available = button.getAttribute('data-available');
        // Update the modal's content
        var modalTitle = updateModal.querySelector('.modal-title');
        var modalTitle = updateModal.querySelector('.modal-title');
        modalTitle.textContent = 'Update Ambulance Details';
        var updateForm = updateModal.querySelector('#updateForm');
        updateForm.setAttribute('action', 'update_ambulance.php');
        var updateId = updateForm.querySelector('#updateId');
        updateId.value = ambulanceId;
        var updateDriverName = updateForm.querySelector('#updateDriverName');
        updateDriverName.value = driverName;
        var updateContact = updateForm.querySelector('#updateContact');
        updateContact.value = contact;
        var updateAvailable = updateForm.querySelector('#updateAvailable');
        updateAvailable.value = available;

    });
</script>