<?php
require '../config/config.php';
$query="SELECT * FROM `courses` order by 'title' DESC";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>
<!-- Include controller -->
<?php include('./testController.php') ?>
<!-- Include header file -->
<?php include('./partials/header.php'); ?>
  <!-- Navigation-->
<?php include('./partials/nav.php'); ?>
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Admin</a>
        </li>
        <li class="breadcrumb-item active">Test Management</li>
      </ol>
	  <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-envelope-open"></i>
              </div>
              <div class="mr-5"><h5>Add Test</h5></div>
            </div><hr>
            <div class="card-body">
            <form action="add_test.php" method="post">
            <?php include('../errors.php'); ?>
              <div class="form-group">
                <select name="course" class="form-control" required>
                  <option value="">Select course title</option>
                <?php while($row = $result->fetch_assoc()){ ?>
                  <option value="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></option>
                <?php } ?>
                </select>
              </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="addTest">Add Test</button>
          </div>
          </form>
        </div>
      </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-star"></i>
              </div>
				<div class="mr-5"><h5>Delete Test</h5></div>
            </div><hr>
            <div class="card-body">
            <form action="question.php" method="post">
            <?php include('../errors.php'); ?>
              <div class="form-group">
                <select name="course" class="form-control" required>
                  <option value="">Select course title</option>
                  <?php while($row = $result->fetch_assoc()){ ?>
                    <option value="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></option>
                  <?php } ?>
                </select>
              </div>
          </div>
          <div class="card-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="deleteTest">Delete Test</button>
          </div>
          </form>
        </div>
      </div>
          </div>
        </div>
		</div>
		<!-- /cards -->
		<h2></h2>
	  </div>
	  <!-- /.container-fluid-->
   	</div>
    <!-- /.container-wrapper-->

<!-- Add Test Modal -->
    <div class="modal fade" id="addTest" tabindex="-1" role="dialog" aria-labelledby="addTest" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTest">Add New Test</h5>
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
                  <option value="<?php echo $courseTitles ?>"><?php echo $courseTitles ?></option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" name="optionA" class="form-control" placeholder="Option A" required>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="addTest">Add</button>
          </div>
          </form>
        </div>
      </div>

      <!-- Delete Test Modal -->
    <div class="modal fade" id="deletTest" tabindex="-1" role="dialog" aria-labelledby="deletTest" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deletTest">Add New Test</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
    <!-- Include footer file -->
<?php include('./partials/footer.php'); ?>