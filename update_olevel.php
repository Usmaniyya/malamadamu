<?php
include("includes/config.php"); // Database connection
if (!$_SESSION['id']){
    header("location: login");
}
if (isset($_POST['update'])) {
    $user_id = $_SESSION['id'];
    // Get the number of sittings
    // $sittingCount = isset($_POST['sittingCount']) ? count($_POST['exam_type']) : 0;
    $sittingCount = $_POST['sittingCount'];
    echo($sittingCount);
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

        // Define the query for inserting or updating
        $query = "INSERT INTO olevel (student_id, exam_type, exam_no, year, exam_center, english, english_grade, maths, maths_grade, subject1, subject1_grade, subject2, subject2_grade, subject3, subject3_grade, subject4, subject4_grade)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            exam_type = VALUES(exam_type),
            exam_no = VALUES(exam_no),
            year = VALUES(year),
            exam_center = VALUES(exam_center),
            english = VALUES(english),
            english_grade = VALUES(english_grade),
            maths = VALUES(maths),
            maths_grade = VALUES(maths_grade),
            subject1 = VALUES(subject1),
            subject1_grade = VALUES(subject1_grade),
            subject2 = VALUES(subject2),
            subject2_grade = VALUES(subject2_grade),
            subject3 = VALUES(subject3),
            subject3_grade = VALUES(subject3_grade),
            subject4 = VALUES(subject4),
            subject4_grade = VALUES(subject4_grade)";

        // Prepare and execute the query
        $stmt = mysqli_prepare($conn, $query);
        $bindParams = array_merge([$user_id], array_values($data));
        $bindString = str_repeat('s', count($bindParams));
        mysqli_stmt_bind_param($stmt, $bindString, ...$bindParams);
        // mysqli_stmt_execute($stmt);
        if(mysqli_stmt_execute($stmt)){
            header("location:olevel");
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
