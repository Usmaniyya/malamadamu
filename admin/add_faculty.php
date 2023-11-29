<?php
include "../includes/config.php"; // Include database configuration

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the faculty name from the form
    $facultyName = $_POST["faculty"];

    // Check if the faculty already exists
    $checkQuery = "SELECT COUNT(*) FROM faculty WHERE name = ?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);

    if ($checkStmt) {
        mysqli_stmt_bind_param($checkStmt, "s", $facultyName);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_bind_result($checkStmt, $count);
        mysqli_stmt_fetch($checkStmt);
        mysqli_stmt_close($checkStmt);

        if ($count > 0) {
            $message = "<small class='error'>Faculty already exists!</small>";
        } else {
            // Prepare and execute the SQL query to insert into the faculty table
            $insertQuery = "INSERT INTO faculty (name) VALUES (?)";
            $insertStmt = mysqli_prepare($conn, $insertQuery);

            if ($insertStmt) {
                mysqli_stmt_bind_param($insertStmt, "s", $facultyName);
                $result = mysqli_stmt_execute($insertStmt);

                if ($result) {
                    $message = "<small class='success'>Faculty successfully Saved!</small>";
                } else {
                    $message = "<small class='error'>Error: " . mysqli_error($conn)."</small>";
                }

                mysqli_stmt_close($insertStmt);
            } else {
                $message = "<small class='error'>Error in preparing the statement: " . mysqli_error($conn)."</small>";
            }
        }
    } else {
        $message = "<small class='error'>Error in preparing the check statement: " . mysqli_error($conn)."</small>";
    }
}

// Close the database connection
mysqli_close($conn);
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
    <title>Add Faculty</title>
    <Style>
        .error{color:red;}
        .success{color:green;}
    </Style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
 <?php include '../includes/admin_sidebar.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
<h2 class="mb-3">Add Faculty</h2>
<hr>
<div class="container">
    <form method="POST">
        <div class="row mt-3 mb-2">
            <div class="col-6">
            <label for="faculty" class="form-label">Enter Faculty Name</label>
            <input type="text" name="faculty" class="form-control" >
            <?php if(isset($message)){echo $message;} ?>
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
</body>
</html>