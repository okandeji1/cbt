<?php 
require '../config/config.php';
// Set course ID
$course_id = (int) $_GET['u'];
// Get courses
$query="SELECT * FROM `courses` WHERE `id` = '$course_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>
<!-- Include controller -->
<?php include('./courseController.php') ?>
<!-- Include header file -->
<?php include('./partials/header.php'); ?>
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add listing</li>
      </ol>
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Basic info</h2>
			</div>
			<form action="update_course.php" class="dropzone" method="post">
			<?php include('../errors.php'); ?>
			<?php while($row = $result->fetch_assoc()){ ?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Course Title</label>
						<input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Lecturer</label>
						<input type="text" name="lecturer" value="<?php echo $row['lecturer']; ?>" class="form-control">
					</div>
				</div>
			</div>
			<!-- /row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Student</label>
						<input type="text" name="student" value="<?php echo $row['student']; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input type="hidden" name="id" value="<?php echo $row['id']; ?>" class="form-control">
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<!-- /box_general-->
		<p><button type="submit" class="btn_1 medium" name="update">Update</button></p>
		</form>
	  </div>
	  <!-- /.container-fluid-->
</div>
<!-- Include footer file -->
<?php include('./partials/footer.php'); ?>