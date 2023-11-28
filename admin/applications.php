<?php
include '../includes/config.php'; // Database connection

// Perform the query
$query = "SELECT a.id, a.student_id AS applicant_id, a.phone, a.dob, a.state, a.lga, a.address, a.next_of_kin, a.nok_address, a.nok_email, a.relation, a.passport_path, s.id AS signup_id, s.first_name, s.last_name, s.email, s.rank, s.status, s.created_at, s.updated_at
FROM applicants a
INNER JOIN signup s ON a.student_id = s.id";

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
    <title>Applications</title>
</head>
<body>
    <div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
 <?php include '../includes/admin_sidebar.php'; ?>
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
    <h3>Applications</h3>
    <hr>
    <?php
    if ($result) {
        echo '<table class="table">';
        echo '<tr class="bg-warning"><th>A-ID</th><th>Name</th><th>Email</th><th>Phone</th><th>State</th><th>LGA</th><th>View</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {

            $applicantId = $row['applicant_id'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $state = $row['state'];
            $lga = $row['lga'];
            ?>
            <tr>
                <td> <?= $applicantId ?></td>
                <td> <?= $firstName . ' ' . $lastName ?></td>
                <td> <?= $email ?> </td>
                <td> <?= $phone ?> </td>
                <td> <?= $state ?> </td>
                <td> <?= $lga ?> </td>
                <td><a class="bg-primary p-2 text-light text-decoration-none rounded" href='view_applications?id=<?= $applicantId ?>'>View</a></td>
            </tr>
        <?php
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
</body>
</html>

