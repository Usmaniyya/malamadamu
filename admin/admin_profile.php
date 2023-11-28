<?php
include '../includes/config.php'; // Include your database configuration

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['old_password']) &&
    isset($_POST['new_password']) &&
    isset($_POST['confirm_password'])
) {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate the old password and ensure the new password matches the confirmation
    $query =
        "SELECT `password` FROM `signup` WHERE id='" . $_SESSION['id'] . "'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['password'];

    if (
        password_verify($oldPassword, $hashedPassword) &&
        $newPassword === $confirmPassword
    ) {
        // Update the password in the database
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateQuery =
            "UPDATE `signup` SET `password`='" .
            $hashedNewPassword .
            "' WHERE id='" .
            $_SESSION['id'] .
            "'";
        if (mysqli_query($conn, $updateQuery)) {
            echo 'Password updated successfully.';
        } else {
            echo 'Password update failed.';
        }
    } else {
        echo 'Invalid old password or new passwords do not match.';
    }
}

// SQL query to fetch profile data
$query =
    "SELECT `first_name`, `last_name`, `email`, `rank`, `status`, `created_at`, `updated_at` FROM `signup` WHERE id='" .
    $_SESSION['id'] .
    "'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) { ?>

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
    <title>Profile</title>
</head>
<body>
    <div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
 <?php include '../includes/admin_sidebar.php'; ?>
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <h2 class="fs-4">Admin Profile</h2>
    <hr>
    <table border="1">
        <tr>
            <td><b>First Name: </b></td>
            <td><?= $row['first_name'] ?></td>
        </tr>
        <tr>
            <td><b>Last Name: </b></td>
            <td><?= $row['last_name'] ?></td>
        </tr>
        <tr>
            <td><b>Email: </b></td>
            <td><?= $row['email'] ?></td>
        </tr>
        <tr>
            <td><b>Rank: </b></td>
            <td><?= $row['rank'] ?></td>
        </tr>
        <tr>
            <td><b>Status: </b></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <tr>
            <td><b>Created_at: </b></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <tr>
            <td><b>Updated_at: </b></td>
            <td><?= $row['updated_at'] ?></td>
        </tr>
    </table>
<!-- Add a password change form -->
<h3 class="">Change Password</h3>
<form method="post">
    <div class="row mb-2">
    <div class="col-4">
     <label for="old_password" class="form-label">Old Password</label>
    <input type="password" class="form-control" name="old_password" required>
    </div>
    <div class="col-4">
 <label for="new_password" class="form-label">New Password</label>
    <input type="password" class="form-control" name="new_password" required>
    </div>
    <div class="col-4">
<label for="confirm_password" class="form-label">Confirm New Password</label>
    <input type="password" class="form-control"  name="confirm_password" required>
</div>
    </div>
    <div class="row">
        <div class="col-6">
 <button type="submit" class="btn btn-warning">Change Password</button>
</div>
    </div>   
</form>
</main>
</div>
</div>
</body>
</html>
<?php } else {echo 'No user profile found.';}
