<?php
include("includes/config.php");// Database connection

if (!$_SESSION['id']){
    header("location: login");
}

if (isset($_SESSION['email'])) {
    $student_id =  $_SESSION['id'];

    // Jamb Result
    $applicant_id = $_SESSION['id'];
      // Fetch all fields for the user with the specific ID
      $query_jamb = 'SELECT * FROM `jamb_results` WHERE student_id = ?';
    
      $stmt = mysqli_prepare($conn, $query_jamb);
      mysqli_stmt_bind_param($stmt, 'i', $applicant_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $jamb_data = mysqli_fetch_assoc($result);
      $total_score = $jamb_data["english_score"] + $jamb_data["subject1_score"] + $jamb_data["subject2_score"] + $jamb_data["subject3_score"];
      // Close the database connection
    //   mysqli_close($conn);
    
    

    // Fetch all fields for the user with the specific ID
    $query = "SELECT 
    -- Program
    programs.name AS 'program',
    -- Faculty 
    faculty.name AS 'faculty',
    -- Applicants 
    applicants.passport_path,
    -- Signup
    signup.first_name,
    signup.last_name,
    -- Payment
    payments.reference,
    payments.paid_at,
    payments.channel,
    payments.amount,
    payments.status,
    -- Jamb 

    -- OLevel
    olevel.form_flag, olevel.exam_type, olevel.exam_no, olevel.year, olevel.exam_center, olevel.english, olevel.english_grade, olevel.maths, olevel.maths_grade, olevel.subject1, olevel.subject1_grade, olevel.subject2, olevel.subject2_grade, olevel.subject3, olevel.subject3_grade, olevel.subject4, olevel.subject4_grade, olevel.subject5, olevel.subject5_grade, olevel.subject6, olevel.subject6_grade, olevel.subject7, olevel.subject7_grade 
    FROM `signup` 
    JOIN applicants ON signup.id = applicants.student_id
    JOIN payments ON signup.id = payments.student_id
    JOIN choice_of_study ON signup.id = choice_of_study.applicant_id
    JOIN faculty ON faculty.id = choice_of_study.faculty
    JOIN programs ON programs.faculty_id = choice_of_study.program
    JOIN olevel ON signup.id = olevel.student_id
    JOIN jamb_results ON signup.id = jamb_results.student_id
    WHERE payments.student_id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);
    if ($user_data["form_flag"] == 1) {
        $user_data["form_flag"] = "First Sitting";
    }
    if ($user_data["form_flag"] == 2) {
        $user_data["form_flag"] = "Second Sitting";
    }

    $amount_data = $user_data['amount']?? '0';
    $amount = number_format($amount_data / 100, 2);

    // Close the database connection
    // mysqli_close($conn);
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
                <h1 class=" text-bold">MALAM ADAMU FOUNDATION</h1>
                <h3 class=" text-bold">2023/2024 SCHOLARSHIP PROGRAM</h3>
            <h4 class=" text-bold text-underline mt-3">Acknowledgement Slip</h4>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <div class="mt-3">
                 <p class="text-bold"><?= $user_data['first_name'].' '.$user_data['last_name'] ?? '' ?></p>
                 <p class="text-bold"> <?=$user_data["jamb_reg_no"] ?? ''?></p>
            <p class="text-bold"><?= $user_data['program'] ?? '' ?></p>
            <p class="text-bold">Faculty of <?= $user_data['faculty'] ?? '' ?></p>
            <p class="text-bold">JAMB: <?= $jamb_data['jamb_reg_no'] ?? '' ?></p>
                </div>
                <div class="">
                 <?php if (!empty($user_data['passport_path'])) { ?>
                  <img src="<?= $user_data['passport_path'] ?>" alt="Passport Image" style="max-width: 120px;">
               <?php } ?>
                </div>
            </div>
            <div class="mt-3">
            <h5 class="text-bold text-center "><==================== O' Level ====================></h5>
           <div class="d-flex justify-content-center align-items-center row mt-3">
            <div class="col-6">
                   <p class="text-bold">First Sitting</p>
                 <table class="table-bordered border-dark w-75">
                     <thead>
      <tr class="">
        <th class="px-2" scope="col">School</th>
        <th class="px-2 " scope="col">Exam/Year</th>
      </tr>
    </thead>
                <tr>
                     <td class=""><?=$user_data["exam_center"] ?? ''?></td>
                    <td class="px-2 "><?=$user_data["exam_type"] ?? ''?>/<?=$user_data["year"] ?? ''?></td>
                </tr>
                <theahd>
                    <tr>
                        <th class="" scope="col">Subjects</th>
                        <th class="" scope="col">Grades</th>
                    </tr>
                </theahd> 
                <tr>
                    <td class=""><?=$user_data["english"] ?? ''?></td>
                    <td class=""><?=$user_data["english_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$user_data["maths"] ?? ''?></td>
                    <td class=""><?=$user_data["maths_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$user_data["subject1"] ?? ''?></td>
                    <td class=""><?=$user_data["subject1_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$user_data["subject2"] ?? ''?></td>
                    <td class=""><?=$user_data["subject2_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$user_data["subject3"] ?? ''?></td>
                    <td class=""><?=$user_data["subject3_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$user_data["subject4"] ?? ''?></td>
                    <td class=""><?=$user_data["subject4_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$user_data["subject5"] ?? ''?></td>
                    <td class=""><?=$user_data["subject5_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$user_data["subject6"] ?? ''?></td>
                    <td class=""><?=$user_data["subject6_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$user_data["subject7"] ?? ''?></td>
                    <td class=""><?=$user_data["subject7_grade"] ?? ''?></td>
                </tr>
                 
            </table>
            </div>

                        <!-- Second Sitting -->
<?php
if (isset($_SESSION['email'])) {
  $student_id = $_SESSION['id'];

  // Fetch all fields for the user with the specific ID
  $query_form_2 = 'SELECT * FROM `olevel` WHERE student_id = ? AND form_flag = 2';

  $stmt = mysqli_prepare($conn, $query_form_2);
  mysqli_stmt_bind_param($stmt, 'i', $student_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $form_2_user_data = mysqli_fetch_assoc($result);
  if ($form_2_user_data > 0) {
  
  if ($form_2_user_data["form_flag"] == 1) {
      $form_2_user_data["form_flag"] = "First Sitting";
    }
  if ($form_2_user_data["form_flag"] == 2) {
      $form_2_user_data["form_flag"] = "Second Sitting";
    }
}
?>
            <div class="col-6">
                <p class="text-bold">Second Sitting</p>
                    <table class="table-bordered border-dark w-75">
                     <thead>
                    <tr class="">
                        <th class="px-2" scope="col">School</th>
                        <th class="px-2 " scope="col">Exam/Year</th>
                    </tr>
                    </thead>
                    <tr>
                     <td class=""><?=$form_2_user_data["exam_center"] ?? ''?></td>
                    <td class="px-2 "><?=$form_2_user_data["exam_type"] ?? ''?>/<?=$form_2_user_data["year"] ?? ''?></td>
                </tr>
                <theahd>
                    <tr>
                        <th class="" scope="col">Subjects</th>
                        <th class="" scope="col">Grades</th>
                    </tr>
                </theahd> 
                <tr>
                    <td class=""><?=$form_2_user_data["english"] ?? ''?></td>
                    <td class=""><?=$form_2_user_data["english_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$form_2_user_data["maths"] ?? ''?></td>
                    <td class=""><?=$form_2_user_data["maths_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$form_2_user_data["subject1"] ?? ''?></td>
                    <td class=""><?=$form_2_user_data["subject1_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$form_2_user_data["subject2"] ?? ''?></td>
                    <td class=""><?=$form_2_user_data["subject2_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$form_2_user_data["subject3"] ?? ''?></td>
                    <td class=""><?=$form_2_user_data["subject3_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$form_2_user_data["subject4"] ?? ''?></td>
                    <td class=""><?=$form_2_user_data["subject4_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$form_2_user_data["subject5"] ?? ''?></td>
                    <td class=""><?=$form_2_user_data["subject5_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$form_2_user_data["subject6"] ?? ''?></td>
                    <td class=""><?=$form_2_user_data["subject6_grade"] ?? ''?></td>
                </tr>
                <tr>
                    <td class=""><?=$form_2_user_data["subject7"] ?? ''?></td>
                    <td class=""><?=$form_2_user_data["subject7_grade"] ?? ''?></td>
                </tr>
                 
            </table>
            </div>
<?php } ?>
           </div>
        </div>

            <div class="my-3">
            <h5 class="text-bold text-center"><==================== JAMB ====================></h5>
            <div class="d-flex justify-content-center align-items-center">
                  <table class="table-bordered w-50">
               <thead>
                 <tr class="">
                    <td>S/N</td>
                    <td>Subjects</td>
                   <td>Score</td>
                </tr>
               </thead>
                <tr class="">
                    <td>1</td>
                    <td><?=$jamb_data["english"] ?? ''?></td>
                    <td><?=$jamb_data["english_score"] ?? ''?></td>
                </tr>
                <tr class="">
                     <td>2</td>
                    <td><?=$jamb_data["subject1"] ?? ''?></td>
                    <td><?=$jamb_data["subject1_score"] ?? ''?></td>
                </tr>
                <tr class="">
                     <td>3</td>
                    <td><?=$jamb_data["subject2"] ?? ''?></td>
                    <td><?=$jamb_data["subject2_score"] ?? ''?></td>
                </tr>
                <tr class="">
                     <td>4</td>
                    <td><?=$jamb_data["subject3"] ?? ''?></td>
                    <td><?=$jamb_data["subject3_score"] ?? ''?></td>
                </tr>
                <tr class="">
                    <td></td>
                    <td class="text-bold text-right">Total Score</td>
                    <td class=""><?=$total_score?></td>
                </tr>
            </table> 
            </div>
                     
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