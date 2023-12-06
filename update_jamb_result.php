<?php
require_once("includes/config.php");// Database connection
if (!$_SESSION['id']){
    header("location: login");
}
if (isset($_POST['update'])) {
    // Extract and sanitize form data
    $student_id = $_SESSION['id'];
    // echo $student_id;
    $jamb_reg_no = mysqli_real_escape_string($conn, $_POST['jamb_reg_no']);
    $english = mysqli_real_escape_string($conn, $_POST['english']);
    $english_score = mysqli_real_escape_string($conn, $_POST['english_score']);
    $subject1 = mysqli_real_escape_string($conn, $_POST['subject1']);
    $subject1_score = mysqli_real_escape_string($conn, $_POST['subject1_score']);
    $subject2 = mysqli_real_escape_string($conn, $_POST['subject2']);
    $subject2_score = mysqli_real_escape_string($conn, $_POST['subject2_score']);
    $subject3 = mysqli_real_escape_string($conn, $_POST['subject3']);
    $subject3_score = mysqli_real_escape_string($conn, $_POST['subject3_score']);

    // SQL query to insert or update data
    $query = "INSERT INTO jamb_results (student_id, jamb_reg_no, english, english_score, subject1, subject1_score, subject2, subject2_score, subject3, subject3_score)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
              ON DUPLICATE KEY UPDATE
              english = VALUES(english), english_score = VALUES(english_score),
              subject1 = VALUES(subject1), subject1_score = VALUES(subject1_score),
              subject2 = VALUES(subject2), subject2_score = VALUES(subject2_score),
              subject3 = VALUES(subject3), subject3_score = VALUES(subject3_score)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "isssssssss", $student_id, $jamb_reg_no, $english, $english_score, $subject1, $subject1_score, $subject2, $subject2_score, $subject3, $subject3_score);

    if (mysqli_stmt_execute($stmt)) {
        echo "Data updated successfully!";
        header("refresh:2; url='program'");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
