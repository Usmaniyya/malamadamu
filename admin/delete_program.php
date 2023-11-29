<?php
// Include database configuration
include "../includes/config.php";

// Check if ID parameter is provided
if (isset($_GET['id'])) {
    $facultyId = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete program
    $query = "DELETE FROM programs WHERE faculty_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $facultyId);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($conn) > 0) {
        echo "Program deleted successfully.";
    } else {
        echo "Program not found or deletion failed.";
    }
} else {
    echo "ID parameter is missing.";
}

// Close the database connection
mysqli_close($conn);
?>
