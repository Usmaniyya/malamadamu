<?php
// Include database configuration
include "../includes/config.php";
if (!$_SESSION['id']) {
    header('location: ../login');
}
// Fetch data from faculty table
$facultyQuery = "SELECT id, name FROM faculty";
$facultyResult = mysqli_query($conn, $facultyQuery);

// Fetch data from programs table
$programsQuery = "SELECT id, faculty_id, name FROM programs";
$programsResult = mysqli_query($conn, $programsQuery);
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
    <title>Manage Faculty & Programs</title>
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
<h2 class="mb-3">Manage Faculty & Programs</h2>
<hr>
<div class="container">

<div class="row mt-3 mb-2">
    <div class="col-6">
        <table class="table">
            <tr class="bg-warning">
                <th>ID</th>
                <th>Faculties</th>
                <th>Action</th>
            </tr>
            <?php
            while ($facultyRow = mysqli_fetch_assoc($facultyResult)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($facultyRow['id']) . "</td>";
                echo "<td>" . htmlspecialchars($facultyRow['name']) . "</td>";
                echo "<td>
                        <a href='edit_faculty?id=" . $facultyRow['id'] . "'><i class='bi bi-pencil-square text-info'></i></a> |
                        <a href='delete_faculty_confirm?id=" . $facultyRow['id'] . "'><i class='bi bi-trash text-danger'></i></a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="col-6">
        <!-- <h2>Programs Table</h2> -->
        <table class="table">
            <tr class="bg-warning">
                <th>Faculty ID</th>
                <th>Programs</th>
                <th>Action</th>
            </tr>
            <?php
            while ($programsRow = mysqli_fetch_assoc($programsResult)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($programsRow['faculty_id']) . "</td>";
                echo "<td>" . htmlspecialchars($programsRow['name']) . "</td>";
                echo "<td>
                        <a href='edit_program?id=" . $programsRow['id'] . "'><i class='bi bi-pencil-square text-info'></i></a> |
                        <a href='delete_program_confirm?id=" . $programsRow['id'] . "'><i class='bi bi-trash text-danger'></i></a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
