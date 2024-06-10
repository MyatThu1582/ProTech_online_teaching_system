<?php
require '../Controllers/query.ctr.php';
$query = new Query();
require '../config/common.php';

if($_SESSION['role'] != "admin") {
  header('location: login.php');
}
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
    header('location: login.php');
  }

$titleError = "";
$course_idError = "";

if ($_POST) {
  $title = $_POST['title'];
  $course_id = $_POST['course_id'];

  if(empty($_POST['title']) || empty($_POST['course_id'])){

    if (empty($_POST['title'])) {
      $titleError = "The title is required !";
    }
    if (empty($_POST['course_id'])) {
      $course_idError = "The course_id is required !";
    }
  }else{
      $status = $query->addChapter($title, $course_id);
      }
    }
 ?>

 <?php include 'header.php'; ?>


    <!-- Main content -->
    <div class="container">
    <div class="row">
      <div class="col-3">

      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <form class="" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
              <div class="form-group">
                <label>Chapter Title</label>
                <input type="text" name="title" value="<?php if ($_POST) {
                   echo $title = $_POST['title'];
                }?>" class="form-control <?php if (!empty($titleError)) {?> is-invalid <?php } ?>">
                <span class="text-danger"><?php echo $titleError; ?></span>
              </div>
              <div class="form-group">
                <label>Course_id</label>
                <select class="form-control <?php if (!empty($course_idError)) {?> is-invalid <?php } ?>" name="course_id">
                  <?php
                  $coursestmt = $pdo->prepare("SELECT * FROM course ORDER BY id DESC");
                  $coursestmt->execute();
                  $coursedatas = $coursestmt->fetchAll();
                  foreach ($coursedatas as $coursedata) {
                    ?>
                    <option value="<?php echo $coursedata['id']; ?>"><?php echo $coursedata['name']; ?></option>
                    <?php
                  }
                   ?>
                </select>
                <span class="text-danger"><?php echo $course_idError; ?></span>
              </div>
              <div class="form-group">
                <input type="submit" name="" value="Add New Chapter" class="btn btn-primary form-control">
              </div>
            </form>
          </div>
        </div>
        </div>
    </div>
  </div>

    <?php include 'footer.html'; ?>
