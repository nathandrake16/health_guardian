<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle login form submission
    require_once "includes/config.php"; // Database connection

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email and password are valid
    $query = "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: includes/dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>
<?php include 'header.php'; ?>
<div class="container mt-5 mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Login</h5>
                <div class="card-body">
                    <?php if (isset($error))
                        echo "<div class='alert alert-danger'>$error</div>"; ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
