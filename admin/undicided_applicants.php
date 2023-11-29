<?php
include '../includes/config.php'; // Database connection

// Perform the query
$query = "SELECT a.status, a.id, a.student_id AS applicant_id, a.phone, a.dob, a.state, a.lga, a.address, a.next_of_kin, a.nok_address, a.nok_email, a.relation, a.passport_path, s.id AS signup_id, s.first_name, s.last_name, s.email, s.rank, s.status, s.created_at, s.updated_at
FROM applicants a
INNER JOIN signup s ON a.student_id = s.id WHERE a.status = 0";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <title>Undecided</title>
</head>
<body>
    <div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
 <?php include '../includes/admin_sidebar.php'; ?>
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <h3>Undecided</h3>
    <hr>
<?php
if ($result) {
    echo '<table border="1" class="table" id="myTable">';
    echo '<thead><tr class=""><th>A-ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Dob</th><th>State</th><th>LGA</th><th>View</th></tr></thead>';
    while ($row = mysqli_fetch_assoc($result)) {
        $applicantId = $row['applicant_id'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $dob = $row['dob'];
        $state = $row['state'];
        $lga = $row['lga'];

        echo '<tr>';
        echo '<td>' . $applicantId . '</td>';
        echo '<td>' . $firstName . ' ' . $lastName . '</td>';
        echo '<td>' . $email . '</td>';
        echo '<td>' . $phone . '</td>';
        echo '<td>' . $dob . '</td>';
        echo '<td>' . $state . '</td>';
        echo '<td>' . $lga . '</td>';
        echo '<td><a class="bg-primary p-2 text-light text-decoration-none rounded" href="view_applications?id=' .
            $applicantId .
            '">View</a></td>';
        echo '</tr>';
    }
    echo '</table>';

    // Free the result set
    mysqli_free_result($result);
} else {
    echo 'Query failed: ' . mysqli_error($conn);
}
// Close the database connection
mysqli_close($conn);
?>
</main>
</div>
</div>
</body>
</html>
<script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>