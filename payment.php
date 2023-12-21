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
  <title><?=$system_name?> - Payment</title>
<?php include "includes/header_student.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
<!--  -->
<?php include "includes/navbars.php"; ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar bgColor elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text text-warning">M.A FOUNDATION</span>
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
            <h1 class="m-0">MyPayment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="text-warning">Dashboard</a></li>
              <li class="breadcrumb-item active">MyPayment</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div >
          <!-- <hr> -->
          <div class="container d-flex justify-content-center">
          <form id="paymentForm" class="mt-5"style="background:white;padding: 10px;">
            <div class="row">
              <div class="col-12 d-flex justify-content-center">
                <h3>Secured with</h3>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12 d-flex justify-content-center">
                <img src="./images/paystack.png" alt="Paystack" width="150" />
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-6">
          <!-- <label for="first-name" class="form-label">First Name</label> -->
              <input type="text" class="form-control" id="first-name" value="<?= $user_data[
                  'first_name'
              ] ?? '' ?>"  readonly/>
              </div>
              <div class="col-6">
          <!-- <label for="last-name" class="form-label">Last Name</label> -->
              <input type="text" class="form-control" id="last-name" value="<?= $user_data[
                  'last_name'
              ] ?? '' ?>" readonly />
              </div>
            </div>
            <div class="row mb-2">
            <div class="col-12">
              <!-- <label for="email" class="form-label">Email Address</label> -->
              <input type="email" class="form-control" id="email-address" disabled value="<?= $user_data[
                  'email'
              ] ?? '' ?>" required />
            </div>
            </div>
          <div class="row mb-2">
          <div class="col-12">
            <label for="amount" class="form-label">Amount to Pay</label>
              <input type="tel" class="form-control"  value="2500" required readonly="yes" />
              <input type="hidden" id="amount" value="2500" required readonly="yes" />
          </div>
          </div>
          <div class="row">
            <div class="col-12">
          <button type="submit" class="btn btn-warning w-100" onclick="payWithPaystack()"> Pay </button>
            </div>
          </div>
          </form>
          </div>
          <script src="https://js.paystack.co/v1/inline.js"></script>

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

<script type="text/javascript">
  const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: 'pk_test_04d3627ab760a79583a3d4925876bca847e1a90c', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: 'MAF'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
      window.location = "http://localhost/malamadamu/verify_payment?reference=" + response.reference;
    }
  });

  handler.openIframe();
}

</script>
