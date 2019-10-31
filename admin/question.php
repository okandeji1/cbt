<?php
require '../config/config.php';
$qry = "SELECT * FROM `courses` order by `title`";
$qrycheck = $mysqli->query($qry) or die($mysqli->error);

/*
* Get all added course
*/
$query="SELECT * FROM `questions` order by `created_at`";
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
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Next</a>
                </li>
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
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" type="submit" name="addQuestion">Add</button>
          </div>
          </form>
        </div>
      </div>
<!-- Include footer file -->
<?php include('./partials/footer.php'); ?>