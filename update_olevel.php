<?php
include("includes/config.php"); // Database connection
include "includes/header.php";
if (!$_SESSION['id']) {
    header("location: login");
}

if (isset($_POST['update'])) {
    $user_id = $_SESSION['id'];
    $sittingCount = $_POST['sittingCount'];

    // Loop through each sitting and insert/update the data
    for ($i = 0; $i < $sittingCount; $i++) {
        $data = [
            'exam_type' => $_POST['exam_type'][$i],
            'exam_no' => $_POST['exam_no'][$i],
            'year' => $_POST['year'][$i],
            'exam_center' => $_POST['exam_center'][$i],
            'english' => $_POST['english'][$i],
            'english_grade' => $_POST['english_grade'][$i],
            'maths' => $_POST['maths'][$i],
            'maths_grade' => $_POST['maths_grade'][$i],
            'subject1' => $_POST['subject1'][$i],
            'subject1_grade' => $_POST['subject1_grade'][$i],
            'subject2' => $_POST['subject2'][$i],
            'subject2_grade' => $_POST['subject2_grade'][$i],
            'subject3' => $_POST['subject3'][$i],
            'subject3_grade' => $_POST['subject3_grade'][$i],
            'subject4' => $_POST['subject4'][$i],
            'subject4_grade' => $_POST['subject4_grade'][$i]
        ];

        // Check if the record exists
        $checkQuery = "SELECT * FROM olevel WHERE student_id = ? AND exam_type = ?";
        $checkStmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, "is", $user_id, $data['exam_type']);
        mysqli_stmt_execute($checkStmt);
        $checkResult = mysqli_stmt_get_result($checkStmt);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update the existing record
            $updateQuery = "UPDATE olevel SET
                exam_no = ?, year = ?, exam_center = ?, english = ?, english_grade = ?,
                maths = ?, maths_grade = ?, subject1 = ?, subject1_grade = ?,
                subject2 = ?, subject2_grade = ?, subject3 = ?, subject3_grade = ?,
                subject4 = ?, subject4_grade = ?
                WHERE student_id = ? AND exam_type = ?";
                
            $updateStmt = mysqli_prepare($conn, $updateQuery);
            $updateBindParams = array_merge(
                array_values($data),
                [$user_id, $data['exam_type']]
            );
            $updateBindString = str_repeat('s', count($updateBindParams) - 2); // Exclude the last two parameters
            mysqli_stmt_bind_param($updateStmt, $updateBindString, ...$updateBindParams);
            
            if (!mysqli_stmt_execute($updateStmt)) {
                $errorMessage = "Error updating record: " . mysqli_error($conn);
            }else {
                $successMessage = "Successfully Saved";
            }
        } else {
            // Insert a new record
            $insertQuery = "INSERT INTO olevel (student_id, exam_type, exam_no, year, exam_center, english, english_grade, maths, maths_grade, subject1, subject1_grade, subject2, subject2_grade, subject3, subject3_grade, subject4, subject4_grade)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
            $insertStmt = mysqli_prepare($conn, $insertQuery);
            $insertBindParams = array_merge([$user_id], array_values($data));
            $insertBindString = str_repeat('s', count($insertBindParams));
            mysqli_stmt_bind_param($insertStmt, $insertBindString, ...$insertBindParams);
            
            if (!mysqli_stmt_execute($insertStmt)) {
                $errorMessage = "Error inserting record: " . mysqli_error($conn);
            }else {
                $successMessage = "Successfully Saved";
            }
        }
    }
    

    // Redirect after all iterations are complete
    header("location: olevel");

    // Close the database connection
    mysqli_close($conn);
}
include "includes/student_swal_functions.php";
?>
<body></body>
<?php include "includes/student_swal_script.html"; ?>