<?php
include '../includes/config.php'; // Database connection
if (!$_SESSION['id']) {
    header('location: ../login');
}
if ($_SESSION['status'] != 1) {
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
INNER JOIN payments p ON s.id = p.student_id
GROUP BY s.id
ORDER BY total_score DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Database query failed.');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$system_name?></title>
<?php include "../includes/header.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

<?php include "../includes/navbars.php"; ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar bgColor elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text text-warning">M.A FOUNDATION</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

     <?php include "../includes/sidebar.php"; ?>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Applications</span>
                <span class="info-box-number">
                <?= $total_applications ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Accepted</span>
                <span class="info-box-number"><?= $total_accepted ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Rejected</span>
                <span class="info-box-number"><?= $total_rejected ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- .row -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Not Decided</span>
                  <span class="info-box-number"><?= $total_not_viewed ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Payments</span>
                <span class="info-box-number"><?= $total_payments ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Amount</span>
                <span class="info-box-number">&#8358;<?= $total_amount ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
          <!-- /.col -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">JAMB Total Scores</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8 mb-3">
                  <!-- <h2>JAMB Total Scores</h2> -->
                    <table id="myTable" class="table table-striped table-bordered" cellpadding="1" cellspacing="1" width="100%">
                    <thead>
                      <tr>
                            <th>(Applicant)_Name</th>
                            <!-- <th>Last Name</th> -->
                            <th>Email</th>
                            <th>JAMB_Number</th>
                            <th>Jamb_Score</th>
                            <th>Rank</th>
                            <th>Details</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $rank = 1; // Initialize rank
                        while ($row = mysqli_fetch_assoc($result)) {
                            $applicantId = htmlspecialchars($row['id']);
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['first_name']).' '.htmlspecialchars($row['last_name']) . '</td>';
                            // echo '<td>' . htmlspecialchars($row['last_name']) . '</td>';
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
                      </tbody>
                    </table>

                  </div>
                  <!-- /.col -->
              <div class="col-md-4">
                  <div class="col-md-12">
                <!-- Info Boxes Style 2 -->
                <div class="info-box mb-3 bg-warning">
                  <span class="info-box-icon"><i class="fas fa-award"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Programs</span>
                    <span class="info-box-number"><?= $total_programs ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box mb-3 bg-success">
                  <span class="info-box-icon"><i class="fa fa-book-open"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Faculties</span>
                    <span class="info-box-number"><?= $total_faculty ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box mb-3 bg-danger">
                  <span class="info-box-icon"><i class="fas fa-solid fa-certificate"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Authorized</span>
                    <span class="info-box-number"><?= $total_admins ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box mb-3 bg-info">
                  <span class="info-box-icon"><i class="far fa-comment"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Complains</span>
                    <span class="info-box-number">0</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include "../includes/footer_content.php"; ?>
</div>
<!-- ./wrapper -->
<?php include "../includes/footer2.php"; ?>
</body>
</html>
