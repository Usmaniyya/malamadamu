<?php
include "../includes/config.php"; // Include database configuration
include 'fetch_data.php';
if (!$_SESSION['id']) {
    header('location: ../login');
}
// Initialize the message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected faculty ID and program name from the form
    $facultyId = $_POST["faculty"];
    $programName = $_POST["program"];

    // Check if the program already exists
    $checkQuery = "SELECT COUNT(*) FROM programs WHERE name = ?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);

    if ($checkStmt) {
        mysqli_stmt_bind_param($checkStmt, "s", $programName);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_bind_result($checkStmt, $count);
        mysqli_stmt_fetch($checkStmt);
        mysqli_stmt_close($checkStmt);

        if ($count > 0) {
            $message = "<script>swal('Error!', 'Program Already exist!', 'error')</script>";
        } else {
            // Prepare and execute the SQL query to insert into the programs table
            $insertQuery = "INSERT INTO programs (faculty_id, name) VALUES (?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertQuery);

            if ($insertStmt) {
                mysqli_stmt_bind_param($insertStmt, "is", $facultyId, $programName);
                $result = mysqli_stmt_execute($insertStmt);

                if ($result) {
                    $message = "<script>swal('Done!', 'Program Added!', 'success')</script>";
                } else {
                    $message = "<small class='error'>Error: " . mysqli_error($conn).'</small>';
                }

                mysqli_stmt_close($insertStmt);
            } else {
                $message = "<small class='error'>Error in preparing the statement: " . mysqli_error($conn).'</small>';
            }
        }
    } else {
        $message = "<small class='error'>Error in preparing the check statement: " . mysqli_error($conn).'</small>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$system_name?></title>
  <style>
        .error{color:red;}
        .success{color:green;}
    </style>
<?php include "../includes/header.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

<?php include "../includes/navbars.php"; ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar bgColor elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">M.A FOUNDATION</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

     <?php include "../includes/sidebar.php"; ?>
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
            <h1 class="m-0">Add Program</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Program</li>
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
      <form method="post" action="">
    <div class="row mt-3 mb-2">
        <div class="col-6">
            <label for="faculty" class="form-label">Select Faculty Name</label>
            <select name="faculty" class="form-control">
                <option></option>
                <?php
                $query_faculty_data = "SELECT * FROM `faculty` ";
                $query_faculty = mysqli_query($conn, $query_faculty_data);
                while ($row = mysqli_fetch_assoc($query_faculty)) {
                    $id = $row['id'];
                    $faculty = $row['name'];

                    echo '<option value="' . $id . '">' . $faculty . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-6">
            <label for="program" class="form-label">Enter Program Name</label>
            <input type="text" name="program" class="form-control" required />
            <?php if(isset($message)){echo $message;} ?><!-- Display the message within the form -->
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <button type="submit" class="px-5 btn btn-warning" name="">Save</button>
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
<?php include "../includes/footer2.php"; ?>
<?=mysqli_close($conn);// Close the database connection ?>

</body>
</html>
