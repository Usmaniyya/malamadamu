<?php
include 'includes/config.php'; // Database connection
if (!$_SESSION['id']) {
    header('location: login');
}
include 'admin/fetch_data.php';
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
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$system_name?></title>
  <style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
      margin: 0; 
    }
  </style>
<?php include "includes/header_student.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

<?php include "includes/navbars.php"; ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar bgColor elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">M.A FOUNDATION</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

     <?php include "includes/student_sidebar.php"; ?>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">O'Level</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">O'Level</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div style="background:white;padding: 10px;">
        <form method="post" action="update_olevel">
        <!-- Row 1: Exam Information -->     
        <button type="button" class="btn btn-warning" id="addSitting" onclick="addSittings()">Add Sittings</button><br><hr>
        <div id="sittingsContainer">
            <!-- This is where dynamically added sittings will go -->
            <input type="hidden" id="sittingCount" name="sittingCount" value="1">
            <div class="row">
                <div class="col-3">
        <label for="exam_type" class="form-label">Exam Type</label>
        <select class="form-control" name="exam_type[]" required>
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
        <select class="form-control mt-2 w-50" name="english_grade[]" required>
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
        <select class="form-control mt-2 w-50" name="maths_grade[]" required>
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
        <select type="text" class="form-control" name="subject1[]">
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
        <select class="form-control mt-2 w-50" name="subject1_grade[]" required>
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
        <select type="text" class="form-control" name="subject2[]" required>
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
        <select class="form-control mt-2 w-50" name="subject2_grade[]" required>
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
        <select type="text" class="form-control" name="subject3[]" required>
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
        <select class="form-control mt-2 w-50" name="subject3_grade[]" required>
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
        <select class="form-control" type="text" name="subject4[]" required>
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
        <select class="form-control mt-2 w-50" name="subject4_grade[]" required>
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
        <select type="text" class="form-control" name="subject3[]" required>
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
        <select class="form-control mt-2 w-50" name="subject4_grade[]" required>
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
       <select type="text" class="form-control" name="subject3[]" required>
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
        <select class="form-control mt-2 w-50" name="subject4_grade[]" required>
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
       <select type="text" class="form-control" name="subject3[]" required>
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
        <select class="form-control mt-2" name="subject4_grade[]" required>
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
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong> &copy; 2023 <a href="https://malamadamufoundation.edu.ng"><?=$system_name?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Founded</b> 2023.
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<?php include "includes/footer.php"; ?>
</body>
</html>
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
          <select class="form-control" name="exam_type[]">
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
          <select name="english_grade[]" class="form-control mt-2 w-50">
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
          <select name="maths_grade[]" class="form-control mt-2 w-50">
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
          <select type="text" class="form-control" name="subject3[]" required>
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
      <select name="subject1_grade[]" class="form-control mt-2 w-50" required>
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
          <select type="text" class="form-control" name="subject3[]" required>
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
      <select name="subject2_grade[]" class="form-control mt-2 w-50" required>
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
         <select type="text" class="form-control" name="subject3[]" required>
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
      <select name="subject3_grade[]" class="form-control mt-2 w-50" required>
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
          <select type="text" class="form-control" name="subject3[]" required>
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
      <select name="subject4_grade[]" class="form-control mt-2 w-50" required>
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
           <select type="text" class="form-control" name="subject3[]" required>
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
      <select name="subject3_grade[]" class="form-control mt-2 w-50" required>
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
          <select type="text" class="form-control" name="subject3[]" required>
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
      <select name="subject4_grade[]" class="form-control mt-2 w-50" required>
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
            <select type="text" class="form-control" name="subject3[]" required>
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
      <select name="subject4_grade[]" class="form-control mt-2" required>
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