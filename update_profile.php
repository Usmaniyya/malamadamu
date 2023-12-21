<?php
require_once("includes/config.php");// Database connection
include "includes/header.php";

if (!$_SESSION['id']){
    header("location: login");
}
if (isset($_POST['update'])) {

    // Extract and sanitize form data
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $lga = mysqli_real_escape_string($conn, $_POST['lga']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $next_of_kin = mysqli_real_escape_string($conn, $_POST['next_of_kin']);
    $nok_address = mysqli_real_escape_string($conn, $_POST['nok_address']);
    $nok_email = mysqli_real_escape_string($conn, $_POST['nok_email']);
    $relation = mysqli_real_escape_string($conn, $_POST['relation']);
    
    if ($phone && $dob && $state && $lga && $address && $next_of_kin && $nok_address && $nok_email && $relation) {
        $errorMessage = "*All fields are required";
    }
    // File upload for passport
    $passport_path = ''; // Initialize to an empty string

    if (isset($_FILES['passport']) && $_FILES['passport']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Directory where passport images are stored
        $passport_filename = $_FILES['passport']['name'];
        $passport_temp = $_FILES['passport']['tmp_name'];
        $passport_path = $upload_dir . $passport_filename;

        // Move the uploaded file to the desired directory
        move_uploaded_file($passport_temp, $passport_path);
    }

    $student_id = $_SESSION["id"]; 

    // Check if a record already exists for the student
    $check_query = "SELECT student_id FROM applicants WHERE student_id = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, "i", $student_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        // A record already exists, update it
        $query = "UPDATE applicants
                  SET phone = ?, dob = ?, state = ?, lga = ?, address = ?, next_of_kin = ?, nok_address = ?, nok_email = ?, relation = ?, passport_path = ?
                  WHERE student_id = ?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssssi", $phone, $dob, $state, $lga, $address, $next_of_kin, $nok_address, $nok_email, $relation, $passport_path, $student_id);
    } else {
        // No record exists, insert a new one
        $query = "INSERT INTO applicants (student_id, phone, dob, state, lga, address, next_of_kin, nok_address, nok_email, relation, passport_path)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "issssssssss", $student_id, $phone, $dob, $state, $lga, $address, $next_of_kin, $nok_address, $nok_email, $relation, $passport_path);
    }

    if (mysqli_stmt_execute($stmt)) {
        $successMessage = "Data Saved successfully!";
       header("refresh:2; url='olevel'"); // Redirect to the dashboard
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}  
include "includes/student_swal_functions.php";
?>

<?php include "includes/student_swal_script.html"; ?>