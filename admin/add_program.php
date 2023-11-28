<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
    <title>Add Program</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
 <?php include '../includes/admin_sidebar.php'; ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
<h2 class="mb-3">Add Program</h2>
<hr>
<div class="container">
    <form>
        <div class="row mt-3 mb-2">
            <div class="col-6">
            <label for="faculty"  class="form-label">Enter Faculty Name</label>
            <input type="text" name="" class="form-control" />
            </div>
            <div class="col-6">
            <label for="program" class="form-label">Enter Program Name</label>
            <input type="text" name="" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <button type="submit" class="px-5 btn btn-warning" name="">Add</button>
            </div>
        </div>
    </form>
</div>
</main>
</div>
</div>
</body>
</html>