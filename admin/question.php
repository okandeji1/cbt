<?php
require '../config/config.php';
$qry = "SELECT * FROM `courses` order by `title`";
$qrycheck = $mysqli->query($qry) or die($mysqli->error);
if ($qrycheck->num_rows > 0){
    while($fetch = $qrycheck->fetch_assoc()){
        $courseTitles = $fetch['title'];
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
                <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                </tr>
                <tr>
                  <td>Garrett Winters</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>63</td>
                  <td>2011/07/25</td>
                  <td>$170,750</td>
                </tr>
                <tr>
                  <td>Ashton Cox</td>
                  <td>Junior Technical Author</td>
                  <td>San Francisco</td>
                  <td>66</td>
                  <td>2009/01/12</td>
                  <td>$86,000</td>
                </tr>
                <tr>
                  <td>Cedric Kelly</td>
                  <td>Senior Javascript Developer</td>
                  <td>Edinburgh</td>
                  <td>22</td>
                  <td>2012/03/29</td>
                  <td>$433,060</td>
                </tr>
                <tr>
                  <td>Airi Satou</td>
                  <td>Accountant</td>
                  <td>Tokyo</td>
                  <td>33</td>
                  <td>2008/11/28</td>
                  <td>$162,700</td>
                </tr>
                <tr>
                  <td>Brielle Williamson</td>
                  <td>Integration Specialist</td>
                  <td>New York</td>
                  <td>61</td>
                  <td>2012/12/02</td>
                  <td>$372,000</td>
                </tr>
                <tr>
                  <td>Herrod Chandler</td>
                  <td>Sales Assistant</td>
                  <td>San Francisco</td>
                  <td>59</td>
                  <td>2012/08/06</td>
                  <td>$137,500</td>
                </tr>
                <tr>
                  <td>Rhona Davidson</td>
                  <td>Integration Specialist</td>
                  <td>Tokyo</td>
                  <td>55</td>
                  <td>2010/10/14</td>
                  <td>$327,900</td>
                </tr>
              </tbody>
            </table>
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
                  <option value="<?php echo $courseTitles ?>"><?php echo $courseTitles ?></option>
                </select>
              </div>
              <div class="form-group">
                <input type="number" name="number" placeholder="Enter question number" required>
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
                <input type="text" name="answer" class="form-control" placeholder="Answer option (e.g Option A)" required>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit" name="addQuestion">Add</button>
          </div>
          </form>
        </div>
      </div>
<!-- Include footer file -->
<?php include('./partials/footer.php'); ?>