<?php include 'patient_header.php'; ?>
<?php include_once("symp_back.php") ?>
<style>
    .container {
        height: 100vh;
        overflow: scroll;
    }
</style>
<div class="container p-4">
    <h2>Symptom Checker</h2>
    <form name="symptomForm" form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="user_id" value="1"> <!-- Replace 1 with the actual user ID -->
        
        <div class="segment">
            <h4><u>Jaundice Checker</u></h4>
            <p class='Q'>Q1. What is the color of your urine?</p>
            <input type="radio" name="urine_color" value="straw"> Straw/Clear<br>
            <input type="radio" name="urine_color" value="dark"> Dark/Brownish<br>
            <p class='Q'>Q2. What is the color of your skin/eyes?</p>
            <input type="radio" name="skin_eye_color" value="normal"> Normal<br>
            <input type="radio" name="skin_eye_color" value="yellow"> Yellow<br><br>
        </div>
            
        <div class="segment">
            <h4><u>High Blood Pressure Checker</u></h4>
            <p class='Q'>Q1. Breath shortness?</p>
            <input type="radio" name="s_breath" value="Yes"> Yes<br>
            <input type="radio" name="s_breath" value="No"> No<br>
            <p class='Q'>Q2. BP level?</p>
            <input type="radio" name="bp_lvl" value="Normal"> Normal: 120/80<br>
            <input type="radio" name="bp_lvl" value="xx"> Elevated : 120-129/80<br>
            <input type="radio" name="bp_lvl" value="xx"> High : 130/80 or higher<br><br>
        </div>

            
        <div class="segment">
            <h4><u>Blood Sugar Level Checker</u></h4>
            <p class='Q'>Q1. What is your fasting, after meal blood sugar level?</p>
            <input type="radio" name="sugar_lvl" value="Non_diab"> Fasting: 4.0-5.9 ,After Meal: less than 7.8 <br>
            <input type="radio" name="sugar_lvl" value="xx"> Fasting: 4.0-7.0 ,After Meal: less than 8.5 <br>
            <input type="radio" name="sugar_lvl" value="xx"> Fasting: 4.0-7.0 ,After Meal: 5-9 <br>
            <input type="radio" name="sugar_lvl" value="xx"> Fasting: 7.0+ ,After Meal: 9+ <br>
            <p class='Q'>Q2. How many times do you urinate?</p>
            <input type="radio" name="urine_times" value="Normal"> Not more than 7 times<br>
            <input type="radio" name="urine_times" value="xx"> More than 7-10 times<br><br>
        </div>

            
        <div class="segment">
            <h4><u>Stroke Checker</u></h4>
            <p class='Q'>Q1. Can you smile and lift your cheeks?</p>
            <input type="radio" name="smile" value="Yes"> Yes<br>
            <input type="radio" name="smile" value="xx"> No<br>
            <p class='Q'>Q2. Can you raise your hands?</p>
            <input type="radio" name="hand_raise" value="Yes"> Yes<br>
            <input type="radio" name="hand_raise" value="xx"> No<br>
        </div>
            
        <input type="submit" value="Submit">
        <?php include_once("symp_suggestion.php") ?>
    </form>
</div>

<?php include 'patient_footer.php'; ?>