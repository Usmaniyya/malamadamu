<?php
include '../includes/config.php'; // Database connection
if (!$_SESSION['id']) {
    header('location: ../login');
}
include 'fetch_data.php';

// Prepare and execute the SQL query with calculated total score and order by total_score
$sql = "SELECT 
    s.id,
    s.first_name,
    s.last_name,
    s.email,
    j.jamb_reg_no,
    SUM(j.english_score + j.subject1_score + j.subject2_score + j.subject3_score) AS total_score
FROM signup s
INNER JOIN jamb_results j ON s.id = j.student_id
GROUP BY s.id
ORDER BY total_score DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Database query failed.');
}
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
    <title>Dashboard - Admin</title>

</head>
<body>
    <div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
 <?php include '../includes/admin_sidebar.php'; ?>
 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-2">
    <h2 class="mb-2">Admin Dashboard</h2>
    <hr>
    <div class="row mb-2">
        <div class="col-4">
            <div class="bg-warning text-dark px-3 py-4 rounded">
                <h5>Total Applications: <?= $total_applications ?></h5>
            </div>
        </div>
        <div class="col-4">
             <div class="bg-success text-light px-3 py-4 rounded">
                <h5>Total Accepted: <?= $total_accepted ?></h5>
            </div>
        </div>
        <div class="col-4">
            <div class="bg-danger text-light px-3 py-4 rounded">
                <h5>Total Rejected: <?= $total_rejected ?></h5>
            </div>
        </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="bg-primary text-light px-3 py-4 rounded">
<h5> Not Decided: <?= $total_not_viewed ?></h5>
        </div>
    </div>
    <div class="col-4">
        <div class="bg-secondary text-light px-3 py-4 rounded">
<h5>Total Payments: <?= $total_payments ?></h5>
        </div>
    </div>
    <div class="col-4">
        <div class="bg-info text-dark px-3 py-4 rounded">
<h5>Total Amount: &#8358;<?= $total_amount ?></h5>
        </div>
    </div>
</div>
<hr>
    <h2>JAMB Total Scores</h2>
<table class="table">
    <tr class="bg-warning">
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>JAMB Number</th>
        <th>Jamb Score</th>
        <th>Rank</th>
        <th>Details</th>
    </tr>

    <?php
    $rank = 1; // Initialize rank
    while ($row = mysqli_fetch_assoc($result)) {
        $applicantId = htmlspecialchars($row['id']);
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['first_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['last_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . htmlspecialchars($row['jamb_reg_no']) . '</td>';
        echo '<td>' . htmlspecialchars($row['total_score']) . '</td>';
        echo '<td>' . $rank . '</td>'; // Display the rank
        echo '<td><a class="bg-primary p-2 text-light text-decoration-none rounded" href="view_applications?id=' .
            $applicantId .
            '">View</a></td>';
        echo '</tr>';
        $rank++; // Increment rank for the next student
    }
    ?>
</table>
    </div>
</main>
</div>
</div>
</body>
</html>
