<?php
include "../includes/config.php"; // Include database configuration

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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Add Program</title>
      <style>
        .error{color:red;}
        .success{color:green;}
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
 <?php include '../includes/admin_sidebar.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
<h2 class="mb-3">Add Program</h2>
<hr>
<div class="container">
<form method="post" action="">
    <div class="row mt-3 mb-2">
        <div class="col-6">
            <label for="faculty" class="form-label">Select Faculty Name</label>
            <select name="faculty" class="form-select">
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
</div>
</main>
</div>
</div>
<?=mysqli_close($conn);// Close the database connection ?>
</body>
</html>