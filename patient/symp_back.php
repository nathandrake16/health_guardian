<div style="display:none">
	<?php

	require_once "../includes/config.php";

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Retrieve user input
	$patient_id = $_SESSION['id'];
	//

	$urine_color = $_POST['urine_color'];
	$skin_eye_color = $_POST['skin_eye_color'];


	// Determine Jaundice condition and suggestion

	if ($skin_eye_color == 'yellow') {
		$condition_jaundice = "Severe Jaundice";
		$suggestion_jaundice = "Jaundice Checker Suggestion: Might have severe Jaundice. Please consult a gastroenterologists or hepatologists doctor immediately.";
	} 
	elseif ($urine_color == 'straw') {
		$condition_jaundice = "No Jaundice";
		$suggestion_jaundice = "Jaundice Checker Suggestion: No symptoms of Jaundice detected.";
	} 
	else {
		$condition_jaundice = "Early Stage Jaundice or Urinary Infection";
		$suggestion_jaundice = "Jaundice Checker Suggestion: Possibly in the early stage of Jaundice or urinary infection. It is advisable to consult a doctor for further evaluation.";
	}

	$s_breath = $_POST['s_breath'];
	$bp_lvl = $_POST['bp_lvl'];


	// Determine high bp condition and suggestion

	if ($s_breath == 'Yes' ) {
		if($bp_lvl=='Normal'){
			$condition_bp = "Might have shortness in breathing / Asthma";
			$suggestion_bp = "High Blood Pressure Checker Suggestion: If regularly face this problem seek advice from an ENT Specialist, Try maintaining a healthy lifestyle.";
			
		}
		else{
			$condition_bp = "Severe high blood pressure/ Hypertension";
			$suggestion_bp = "High Blood Pressure Checker Suggestion: Seek Emergency help from a Cardiologist.";
		}
	} 

	else {
		if($bp_lvl=='Normal'){
			$condition_bp = "Bp Normal ";
			$suggestion_bp = "High Blood Pressure Checker Suggestion: Your Blood Pressure is Normal. ";
			
		}
		else{
			$condition_bp = "Alert";
			$suggestion_bp = "High Blood Pressure Checker Suggestion: Stay careful and monitor your blood pressure. If condition worsens seek medical help.";
		}
    }


	$sugar_lvl = $_POST['sugar_lvl'];
	$urine_times = $_POST['urine_times'];


	// Determine blood sugar condition and suggestion

	if ($sugar_lvl == 'Non_diab' ) {
		if($urine_times =='Normal'){
			$condition_bloodsugar = "normal";
			$suggestion_bloodsugar = "Blood Sugar Checker Suggestion: Your Sugar level is normal.";
			
		}
		else{
			$condition_bloodsugar = " norm test later";
			$suggestion_bloodsugar = "Blood Sugar Checker Suggestion: Test again later.";
		}
	} 

	else {
		if($urine_times=='Normal'){
			$condition_bloodsugar = "high blood sugar";
			$suggestion_bloodsugar = "Blood Sugar Checker Suggestion: You currently have I high blood sugar. If you feel any discomfort consult with a doctor.";
			
		}
		else{
			$condition_bloodsugar = "Diabetes";
			$suggestion_bloodsugar = "Blood Sugar Checker Suggestion: You might have diabetes. Visit a Endrocinologist specialized doctor and start maintaining a disciplined lifestyle.";
		}
    }




	$smile = $_POST['smile'];
	$hand_raise = $_POST['hand_raise'];


	// Determine stroke condition and suggestion

	if ($smile == 'Yes' ) {
		if($hand_raise =='Yes'){
			$condition_stroke = "normal";
			$suggestion_stroke = "Stroke Checker Suggestion: You are normal. ";
			
		}
		else{
			$condition_stroke = "abnormal/nerve issue";
			$suggestion_stroke = "Stroke Checker Suggestion: You might have disorientation/nervous system issue , test again later. If feel discomfort seek help from a doctor.";
		}
	} 

	else {
		if($hand_raise=='Yes'){
			$condition_stroke = "nerve/facial";
			$suggestion_stroke = "Stroke Checker Suggestion: Might have facial nerve issue. If persists take help from neurology specialists.";
			
		}
		else{
			$condition_stroke = "stroke/paralysis";
			$suggestion_stroke = "Stroke Checker Suggestion: You might have paralysis/stroke take emergency medical help. Neurologist/Neuromedicine/Neuro-surgeons are expert in this regard.";
		}
		}


	
	// Start the session
	session_start();

	// Check if the form has been submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Your existing PHP code to process the form submission goes here
		// ...
        

        if (isset($_POST['urine_color']) && isset($_POST['skin_eye_color']) && isset($_POST['s_breath']) && isset($_POST['bp_lvl'])
       && isset($_POST['sugar_lvl']) && isset($_POST['urine_times']) && isset($_POST['smile']) && isset($_POST['hand_raise'])){
            // Store the suggestion in a session variable
            $_SESSION['suggestion'] = $suggestion_jaundice."<br>".$suggestion_bp."<br>".$suggestion_bloodsugar."<br>".$suggestion_stroke ;
            
            
            // Store the user's symptoms and suggestion in the database
            $sql = "INSERT INTO symptoms (patient_id, condition_jaundice,condition_bp ,condition_bloodsugar,condition_stroke,
             suggestion_jaundice, suggestion_bp, suggestion_bloodsugar, suggestion_stroke) 
             VALUES ('$patient_id', '$condition_jaundice','$condition_bp','$condition_bloodsugar','$condition_stroke',
             '$suggestion_jaundice','$suggestion_bp','$suggestion_bloodsugar','$suggestion_stroke')";

            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else
            $_SESSION['suggestion'] = 'error';

		// Redirect back to the same page to reset POST data
		header("Location: " . $_SERVER['PHP_SELF']);
		exit;
	}

	$conn->close();
	?>
</div>


</html>
