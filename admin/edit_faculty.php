<?php
// Include database configuration
include "../includes/config.php";

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
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "Name: <input type='text' name='name' value='" . htmlspecialchars($row['name']) . "'>";
        echo "<input type='submit' name='submit' value='Update'>";
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
