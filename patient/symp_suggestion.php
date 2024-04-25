<?php
   // Display "Symptoms recorded successfully" message after the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['suggestion'])) {
        echo "<p>Symptoms recorded successfully.</p>";
    }

    // Display the suggestion after the form has been submitted
    if (isset($_SESSION['suggestion'])) {
        
        if ($_SESSION['suggestion'] === 'error')
            echo "<p class = 'Error'>Please select all options.</p>";
        else{
            echo "<div class = 'suggestion_box'>" . "<h4>Suggestion:</h3>". "<p class = 'suggestion'>" . $_SESSION['suggestion'] . "</p>" . "</div>";
        }

        // Clear the suggestion from the session
        unset($_SESSION['suggestion']);
    }

?>