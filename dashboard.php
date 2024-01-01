<?php
include 'includes/config.php'; // Database connection
if (!$_SESSION['id']) {
    header('location: login');
}
if ($_SESSION['status'] != 0) {
  header('location: login');
}
include 'admin/fetch_data.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$system_name?></title>
<?php include "includes/header_student.php"; ?>
<style>
  .myborder {
    border-width: 10px;
  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="MAF LOGO" height="60" width="60">
  </div>

<?php include "includes/navbars.php"; ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar bgColor">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="MAF Logo" class="brand-image img-circle" style="opacity: .8">
      <span class="brand-text text-warning font-weight-bold">M.A FOUNDATION</span>
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="text-warning">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="border-top border-width-3 border-warning mb-2" style="background:white;padding: 16px;">
        <h2 class="mb-1">Welcome to MALAM ADAMU FOUNDATION Scholarship Portal</h2>
      </div>
       <div class="container bg-sm-none bg-white p-3">
        <div class="mb-2">
          <h4 class="text-danger">Note:</h4>
          <p>If you have <mark>5 credits</mark> including <mark>English and Mathematics</mark> in <mark>First Sitting</mark> (WAEC/NECO/NABTEB) you don't have to fill <mark>Second Sitting</mark>, otherwise you have to fill it.</p>
        </div>
          <div class="row mt-2">
            <div class="col-sm-6 col-12">
              <h4 class="text-underline">Eligibility</h4>
              <ol>
                <li>Candidates must have <mark>scored 130</mark> and above in the JAMB examination.</li>
                <li>JAMB must be <mark>between 2022</mark> to date.</li>
                <li>Candidates must have atleast <mark>5 credits</mark> in their O'level results. </li>
                <li>Every O'level results to be submitted must have been written <mark>from 2015</mark> to date.</li>
              </ol>
            </div>
            <div class="col-sm-6 col-12">
              <h4>Guidelines</h4>
              <ul>
                <li>Update Profile</li>
                <li>Update O'Level</li>
                <li>Update JAMB</li>
                <li>Make Payment</li>
                <li>Print Acknowledgement Slip</li>
              </ul>
            </div>
          </div>
        </div>
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
  <?php include "includes/footer_content.php"; ?>
</div>
<!-- ./wrapper -->
<?php include "includes/footer.php"; ?>
</body>
</html>
