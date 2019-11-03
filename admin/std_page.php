<?php 
require '../config/config.php';
// Pagination
if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 2;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM `students`";
$result = $mysqli->query($total_pages_sql);
$total_rows = $result->fetch_array()[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
// Get student
$query="SELECT * FROM `students` LIMIT $offset, $no_of_records_per_page";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>
<!-- Include controller -->
<?php include('./studentController.php') ?>
<!-- Include header file -->
<?php include('./partials/header.php'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
    <?php include('../errors.php'); ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Admin</a>
        </li>
        <li class="breadcrumb-item active">Student Management</li>
      </ol>
		<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Students table 
          <div><a class="btn btn-success" data-toggle="modal" data-target="#addStd">
            <i class="fa fa-fw fa-user-plus"></i>Add</a></div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Surname</th>
                  <th>First Name</th>
                  <th>Email</th>
                  <th>Matric No</th>
                  <th>Department</th>
                  <th>Modified</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>S/N</th>
                  <th>Surname</th>
                  <th>First Name</th>
                  <th>Email</th>
                  <th>Matric No</th>
                  <th>Department</th>
                  <th>Modified</th>
                </tr>
              </tfoot>
              <tbody>
              <?php while($row = $result->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['surname']; ?></td>
                  <td><?php echo $row['firstname']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['matric_no']; ?></td>
                  <td><?php echo $row['department']; ?></td>
                  <td><a href="std_page.php?n=<?php echo $row['id']; ?>" class="btn"><i class="fa fa-trash text-danger"></i></a> /
                  <a href="update_std.php?u=<?php echo $row['id']; ?>" class="btn"><i class="fa fa-pencil-square text-success"></i></a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            <nav aria-label="...">
              <ul class="pagination pagination-sm add_bottom_30">
                <li class="page-item">
                  <a class="page-link" href="?pageno=1" tabindex="-1">First</a>
                </li>
                <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a></li>
                <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a></li>
                <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
              </ul>
		        </nav>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
	  <!-- /tables-->
	  </div>
	  <!-- /container-fluid-->
</div>

<!-- Modal -->
<div class="modal fade" id="addStd" tabindex="-1" role="dialog" aria-labelledby="addStd" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addStd">Add New Student</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="std_page.php" method="post">
            <?php include('../errors.php'); ?>
              <div class="form-group">
                <input type="text" name="surname" id="" class="form-control" placeholder="Surname" required>
              </div>
              <div class="form-group">
                <input type="text" name="firstname" id="" class="form-control" placeholder="Firstname" required>
              </div>
              <div class="form-group">
                <input type="text" name="other_name" id="" class="form-control" placeholder="Other name" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" id="" class="form-control" placeholder="Email" required>
              </div>
              <div class="form-group">
                <input type="password" name="password" id="" class="form-control" placeholder="Password" required>
              </div>
              <div class="form-group">
                <input type="text" name="matric_no" id="" class="form-control" placeholder="Matric/Reg No" required>
              </div>
              <div class="form-group">
                <input type="text" name="dept" id="" class="form-control" placeholder="Department" required>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="add_std">Add</button>
          </div>
          </form>
        </div>
      </div>
<!-- Include footer file -->
<?php include('./partials/footer.php'); ?>