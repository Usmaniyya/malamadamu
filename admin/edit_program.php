<?php
// Include database configuration
include "../includes/config.php";

if (isset($_POST["submit"])) {
    // Validate form data
    $facultyId = mysqli_real_escape_string($conn, $_POST['faculty_id']);
    $programName = mysqli_real_escape_string($conn, $_POST['name']);
    $programId = mysqli_real_escape_string($conn, $_POST['program_id']);

    // Update program in the database
    $query = "UPDATE `programs` SET `name` = ?, `faculty_id` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sii", $programName, $facultyId, $programId);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to the program management page
        header("Location: manage_faculty_&_program");
        exit();
    } else {
        echo "Update failed. Please try again.";
    }
}

// Check if ID parameter is provided
if (isset($_GET['id'])) {
    $programId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch program data
    $query = "SELECT id, faculty_id, name FROM programs WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $programId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Display a form to edit program
        echo "<h2>Edit Program</h2>";
        echo "<form method='post'>";
        echo '<select name="faculty_id" class="form-select">';
        $query_faculty_data = "SELECT * FROM `faculty` ";
        $query_faculty = mysqli_query($conn, $query_faculty_data);
        while ($row_faculty = mysqli_fetch_assoc($query_faculty)) {
            $id = $row_faculty['id'];
            $faculty = $row_faculty['name'];

            $selected = ($id == $row['faculty_id']) ? 'selected' : '';
            echo '<option value="' . $id . '" ' . $selected . '>' . $faculty . '</option>';
        }
        echo '</select>';
        echo "Name: <input type='text' name='name' value='" . htmlspecialchars($row['name']) . "'>";
        echo "Name: <input type='hidden' name='program_id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<input type='submit' name='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "Program not found.";
    }
} else {
    echo "ID parameter is missing.";
}

// Close the database connection
mysqli_close($conn);
?>
