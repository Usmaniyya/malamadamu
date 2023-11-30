<?php
include 'includes/config.php'; // Database connection

if (!$_SESSION['id']) {
    header('location: login');
}

if (isset($_SESSION['email'])) {
    $user_id = $_SESSION['id'];

    // Fetch all fields for the user with the specific ID
    $query = 'SELECT * FROM `jamb_results` WHERE student_id = ?';

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);
    // Close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>JAMB Result</title>
    <script>
        function calculateTotalScore() {
            // Get the individual subject scores
            var englishScore = parseFloat(document.getElementById("english").value) || 0;
            var subject1Score = parseFloat(document.getElementById("subject1").value) || 0;
            var subject2Score = parseFloat(document.getElementById("subject2").value) || 0;
            var subject3Score = parseFloat(document.getElementById("subject3").value) || 0;

            // Calculate the total score
            var totalScore = englishScore + subject1Score + subject2Score + subject3Score;

            // Display the total score
            document.getElementById("totalScore").innerHTML = "Total Score: " + totalScore + " <small><i>real time</i></small>";
        }
    </script>
    <style>
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
    </style>
</head>
<body>
    <div class="container-fluid">
    <div class="row">
 <?php include 'includes/student_sidebar.php'; ?>
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
<h2>JAMB Result Form</h2>
<div class="container">
    <form method="POST" action="update_jamb_result">
<div class="row mb-2">
    <div class="col-6">
 <label for="jamb_reg_no" class="form-label">JAMB Registration Number</label><br>
        <input type="text" class="form-control" id="jamb_reg_no" name="jamb_reg_no" placeholder="Enter registration number" value="<?= $user_data[
            'jamb_reg_no'
        ] ?? '' ?>" required>
    </div>
</div>
<hr>
            <div class="row mb-2">
                <div class="col-6">
 <input type="text" class="form-control mb-2" name="english" value="English" readonly>
        <input type="number" class="form-control w-50" id="english" name="english_score" placeholder="Enter score" value="<?= $user_data[
            'english_score'
        ] ?? '' ?>" oninput="calculateTotalScore()">
                </div>
                <div class="col-6">
 <input type="text" class="form-control mb-2" name="subject1" placeholder="Enter Subject" value="<?= $user_data[
     'subject1'
 ] ?? '' ?>">
        <input type="number" class="form-control w-50" id="subject1" name="subject1_score" placeholder="Enter score" value="<?= $user_data[
            'subject1_score'
        ] ?? '' ?>" oninput="calculateTotalScore()">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
<input type="text" class="form-control mb-2" name="subject2" placeholder="Enter Subject" value="<?= $user_data[
    'subject2'
] ?? '' ?>">
        <input type="number" class="form-control w-50" id="subject2" name="subject2_score" placeholder="Enter score" value="<?= $user_data[
            'subject2_score'
        ] ?? '' ?>" oninput="calculateTotalScore()">
                </div>
                <div class="col-6">
<input type="text" class="form-control mb-2"  name="subject3" placeholder="Enter Subject" value="<?= $user_data[
    'subject3'
] ?? '' ?>">
        <input type="number" class="form-control w-50" id="subject3" name="subject3_score" placeholder="Enter score" value="<?= $user_data[
            'subject3_score'
        ] ?? '' ?>" oninput="calculateTotalScore()">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
 <!-- Display the total score here -->
        <label id="totalScore" style="display: block;">Total Score: 0</label>
                </div>
        </div>
        <div class="row mb-2">
             <div class="col-6">
<button type="submit" class="btn btn-warning" name="update">Save</button>
        </div>
        </div>
    </form>
                </div>
            </div>
        
    </div>
    </main>
    </div>
    </div>
</body>
</html>
