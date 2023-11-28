<?php
include 'includes/config.php'; // Database connection
if (!$_SESSION['id']) {
    header('location: login');
}
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
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
    <title>Payment</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
 <?php include 'includes/student_sidebar.php'; ?>
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
<h2>Payment</h2>
<hr>
<div class="container d-flex justify-content-center">
<form id="paymentForm" class="mt-5">
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
    <input type="tel" class="form-control"  value="4000" required readonly="yes" />
    <input type="hidden" id="amount" value="4000" required readonly="yes" />
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
</main>
</div>
</div>
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
