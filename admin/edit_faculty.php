<?php
// Include database configuration
include "../includes/config.php";
if (!$_SESSION['id']) {
    header('location: ../login');
}
if (isset($_POST["submit"])) {
    // Validate form data
    $facultyId = mysqli_real_escape_string($conn, $_POST['id']);
    $facultyName = mysqli_real_escape_string($conn, $_POST['name']);

    // Update faculty in the database
    $query = "UPDATE `faculty` SET `name` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $facultyName, $facultyId);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to the faculty management page
        header("Location: manage_faculty_&_program");
        exit();
    } else {
        echo "Update failed. Please try again.";
    }

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
     <title>Edit Faculty</title>
</head>
<body>
<div class="container-fluid">
<div class="row">
        <!-- Sidebar -->
 <?php include '../includes/admin_sidebar.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
<?php
// Check if ID parameter is provided
if (isset($_GET['id'])) {
    $facultyId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch faculty data
    $query = "SELECT id, name FROM faculty WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $facultyId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Display a form to edit faculty
        echo "<h2>Edit Faculty</h2>";
        echo "<form method='post'>";
        echo "<div class='row'>";
        echo "<div class='col-12 mb-2'>";
        echo "<input type='hidden' class='form-control' name='id' value='" . $row['id'] . "'>";
        echo "Name: <input type='text' class='form-control' name='name' value='" . htmlspecialchars($row['name']) . "'>";
        echo "</div>";
         echo "<div class='col-4'>";
        echo "<input type='submit' class='form-control bg-warning' name='submit' value='Update'>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
    } else {
        echo "Faculty not found.";
    }
} else {
    echo "ID parameter is missing.";
}

// Close the database connection
mysqli_close($conn);
?>
</div>
</div>
</main>
</body>
</html>