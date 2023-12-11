<?php
include 'includes/config.php'; // Database connection

if (!$_SESSION['id']) {
    header('location: login');
}
if (isset($_SESSION['email'])) {
    $user_id = $_SESSION['id'];

    // Fetch all fields for the user with the specific ID
    $query = 'SELECT * FROM `olevel` WHERE student_id = ?';

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
    <title>O'Level</title>
    <style>
        input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
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
 <h2>O'Level</h2>
 <div class="container">
<form method="post" action="update_olevel">
        <!-- Row 1: Exam Information -->     
        <button type="button" class="btn btn-warning" id="addSitting" onclick="addSittings()">Add Sittings</button><br><hr>
        <div id="sittingsContainer">
            <!-- This is where dynamically added sittings will go -->
            <input type="hidden" id="sittingCount" name="sittingCount" value="1">
            <div class="row">
                <div class="col-3">
        <label for="exam_type" class="form-label">Exam Type</label>
        <select class="form-select" name="exam_type[]" required>
            <option value="WAEC">WAEC</option>
            <option value="NECO">NECO</option>
            <option value="NABTEB">NABTEB</option>
        </select>
                </div>
                  <div class="col-3">
                     <label for="exam_no" class="form-label">Exam Number</label>
        <input type="text" class="form-control" name="exam_no[]" value="<?= $user_data[
            'exam_no'
        ] ?? '' ?>" required>
                </div>
                  <div class="col-3">
                     <label for="year" class="form-label">Year</label>
        <select class="form-control" name="year[]">
            <option value="<?= $user_data[ 'year'] ?? '' ?>"><?= $user_data[ 'year'] ?? '' ?></option>
            <option value='2023'>2023</option>
            <option value='2024'>2024</option>
            <option value='2025'>2025</option>
            <!-- <option value='2023-11-29'>2023-11-29</option> -->
        </select>
                </div>
                  <div class="col-3">     
        <label for="exam_center" class="form-label">Exam Center</label>
        <input type="text" class="form-control" name="exam_center[]" value="<?= $user_data[
            'exam_center'
        ] ?? '' ?>" required>
                </div>
            </div>
        <hr>
        <div class="row mb-2">
                 <!-- Row 2: English Grade -->
            <div class="col-6">
 <input type="text" class="form-control" name="english[]" placeholder="English" readonly value="<?= $user_data[
     'english'
 ] ?? '' ?>" required>
        <select class="form-select mt-2 w-50" name="english_grade[]" required>
            <option><?= $user_data['english_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select> 
                    </div>
<div class="col-6">
                 <!-- Row 3: Math Grade -->
        <input type="text" class="form-control" name="maths[]" placeholder="Mathematics" readonly value="<?= $user_data[
            'maths'
        ] ?? '' ?>" required>
        <select class="form-select mt-2 w-50" name="maths_grade[]" required>
            <option><?= $user_data['maths_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
            </div>
                </div>
<div class="row mb-2">
<div class="col-6">
 <!-- Row 4: Subject1 Grade -->
        <!-- <label for="subject1">Subject1:</label> -->
        <select type="text" class="form-select" name="subject1[]">
            <option><?= $user_data['subject1'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select class="form-select mt-2 w-50" name="subject1_grade[]" required>
            <option><?= $user_data['subject1_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
</div>
<div class="col-6">
        <!-- Row 5: Subject2 Grade -->
        <!-- <label for="subject2">Subject2:</label> -->
        <select type="text" class="form-select" name="subject2[]" required>
            <option><?= $user_data['subject2'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select class="form-select mt-2 w-50" name="subject2_grade[]" required>
        <option><?= $user_data['subject2_grade'] ?? 'Grade' ?></option>
           <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
</div>
</div>
<div class="row mb-2">
    <div class="col-6">
        <!-- Row 6: Subject3 Grade -->
        <!-- <label for="subject3">Subject3:</label> -->
        <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select class="form-select mt-2 w-50" name="subject3_grade[]" required>
            <option><?= $user_data['subject3_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
    </div>
    <div class="col-6">
 <!-- Row 7: Subject4 Grade -->
        <!-- <label for="subject4">Subject4:</label> -->
        <select class="form-select" type="text" name="subject4[]" required>
            <option><?= $user_data['subject4'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select class="form-select mt-2 w-50" name="subject4_grade[]" required>
            <option><?= $user_data['subject4_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
    </div>
</div>
<div class="row mb-2">
    <div class="col-6">
 <!-- Row 8: Subject4 Grade -->
        <!-- <label for="subject4">Subject4:</label> -->
        <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select class="form-select mt-2 w-50" name="subject4_grade[]" required>
            <option><?= $user_data['subject4_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
    </div>
    <div class="col-6">
 <!-- Row 7: Subject4 Grade -->
        <!-- <label for="subject4">Subject4:</label> -->
       <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select class="form-select mt-2 w-50" name="subject4_grade[]" required>
            <option><?= $user_data['subject4_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
         <!-- Row 8: Subject4 Grade -->
        <!-- <label for="subject4">Subject4:</label> -->
       <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select class="form-select mt-2" name="subject4_grade[]" required>
            <option><?= $user_data['subject4_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
    </div>
</div>
<div class="row mb-2">
            <!-- Update Button -->
    <div class="col-6">
        <button type="submit" class="btn btn-warning" name="update">Save</button>
    </div>
</div>
            </div>
        </div>
        </div>
    </form>
 </div>
 </main>
 </div>
 </div>
</body>
<script>
    let sittingCount = 1;

    function addSittings() {
        sittingCount++;
        const container = document.getElementById("sittingsContainer");
        const sittingDiv = document.createElement("div");
        sittingDiv.innerHTML = `
            <hr>
            <div class="row">
            <div class="col-3">
             <label for="exam_type${sittingCount}" class="form-label">Exam Type</label>
            <select class="form-select" name="exam_type[]">
                <option value="Waec">WAEC</option>
                <option value="NECO">NECO</option>
                <option value="NABTEB">NABTEB</option>
            </select>
            </div>
             <div class="col-3">
            <label for="exam_no${sittingCount}" class="form-label">Exam Number</label>
            <input type="text" class="form-control" name="exam_no[]">
            </div>
             <div class="col-3">
              <label for="year${sittingCount}" class="form-label">Year</label>
            <input type="date" class="form-control" name="year[]">
            </div>
             <div class="col-3">
             <label for="exam_center${sittingCount}" class="form-label">Exam Center</label>
            <input type="text" class="form-control" name="exam_center[]">
            </div>
            </div>
<hr>
<div class="row mb-2">
<div class="col-6">
<input type="text" class="form-control" name="english[]" placeholder="English" disabled>
            <select name="english_grade[]" class="form-select mt-2 w-50">
                <option>Grade</option>
                 <option value="A1">A1</option>
                   <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
            </select>
            
</div>
<div class="col-6">
<input type="text" class="form-control" name="maths[]" placeholder="Mathematics" disabled>
            <select name="maths_grade[]" class="form-select mt-2 w-50">
                <option>Grade</option>
                 <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
            </select>
</div>
</div>

            <div class="row mb-2">
            <div class="col-6">
            <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select name="subject1_grade[]" class="form-select mt-2 w-50" required>
            <option><?= $user_data['subject1_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
            </div>
            <div class="col-6">
            <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select name="subject2_grade[]" class="form-select mt-2 w-50" required>
            <option><?= $user_data['subject2_grade'] ?? 'Grade' ?></option>
            <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
            </div>
            </div>

            <div class="row mb-2">
            <div class="col-6">
           <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select name="subject3_grade[]" class="form-select mt-2 w-50" required>
            <option><?= $user_data['subject3_grade'] ?? 'Grade' ?></option>
             <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
            </div>
               <div class="col-6">
            <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select name="subject4_grade[]" class="form-select mt-2 w-50" required>
            <option><?= $user_data['subject4_grade'] ?? 'Grade' ?></option>
             <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
          </div>
            </div>
            <div class="row mb-2">
            <div class="col-6">
             <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select name="subject3_grade[]" class="form-select mt-2 w-50" required>
            <option><?= $user_data['subject3_grade'] ?? 'Grade' ?></option>
             <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
            </div>
               <div class="col-6">
            <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select name="subject4_grade[]" class="form-select mt-2 w-50" required>
            <option><?= $user_data['subject4_grade'] ?? 'Grade' ?></option>
             <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
          </div>
            </div>  
            <div class="row mb-2">
            <div class="col-12">
              <select type="text" class="form-select" name="subject3[]" required>
            <option><?= $user_data['subject3'] ?? 'Select Subject' ?></option>
            <option value="Further Mathematics">Further Mathematics</option>
            <option value="Literature-in-English">Literature-in-English</option>
            <option value="Hausa">Hausa</option>
            <option value="Igbo">Igbo</option>
            <option value="Yoruba">Yoruba</option>
            <option value="Biology">Biology</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Physics">Physics</option>
            <option value="Agricultural Science">Agricultural Science</option>
            <option value="Government">Government</option>
            <option value="Economics">Economics</option>
            <option value="Geography">Geography</option>
            <option value="Civic Education">Civic Education</option>
            <option value="Christian Religious Studies">Christian Religious Studies</option>
            <option value="Islamic Studies">Islamic Studies</option>
            <option value="Financial Accounting">Financial Accounting</option>
            <option value="Commerce">Commerce</option>
        </select>
        <select name="subject4_grade[]" class="form-select mt-2" required>
            <option><?= $user_data['subject4_grade'] ?? 'Grade' ?></option>
             <option value="A1">A1</option>
            <option value="B2">B2</option>
            <option value="B3">B3</option>
            <option value="C4">C4</option>
            <option value="C5">C5</option>
            <option value="C6">C6</option>
            <option value="D7">D7</option>
            <option value="E8">E8</option>
            <option value="F9">F9</option>
        </select>
            </div>
            </div>   
            <div class="row mb-2">
            <!-- Update Button -->
    <div class="col-6">
        <button type="submit" class="btn btn-warning" name="update">Add</button>
    </div>
</div>     
        `;
             
        container.appendChild(sittingDiv);
    }
    document.getElementById('addSitting').addEventListener('click', function () {
            const sittingCount = parseInt(document.getElementById('sittingCount').value);
            const newSittingCount = sittingCount + 1;
            document.getElementById('sittingCount').value = newSittingCount;

            const container = document.getElementById('sittingsContainer');

            // Clone the existing input fields for the new sitting
            const clone = container.firstElementChild.cloneNode(true);

            // Clear input values in the cloned fields
            const inputs = clone.querySelectorAll('input');
            inputs.forEach(input => {
                input.value = '';
            });

            // container.appendChild(clone);
        });
</script>
</html>
