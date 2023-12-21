<?php
include 'includes/config.php'; // Database connection
if (!$_SESSION['id']) {
    header('location: login');
}
include 'admin/fetch_data.php';
if (isset($_SESSION['email'])) {
    $user_id = $_SESSION['id'];

    // Fetch all fields for the user with the specific ID
    $query =
        'SELECT * FROM `signup` JOIN applicants ON signup.id = applicants.student_id WHERE applicants.student_id = ?';

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
            <h1 class="m-0">MyProfile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">MyProfile</li>
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
        <hr>
<div class="container">
    <form method="post" action="update_profile" enctype="multipart/form-data">
        <div class="row">
        <?php if (!empty($user_data['passport_path'])) { ?>
            <img src="<?= $user_data[
                'passport_path'
            ] ?>" alt="Passport Image" style="max-width: 100px;">
        <?php } ?>
        <div class="col-6 mb-3">
  <label for="formFile" class="form-label">Upload Passport</label>
  <input class="form-control border-warning" type="file" name="passport" accept=".jpg, .jpeg, .png" id="formFile" value="<?= $user_data[
      'passport_path'
  ] ?? '' ?>"><!-- accept="image/*" -->
</div>
</div>
</div>
<div class="row mb-2">
  <div class="col-4">
        <label for="first_name" class="form-label">First Name</label>
          <input type="text" name="first_name" class="form-control" value="<?= $user_data[
              'first_name'
          ] ?? '' ?>" required>
  </div>
  <div class="col-4">
      <label for="last_name" class="form-label">Last Name</label>
          <input type="text" class="form-control" name="last_name" value="<?= $user_data[
              'last_name'
          ] ?? '' ?>" required>
  </div>
  <div class="col-4">
      <label for="other_name"  class="form-label">Other Name</label>
          <input type="text" class="form-control" name="other_name" value="<?= $user_data[
              'other_name'
          ] ?? '' ?>">
  </div>
</div>
<div class="row mb-2">
    <div class="col-6">
 <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?= $user_data[
            'email'
        ] ?? '' ?>" required>
    </div>
<div class="col-6">
             <label for="phone" class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="<?= $user_data[
            'phone'
        ] ?? '' ?>">

        </div>
</div>
    <div class="row mb-2">
        <div class="col-4">
<label for="dob" class="form-label">Date of Birth</label>
        <input type="date" name="dob" class="form-control" value="<?= $user_data[
            'dob'
        ] ?? '' ?>">
        </div>
        <div class="col-4">
              <label for="" class="form-label">State</label>
          <select placeholder="<?= $user_data['state'] ?? 'Select State' ?>" autocomplete="off" name="state" id="state" class="select">
            <option value=""></option>
            <option value="Abia">Abia</option>
            <option value="Adamawa">Adamawa</option>
            <option value="AkwaIbom">AkwaIbom</option>
            <option value="Anambra">Anambra</option>
            <option value="Bauchi">Bauchi</option>
            <option value="Bayelsa">Bayelsa</option>
            <option value="Benue">Benue</option>
            <option value="Borno">Borno</option>
            <option value="Cross River">Cross River</option>
            <option value="Delta">Delta</option>
            <option value="Ebonyi">Ebonyi</option>
            <option value="Edo">Edo</option>
            <option value="Ekiti">Ekiti</option>
            <option value="Enugu">Enugu</option>
            <option value="FCT">FCT</option>
            <option value="Gombe">Gombe</option>
            <option value="Imo">Imo</option>
            <option value="Jigawa">Jigawa</option>
            <option value="Kaduna">Kaduna</option>
            <option value="Kano">Kano</option>
            <option value="Katsina">Katsina</option>
            <option value="Kebbi">Kebbi</option>
            <option value="Kogi">Kogi</option>
            <option value="Kwara">Kwara</option>
            <option value="Lagos">Lagos</option>
            <option value="Nasarawa">Nasarawa</option>
            <option value="Niger">Niger</option>
            <option value="Ogun">Ogun</option>
            <option value="Ondo">Ondo</option>
            <option value="Osun">Osun</option>
            <option value="Oyo">Oyo</option>
            <option value="Plateau">Plateau</option>
            <option value="Rivers">Rivers</option>
            <option value="Sokoto">Sokoto</option>
            <option value="Taraba">Taraba</option>
            <option value="Yobe">Yobe</option>
            <option value="Zamfara">Zamafara</option>
        </select>
        </div>
        <div class="col-4">
              <label for="lga" class="form-label">Local Government</label>
        <select placeholder="<?= $user_data['lga'] ?? 'Select Local Government' ?>" autocomplete="off" name="lga" id="lga" class="lga">
            <option value=""></option>
        </select>
        </div>
    </div>
    <div class="row mb-2">
<div class="col-6">
<label for="address" class="form-label">Address</label>
        <textarea name="address" class="form-control" rows="4" cols="50"><?= $user_data[
            'address'
        ] ?? '' ?></textarea>
</div>
<div class="col-6">
<label for="nok_address" class="form-label">Next of Kin Address</label>
        <textarea name="nok_address" class="form-control" rows="4" cols="50"><?= $user_data[
            'nok_address'
        ] ?? '' ?></textarea>
</div>
</div>
<div class="row mb-2">
<div class="col-4">
<label for="next_of_kin" class="form-label">Next of Kin</label>
        <input type="text" class="form-control" name="next_of_kin" value="<?= $user_data[
            'next_of_kin'
        ] ?? '' ?>">
</div>
<div class="col-4">
    <label for="nok_email" class="form-label">Next of Kin Email</label>
        <input type="email" class="form-control" name="nok_email" value="<?= $user_data[
            'nok_email'
        ] ?? '' ?>">
</div>
<div class="col-4">
<label for="relation" class="form-label">Relationship</label>
        <input type="text" class="form-control" name="relation" value="<?= $user_data[
            'relation'
        ] ?? '' ?>">
</div>
    </div>
    <div class="row mb-2">
<div class="col-12">
 <button type="submit" name="update" class="btn btn-warning">Update</button>
</div>
    </div>       
        </div>
    </form>
    </div>
    </main>
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
<script>
    $( document ).ready(function() {
        $('#state').selectize();
        $('#lga').selectize();
    });
</script>
<script src="lga.js"></script>
      
</body>
</html>
