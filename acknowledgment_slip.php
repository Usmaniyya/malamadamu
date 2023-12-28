<?php
include("includes/config.php");// Database connection

if (!$_SESSION['id']){
    header("location: login");
}

if (isset($_SESSION['email'])) {
    $student_id =  $_SESSION['id'];

    // Fetch all fields for the user with the specific ID
    $query = "SELECT programs.name AS 'program', faculty.name AS 'faculty', applicants.passport_path,signup.first_name,signup.last_name,payments.reference,payments.paid_at,payments.channel,payments.amount,payments.status FROM `signup` 
              JOIN applicants ON signup.id = applicants.student_id
              JOIN payments ON signup.id = payments.student_id
              JOIN choice_of_study ON signup.id = choice_of_study.applicant_id
              JOIN faculty ON faculty.id = choice_of_study.faculty
              JOIN programs ON programs.faculty_id = choice_of_study.program
              WHERE payments.student_id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);
    $amount_data = $user_data['amount']?? '0';
    $amount = number_format($amount_data / 100, 2);
    // Close the database connection
    mysqli_close($conn);
}

if (empty($user_data['reference']) || empty($user_data['status'])) {
    echo "<center>No Payment Has Been Made</center>";
}else{
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "includes/header_student.php"; ?>
    <title>Acknowledgment Slip</title>
    <style>
        .text-underline{
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
       <div class="d-flex justify-content-center align-items-center">
         <img style="width: 170px; height: 100px" src="./dist/img/MAFLogo2.png" alt="MAF Logo" />
       </div>
            <div>
                <h1 class="text-center text-bold">MALAM ADAMU FOUNDATION</h1>
                <h3 class="text-center text-bold">2023/2024 SCHOLARSHIP PROGRAM</h3>
            <h4 class="text-center text-bold text-underline mt-3">Acknowledgment Slip</h4>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <div class="mt-3">
                 <p class="text-bold"><?= $user_data['first_name'].' '.$user_data['last_name'] ?? '' ?></p>
            <p class="text-bold"><?= $user_data['program'] ?? '' ?></p>
            <p class="text-bold">Faculty of <?= $user_data['faculty'] ?? '' ?></p>
                </div>
                <div class="">
                 <?php if (!empty($user_data['passport_path'])) { ?>
             <img src="<?= $user_data['passport_path'] ?>" alt="Passport Image" style="max-width: 120px;">
               <?php } ?>
                </div>
            </div>
            <div class="text-center mt-3">
            <h5 class="text-bold"><==================== O' Level ====================></h5>
            </div>
              <div class="text-center mt-3">
            <h5 class="text-bold"><==================== JAMB ====================></h5>
            </div>
            <div>
                <p class="text-bold">
                    Successfull applicants will be contacted for screening and must present the following documents: 
                </p>
                <ol>
                    <li>Acknowledgement Slip</li>
                    <li>JAMB Result</li>
                    <li>WAEC/NECO/NABTEB</li>
                    <li>Two Passport Photograph</li>
                    <li>Certificate of Indigeneship</li>
                </ol>
            </div>
    </div>
    <!-- <div class="button-container">
            <a href="#" class="return-button" onclick="print()" >Print</a>
        </div> -->
</body>
</html>
<?php } ?>