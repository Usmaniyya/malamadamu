<?php
include 'includes/config.php'; // Database connection
session_start();

if (!isset($_SESSION['id'])) {
    header('location: login');
    exit();
}

include 'admin/fetch_data.php';

if (isset($_SESSION['email'])) {
    $student_id = $_SESSION['id'];

    // Fetch all fields for the user with the specific ID
    $query = 'SELECT * FROM `signup` JOIN applicants ON signup.id = applicants.student_id WHERE applicants.student_id = ?';

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);

    // Close the database connection
    mysqli_close($conn);
}

// Get form data
$student_id = $_SESSION['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$other_name = $_POST['other_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$state = "Jigawa";
$lga = "Gwaram";
$address = $_POST['address'];
$nok_address = $_POST['nok_address'];
$next_of_kin = $_POST['next_of_kin'];
$nok_email = $_POST['nok_email'];
$relation = $_POST['relation'];

// Check if the record exists
if ($user_data) {
    // Update the existing records
    $updateSignupQuery = "UPDATE `signup` SET
        first_name = ?,
        last_name = ?,
        other_name = ?,
        email = ?
        WHERE id = ?";

    $updateApplicantsQuery = "UPDATE `applicants` SET
        state = ?,
        lga = ?,
        address = ?,
        nok_address = ?,
        next_of_kin = ?,
        nok_email = ?,
        relation = ?,
        phone = ?,
        dob = ?
        WHERE student_id = ?";

    $updateSignupStmt = mysqli_prepare($conn, $updateSignupQuery);
    mysqli_stmt_bind_param(
        $updateSignupStmt,
        'ssss',
        $first_name,
        $last_name,
        $other_name,
        $email
    );

    $updateApplicantsStmt = mysqli_prepare($conn, $updateApplicantsQuery);
    mysqli_stmt_bind_param(
        $updateApplicantsStmt,
        'sssssssss',
        $state,
        $lga,
        $address,
        $nok_address,
        $next_of_kin,
        $nok_email,
        $relation,
        $phone,
        $dob
    );

    if (mysqli_stmt_execute($updateSignupStmt) && mysqli_stmt_execute($updateApplicantsStmt)) {
        $successMessage = "Data Saved successfully";
    } else {
        $errorMessage = "Error updating data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($updateSignupStmt);
    mysqli_stmt_close($updateApplicantsStmt);
} else {
    // Insert a new record
    $insertSignupQuery = "INSERT INTO `signup` (first_name, last_name, other_name, email)
        VALUES (?, ?, ?, ?)";

    $insertApplicantsQuery = "INSERT INTO `applicants` (student_id, state, lga, address, nok_address, next_of_kin, nok_email, relation, phone, dob)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $insertSignupStmt = mysqli_prepare($conn, $insertSignupQuery);
    mysqli_stmt_bind_param(
        $insertSignupStmt,
        'ssss',
        $first_name,
        $last_name,
        $other_name,
        $email
    );

    $insertApplicantsStmt = mysqli_prepare($conn, $insertApplicantsQuery);
    mysqli_stmt_bind_param(
        $insertApplicantsStmt,
        'isssssssss',
        $student_id,
        $state,
        $lga,
        $address,
        $nok_address,
        $next_of_kin,
        $nok_email,
        $relation,
        $phone,
        $dob
    );

    if (mysqli_stmt_execute($insertSignupStmt) && mysqli_stmt_execute($insertApplicantsStmt)) {
        $successMessage = "Data Saved successfully";
    } else {
        $errorMessage = "Error Saving data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($insertSignupStmt);
    mysqli_stmt_close($insertApplicantsStmt);
}

// Close the database connection
mysqli_close($conn);

// Redirect back to the profile page
header("Location: student_profile");
exit();
?>
