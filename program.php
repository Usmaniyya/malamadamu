<?php
include 'includes/config.php'; // Database connection
if (!$_SESSION['id']) {
    header('location: login');
}
if(isset($_POST["program"])){
$applicant_id = mysqli_real_escape_string($conn, $_SESSION['id']);
$faculty = mysqli_real_escape_string($conn, $_POST["faculty"]);
$program = mysqli_real_escape_string($conn, $_POST["program"]);

$sql = "INSERT INTO `choice_of_study`(`applicant_id`, `faculty`, `program`) VALUES (?, ?, ?)
ON DUPLICATE KEY UPDATE
        applicant_id = VALUES(applicant_id), faculty = VALUES(faculty), program = VALUES(program)";

// Prepare the statement
$stmt = mysqli_prepare($conn, $sql);

// Bind parameters
mysqli_stmt_bind_param($stmt, "iii", $applicant_id, $faculty, $program);

// Execute the statement
mysqli_stmt_execute($stmt);

// Check for success
if (mysqli_stmt_affected_rows($stmt) > 0) {
   $message = "<span class='alert alert-success'>Program Saved successfully.</span>";
} else {
   $message = "<span class='alert alert-danger'>Error Saving Program.</span>";
}

// Close the statement
mysqli_stmt_close($stmt);
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
    <title>Program</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
<?php 
include 'includes/student_sidebar.php';
  
if (isset($_SESSION['email'])) {
    $user_id = $_SESSION['id'];

    $query =
        'SELECT programs.name AS "program", faculty.name AS "faculty", signup.first_name, signup.last_name FROM `choice_of_study` JOIN programs ON programs.faculty_id = choice_of_study.program JOIN signup ON signup.id = choice_of_study.applicant_id JOIN faculty ON faculty.id = choice_of_study.faculty WHERE choice_of_study.applicant_id = ?';

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);
}
?>
 
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
<h2 class="mb-3">Program of Study</h2>
<hr>
<div class="container">
    <h4>Select the program you want to study</h4>
    <form method="POST">
        <div class="row mb-2">
       <?php $default_message = "<span class='alert alert-success'>Program Selected successfully. </span>";?>
            <?php $message = isset($user_data["program"])? $default_message : ''?>
            <?=$message?>
            <div class="col-6">
                <label for="faculty" class="form-label">Faculty</label>
                <select name="faculty" class="form-select" onchange="fetchFaculty(this.value)">
                <option><?=$user_data["faculty"]?? 'Select Faculty...'?></option>
                <?php
                  $query_faculty_data = "SELECT * FROM `faculty` ";
                  $query_faculty = mysqli_query($conn, $query_faculty_data);
                  while($row = mysqli_fetch_assoc($query_faculty)) {
                    $id = $row['id'];
                    $faculty = $row['name'];

                    echo '<option value="'.$id.'">'.$faculty.'</option>';
                  }
                 ?>
              </select>
              
            </div>
            <div class="col-6">
                <label for="program" class="form-label">Program</label>
                <select id="faculty-data" class="form-select" name="program">
                <option><?=$user_data["program"]?? ''?></option>
                    <!-- programs -->
                </select>
            </div>
        </div>
    <div class="row">
        <div class="col-6">
             <button type="submit" name="submit" class="btn btn-warning">Update</button>
        </div>
    </div>
    </form>
    <?php mysqli_close($conn);// Close the database connection?>
</div>
</main>
</div>
</div>
</body>
</html>
<script>
  function fetchFaculty(id){
    $('#faculty-data').html('');
    $.ajax({
      type:"POST",
      url:'fetch-faculty',
      data: {faculty_id:id},
      success: function(data){
        $('#faculty-data').html(data);
      }
    })
  }
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>