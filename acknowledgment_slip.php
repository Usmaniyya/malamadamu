<?php
include("includes/config.php");// Database connection

if (!$_SESSION['id']){
    header("location: login");
}

if (isset($_SESSION['email'])) {
    $student_id =  $_SESSION['id'];

    // Fetch all fields for the user with the specific ID
    $query = "SELECT programs.name AS 'program', faculty.name AS 'faculty', applicants.passport_path,signup.first_name,signup.last_name,payments.reference,payments.paid_at,payments.channel,payments.amount,payments.status FROM `signup` 
              JOIN applicants ON signup.id = applicants.student_id
              JOIN payments ON signup.id = payments.student_id
              JOIN choice_of_study ON signup.id = choice_of_study.applicant_id
              JOIN faculty ON faculty.id = choice_of_study.faculty
              JOIN programs ON programs.faculty_id = choice_of_study.program
              WHERE payments.student_id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);
    $amount_data = $user_data['amount']?? '0';
    $amount =number_format($amount_data / 100, 2);
    // Close the database connection
    mysqli_close($conn);
}

if (empty($user_data['reference']) || empty($user_data['status'])) {
    echo "<center>No Payment Has Been Made</center>";
}else{
?>
<!DOCTYPE html>
<html>
<head>
    <title>Acknowledgment Slip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background: #fff;
        }

        .header {
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .footer {
            /*text-align: center;*/
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .return-button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>MALAM ADAMU FOUNDATION</h1>
            <h2>Acknowledgment Slip</h2>
            <?php if (!empty($user_data['passport_path'])) { ?>
             <img src="<?= $user_data['passport_path'] ?>" alt="Passport Image" style="max-width: 100px;">
            <?php } ?>
        </div>
        <div class="content">
            <font style="font-size: 14px;">We have received your application and will process it shortly. If you have any questions or need further assistance, please don't hesitate to contact the Foundation.</font>

            <p><strong>Name:</strong> <?= $user_data['first_name'].' '.$user_data['last_name'] ?? '' ?></p>
            <p><strong>Application ID:</strong> <?= $user_data['reference'] ?? '' ?></p>
            <p><strong>Faculty:</strong><?= $user_data['faculty'] ?? '' ?></p>
            <p><strong>Applyed Program:</strong><?= $user_data['program'] ?? '' ?></p>
            <p><strong>Applyed On:</strong> <?= $user_data['paid_at'] ?? '' ?></p>
            <p><strong>Amount:</strong> &#8358;<?= $amount ?? '' ?></p>
            <p><strong>Paid Via:</strong> <?= $user_data['channel'] ?? '' ?></p>
            <p><strong>Status:</strong> <?= $user_data['status'] ?? '' ?></p>
            

        </div>
        <div class="footer">
        </div>
        <div class="button-container">
            <a href="#" class="return-button" onclick="print()" >Print</a>
        </div>
    </div>
</body>
</html>
<?php } ?>