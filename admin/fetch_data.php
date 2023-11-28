<?php
// include("../includes/config.php");// Database connection
//Retrive  and calculate the total number of Applications
$query_applications = mysqli_prepare($conn, "SELECT COUNT(id) AS 'total_applications' FROM `applicants`");
mysqli_stmt_execute($query_applications);
$data = mysqli_stmt_get_result($query_applications);
$row = mysqli_fetch_assoc($data);
$total_applications = $row['total_applications'];

$query_accepted = mysqli_prepare($conn, "SELECT COUNT(id) AS 'total_accepted' FROM `applicants` WHERE status = 1");
mysqli_stmt_execute($query_accepted);
$data = mysqli_stmt_get_result($query_accepted);
$row = mysqli_fetch_assoc($data);
$total_accepted = $row['total_accepted'];

 $query_rejected = mysqli_prepare($conn, "SELECT COUNT(id) AS 'total_rejected' FROM `applicants` WHERE status = 2");
mysqli_stmt_execute($query_rejected);
$data = mysqli_stmt_get_result($query_rejected);
$row = mysqli_fetch_assoc($data);
$total_rejected = $row['total_rejected'];

 $query_not_viewed = mysqli_prepare($conn, "SELECT COUNT(id) AS 'total_not_viewed' FROM `applicants` WHERE status = 0");
mysqli_stmt_execute($query_not_viewed);
$data = mysqli_stmt_get_result($query_not_viewed);
$row = mysqli_fetch_assoc($data);
$total_not_viewed = $row['total_not_viewed'];

$query_payments = mysqli_prepare($conn, "SELECT COUNT(id) AS 'total_payments', SUM(amount) AS 'total_amount' FROM `payments`");
mysqli_stmt_execute($query_payments);
$data = mysqli_stmt_get_result($query_payments);
$row = mysqli_fetch_assoc($data);
$total_payments = $row['total_payments'];
$total_amount = $row['total_amount'];
$total_amount = number_format($total_amount/100, 2);
?>