<?php include 'admin_header.php'; ?>
<style>
    .container {
        padding: 40px;
    }
</style>
<div class="container">
    <h2>Add Doctor</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="qualification">Qualification:</label>
            <input type="text" class="form-control" id="qualification" name="qualification" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="points">Fee:</label>
            <input type="text" class="form-control" id="points" name="points" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Doctor</button>
    </form>
</div>

<?php
require_once "../includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather input data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $qualification = $_POST["qualification"];
    $phone = $_POST["phone"];
    $points = $_POST["points"];

    // Insert into users table and get the inserted user's ID
    $sql_user = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";
    $stmt_user = $conn->prepare($sql_user);
    $role = 'doctor';
    $stmt_user->bind_param("sss", $email, $password, $role);
    $stmt_user->execute();
    $user_id = $stmt_user->insert_id;
    $stmt_user->close();

    // Prepare and execute SQL query to insert the doctor's data into the doctors table
    $sql_doctor = "INSERT INTO doctors (name, specialization, phone, fee, user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt_doctor = $conn->prepare($sql_doctor);
    $stmt_doctor->bind_param("ssssi", $name, $qualification, $phone, $points, $user_id);

    if ($stmt_doctor->execute()) {
        // Doctor added successfully
        echo "<div class='container'><div class='alert alert-success' role='alert'>Doctor added successfully.</div></div>";
    } else {
        // Error occurred while adding doctor
        echo "<div class='container'><div class='alert alert-danger' role='alert'>Error: " . $conn->error . "</div></div>";
    }

    // Close statement and connection
    $stmt_doctor->close();
    $conn->close();
}
?>

<?php include 'admin_footer.php'; ?>
