<?php
require '../config/config.php';

$qry = "SELECT * FROM `courses` order by `title`";
$qrycheck = $mysqli->query($qry) or die($mysqli->error);

// Pagination
if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 2;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM `questions`";
$result = $mysqli->query($total_pages_sql);
$total_rows = $result->fetch_array()[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
/*
* Get all added course
*/
$query="SELECT * FROM `questions` order by `created_at` LIMIT $offset, $no_of_records_per_page";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
if($result->num_rows>0){
  while($course = $result->fetch_assoc()){
    $course_id = $course['course_id'];
  }
}
/*
* Get course
*/
$courseQuery="SELECT * FROM `courses` WHERE `id` = '$course_id'";
$results = $mysqli->query($courseQuery) or die($mysqli->error.__LINE__);
// Total rows
$total = $result->num_rows;
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
        <li class="breadcrumb-item active">Question management</li>
      </ol>
		<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Questions table 
          <div><a class="btn btn-success" data-toggle="modal" data-target="#addQuestion">
            <i class="fa fa-fw fa-plus"></i>Add Question</a></div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Courses</th>
                  <th>Questions Count</th>
                  <th>Time Given</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Courses</th>
                  <th>Questions Count</th>
                  <th>Time Given</th>
                </tr>
              </tfoot>
              <tbody>
              <?php while($row = $results->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $total; ?></td>
                  <td>1hr : 45mins</td>
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
<div class="modal fade" id="addQuestion" tabindex="-1" role="dialog" aria-labelledby="addQuestion" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addQuestion">Add New Student</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="question.php" method="post">
            <?php include('../errors.php'); ?>
              <div class="form-group">
                <select name="course" class="form-control" required>
                  <option value="">Select course title</option>
                  <?php while($courseTitle = $qrycheck->fetch_assoc()){ ?>
                    <option value="<?php echo $courseTitle['title'] ?>"><?php echo $courseTitle['title'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <input type="text" name="number" placeholder="Enter question number" required>
              </div>
              <div class="form-group">
                <textarea name="question" class="form-control"
                placeholder="Enter question"></textarea>
              </div>
              <div class="form-group">
                <input type="text" name="optionA" class="form-control" placeholder="Option A" required>
              </div>
              <div class="form-group">
                <input type="text" name="optionB" class="form-control" placeholder="option B" required>
              </div>
              <div class="form-group">
                <input type="text" name="optionC" class="form-control" placeholder="option C" required>
              </div>
              <div class="form-group">
                <input type="text" name="optionD" class="form-control" placeholder="option D" required>
              </div>
              <div class="form-group">
                <input type="text" name="answer" class="form-control" placeholder="Answer option (e.g OptionA)" required>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary rounded" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success rounded" type="submit" name="addQuestion">Add</button>
          </div>
          </form>
        </div>
      </div>
<!-- Include footer file -->
<?php include('./partials/footer.php'); ?>