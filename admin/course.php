<?php 
require '../config/config.php';
// Get courses
$query="SELECT * FROM `courses` order by 'created_at' ASC";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>
<!-- Include controller -->
<?php include('./courseController.php') ?>
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
        <li class="breadcrumb-item active">Course Management</li>
      </ol>
		<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Courses table 
          <div><a class="btn btn-success" data-toggle="modal" data-target="#addCourse">
            <i class="fa fa-fw fa-archive-plus"></i>Add</a></div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Course Title</th>
                  <th>Lecturer</th>
                  <th>Total Students</th>
                  <th>Modified</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>S/N</th>
                  <th>Course Title</th>
                  <th>Lecturer</th>
                  <th>Total Students</th>
                  <th>Modified</th>
                </tr>
              </tfoot>
              <tbody>
              <?php while($row = $result->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['lecturer']; ?></td>
                  <td><?php echo $row['student']; ?></td>
                  <td><a href="course.php?n=<?php echo $row['id']; ?>" class="btn"><i class="fa fa-trash text-danger"></i></a> /
                  <a href="update_course.php?u=<?php echo $row['id']; ?>" class="btn"><i class="fa fa-pencil-square text-success"></i></a></td>
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

<!-- Add Modal -->
<div class="modal fade" id="addCourse" tabindex="-1" role="dialog" aria-labelledby="addCourse" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addCourse">Add New Course</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="course.php" method="post">
            <?php include('../errors.php'); ?>
              <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Course Title" required>
              </div>
              <div class="form-group">
                <input type="text" name="lecturer" class="form-control" placeholder="Course Lecturer" required>
              </div>
              <div class="form-group">
                <input type="text" name="student" class="form-control" placeholder="Number of student taken the course" required>
              </div>
              <div class="form-group">
                <input type="text" name="time" class="form-control" placeholder="Time given (e.g 00:20:50)" required>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="addCourse">Add Course</button>
          </div>
          </form>
        </div>
      </div>

      <!-- Update Modal -->
<div class="modal fade" id="updateCourse" tabindex="-1" role="dialog" aria-labelledby="updateCourse" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateCourse">Add New Course</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="course.php" method="post">
            <?php include('../errors.php'); ?>
              <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Course Title" required>
              </div>
              <div class="form-group">
                <input type="text" name="lecturer" class="form-control" placeholder="Course Lecturer" required>
              </div>
              <div class="form-group">
                <input type="text" name="student" class="form-control" placeholder="Number of student taken the course" required>
              </div>
              <div class="form-group">
                <input type="text" name="time" class="form-control" placeholder="Time given (e.g 00:20:50)" required>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="addCourse">Add Course</button>
          </div>
          </form>
        </div>
      </div>
<!-- Include footer file -->
<?php include('./partials/footer.php'); ?>