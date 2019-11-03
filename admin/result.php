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

$total_pages_sql = "SELECT COUNT(*) FROM `results`";
$result = $mysqli->query($total_pages_sql);
$total_rows = $result->fetch_array()[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
/*
* Get all added results
*/
$query="SELECT * FROM `results` order by `created_at` LIMIT $offset, $no_of_records_per_page";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
if($result->num_rows>0){
  while($row = $result->fetch_assoc()){
    $student_id = $row['user_id'];
    $course_id = $row['course_id'];
    $score = $row['score'];
    $id = $row['id'];
  }
}
/*
* Get Students
*/
$studentQuery = "SELECT * FROM `students` WHERE `id` = '$student_id'";
$student = $mysqli->query($studentQuery) or die($mysqli->error);
/*
* Get course
*/
$courseQuery="SELECT * FROM `courses` WHERE `id` = '$course_id'";
$course = $mysqli->query($courseQuery) or die($mysqli->error.__LINE__);
if($course->num_rows>0){
    while($data = $course->fetch_assoc()){
        $title = $data['title'];
    }
}
?>
<!-- Include controller -->
<?php include('./questionController.php') ?>
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
        <li class="breadcrumb-item active">Result management</li>
      </ol>
		<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Results table 
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Students</th>
                  <th>Courses</th>
                  <th>Score</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>S/N</th>
                  <th>Students</th>
                  <th>Courses</th>
                  <th>Score</th>
                </tr>
              </tfoot>
              <tbody>
              <?php while($name = $student->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><?php echo $name['surname']; ?> <?php echo $name['firstname']; ?></td>
                  <td><?php echo $title; ?></td>
                  <td><?php echo $score; ?></td>
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
<!-- Include footer file -->
<?php include('./partials/footer.php'); ?>