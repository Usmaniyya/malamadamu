<?php
if (isset($_POST['signup'])) {
    // Database connection
    require_once '../includes/config.php';

    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $rank = mysqli_real_escape_string($conn, $_POST['rank']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $password = password_hash(
        mysqli_real_escape_string($conn, $_POST['password']),
        PASSWORD_DEFAULT
    ); // Hash the password
    $query =
        'INSERT INTO signup (first_name, last_name, email, rank, status, password) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param(
        $stmt,
        'ssssis',
        $first_name,
        $last_name,
        $email,
        $rank,
        $status,
        $password
    );
    if (mysqli_stmt_execute($stmt)) {
        $success = 'Admin Registered successful!.';
        // Redirect to login.php
        header("refresh:2; url='dashboard'");
    } else {
        $error = 'Registration failed. Please try again.';
    }

    mysqli_close($conn);
} ?>

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
    <title>Add - Admin</title>
</head>
<body>
     <div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
 <?php include '../includes/admin_sidebar.php'; ?>
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <h3>Add Admin</h3>
    <?php if (isset($success)): ?>
    <p><?= $success ?></p>
    <?php elseif (isset($error)): ?>
    <p><?= $error ?></p>
    <?php endif; ?>
<hr>
    <form method="post">
        <div class="row mb-2">
            <div class="col-4">
<label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" name="first_name" required>
            </div>
             <div class="col-4">
                <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" required>
            </div>
             <div class="col-4">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" required>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4">
<label for="rank" class="form-label">Rank</label>
        <input type="text" class="form-control" name="rank" required>
            </div>
            <div class="col-4">
 <label for="status" class="form-label">Status</label>
        <select type="text" class="form-select" name="status" disabled required>
          <option value="1">Admin</option>
        </select>
            </div>
            <div class="col-4">
 <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
 <button type="submit" class="btn btn-warning w-50" name="signup">Add</button>
            </div>
        </div>
    </form>
</main>
</div>
</div>
</body>
</html>
