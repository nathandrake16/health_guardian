<?php include 'patient_header.php'; ?>

<?php
// Initialize variables for height and weight
$height = isset($_POST['height']) ? $_POST['height'] : '';
$weight = isset($_POST['weight']) ? $_POST['weight'] : '';

// BMI Calculation
$bmi = '';
$suggestion = '';

// Perform BMI calculation only if both height and weight are provided
if ($height && $weight) {
    // Calculate BMI
    $bmi = $weight / ($height * $height);

    // Suggest based on BMI
    if ($bmi < 18.5) {
        $suggestion = "Underweight";
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        $suggestion = "Normal weight";
    } elseif ($bmi >= 25 && $bmi < 29.9) {
        $suggestion = "Overweight";
    } else {
        $suggestion = "Obese";
    }
}
?>

<div class="container mt-5 mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">BMI Calculation</h5>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="height" class="form-label">Enter Height (in meters)</label>
                            <input type="number" step="0.01" class="form-control" id="height" name="height" value="<?php echo $height; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Enter Weight (in kilograms)</label>
                            <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="<?php echo $weight; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Calculate BMI</button>
                    </form>
                    <hr>
                    <?php if ($bmi && $suggestion): ?>
                        <p><strong>BMI:</strong> <?php echo round($bmi, 2); ?></p>
                        <p><strong>Suggestion:</strong> <?php echo $suggestion; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'patient_footer.php'; ?>
