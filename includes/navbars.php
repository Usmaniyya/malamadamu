<<<<<<< HEAD
<?php
// include("includes/config.php");// Database connection
if (isset($_SESSION['email'])) {
    $student_id =  $_SESSION['id'];

    // Fetch all fields for the user with the specific ID
    $query = "SELECT applicants.passport_path FROM `applicants` WHERE applicants.student_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);

    // Close the database connection
    // mysqli_close($conn);
}
?>
=======
>>>>>>> parent of d20ddbc (few torches)
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bgColor">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-warning" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       <div class="user-panel d-flex">
        <div class="image">
              <i class="bi bi-person p-1 text-warning mt-2 elevation-2"></i>
          <!-- <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block text-warning"><?=$_SESSION['first_name']?></a>
        </div>
      <!-- </div>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->