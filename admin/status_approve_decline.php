<?php 
include "../includes/config.php"; // Include your database configuration
// Check if the decision has been made
if (isset($_GET['aid'])) {
    // Approve the applicant
    $applicantId = $_GET['aid'];
    $sql = "UPDATE applicants SET status = 1 WHERE student_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $applicantId);
    if (mysqli_stmt_execute($stmt)) {
        echo "Applicant approved successfully.";
        header("refresh:2; url='applications'");
    } else {
        echo "Failed to approve the applicant.";
        header("refresh:2; url='applications'");
    }
} elseif (isset($_GET['did'])) {
    // Decline the applicant
    $applicantId = $_GET['did'];
    $sql = "UPDATE applicants SET status = 2 WHERE student_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $applicantId);
    if (mysqli_stmt_execute($stmt)) {
        echo "Applicant rejected successfully.";
        header("refresh:2; url='applications'");
    } else {
        echo "Failed to reject the applicant.";
        header("refresh:2; url='applications'");
    }
}
