<?php 
require '../config/config.php';
// Set course ID
$student_id = (int) $_GET['u'];
// Get courses
$query="SELECT * FROM `students` WHERE `id` = '$student_id'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>
<!-- Include controller -->
<?php include('./studentController.php') ?>
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
			<form action="update_std.php" class="dropzone" method="post">
			<?php include('../errors.php'); ?>
			<?php while($row = $result->fetch_assoc()){ ?>
			<div class="row">
               <div class="col-md-6">
					<div class="form-group">
						<label>Surname</label>
						<input type="text" name="surname" value="<?php echo $row['surname']; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Other name</label>
						<input type="text" class="form-control" name="othername" value="<?php echo $row['othername']; ?>">
					</div>
				</div>
			</div>
			<!-- /row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Department</label>
						<input type="text" class="form-control" name="department" value="<?php echo $row['department']; ?>">
					</div>
                </div>
                <div class="col-md-6">
					<div class="form-group">
						<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
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