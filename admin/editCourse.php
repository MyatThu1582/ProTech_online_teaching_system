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

  $nameError = "";
  $descError = "";
  $contentError = "";
  $durationError = "";
  $typeError = "";
  $feeError = "";
  $imageError = "";

$id = $_GET['id'];
if ($_POST) {
  $name = $_POST['name'];
  $desc = $_POST['desc'];
  $content = $_POST['content'];
  $duration = $_POST['duration'];
  $type = $_POST['type'];
  $fee = $_POST['fee'];

  if(empty($_POST['name']) || empty($_POST['desc'])|| empty($_POST['content']) || empty($_POST['duration']) || empty($_POST['type']) || empty($_POST['fee'])){

    if (empty($_POST['name'])) {
      $nameError = "The name is required !";
    }
    if (empty($_POST['desc'])) {
      $descError = "The description is required !";
    }
    if (empty($_POST['content'])) {
      $contentError = "The content is required !";
    }
    if (empty($_POST['duration'])) {
      $durationError = "The duration is required !";
    }
    if (empty($_POST['type'])) {
      $typeError = "The type is required !";
    }
    if (empty($_POST['fee'])) {
      $feeError = "The fee is required !";
    }
  }else{
    if ($_FILES['image']['name'] != null) {
      $file = 'images/'.($_FILES['image']['name']);
      $imageType = pathinfo($file,PATHINFO_EXTENSION);
      if ($imageType == 'jpg' || $imageType == 'jpeg' || $imageType == 'png') {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $file);
        $status = $query->editCoursewithimage($name, $desc, $content, $duration, $type, $fee, $image, $id);
      }else{
        echo "<script>alert('Image must be PNG, JPG, JPEEG')</script>";
      }
    }else{
      $status = $query->editCoursewithoutimage($name, $desc, $content, $duration, $type, $fee, $id);
    }
  }
}

$stmt = $pdo->prepare("SELECT * FROM course WHERE id='$id'");
$stmt->execute();
$datas = $stmt->fetch(PDO::FETCH_ASSOC);
// print"<pre>";
// print_r($datas);
// exit();
 ?>

 <?php include 'header.php'; ?>


    <!-- Main content -->
    <div class="container">
      <div class="row" style="height:1200px;">
        <div class="col-3">

        </div>
        <div class="col-6">
          <div class="card">
            <div class="card-body">
              <form class="" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" value="<?php if ($_POST) {
                     echo $name = $_POST['name'];
                  }else{ echo $datas['name']; }?>" class="form-control <?php if (!empty($nameError)) {?> is-invalid <?php } ?>">
                  <span class="text-danger"><?php echo $nameError; ?></span>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <input type="text" name="desc" value="<?php if ($_POST) {
                     echo $desc = $_POST['desc'];
                  }else{ echo $datas['description']; }?>" class="form-control <?php if (!empty($descError)) {?> is-invalid <?php } ?>">
                  <span class="text-danger"><?php echo $descError; ?></span>
                </div>
                <div class="form-group">
                  <label>Content</label>
                  <textarea name="content" rows="6" cols="80" class="form-control<?php if (!empty($contentError)) {?> is-invalid <?php } ?>"><?php if ($_POST) {
                     echo $content = $_POST['content'];
                  }else{ echo $datas['content']; }?></textarea>
                  <span class="text-danger"><?php echo $contentError; ?></span>
                </div>
                <div class="form-group">
                  <label>Duration</label>
                  <input type="text" name="duration" value="<?php if ($_POST) {
                     echo $duration = $_POST['duration'];
                  }else{ echo $datas['duration']; }?>" class="form-control <?php if (!empty($durationError)) {?> is-invalid <?php } ?>">
                  <span class="text-danger"><?php echo $durationError; ?></span>
                </div>
                <div class="form-group">
                  <label>Type</label>
                  <input type="text" name="type" value="<?php if ($_POST) {
                     echo $type = $_POST['type'];
                  }else{ echo $datas['type']; }?>" class="form-control <?php if (!empty($typeError)) {?> is-invalid <?php } ?>">
                  <span class="text-danger"><?php echo $typeError; ?></span>
                </div>
                <div class="form-group">
                  <label>Fee</label>
                  <input type="text" name="fee" value="<?php if ($_POST) {
                     echo $fee = $_POST['fee'];
                  }else{ echo $datas['fee']; }?>" class="form-control <?php if (!empty($feeError)) {?> is-invalid <?php } ?>">
                  <span class="text-danger"><?php echo $feeError; ?></span>
                </div>
                <div class="form-group">
                  <label>Image</label>
                  <input type="file" name="image" value="" class="form-control <?php if (!empty($imageError)) {?> is-invalid <?php } ?>">
                  <span class="text-danger"><?php echo $imageError; ?></span>
                  <img src="images/<?php echo escape($datas['image']); ?>" alt="" style="width:100%;" class="mt-3">
                </div>
                <div class="form-group">
                  <input type="submit" name="" value="Update Course" class="btn btn-primary form-control">
                </div>
              </form>
            </div>
          </div>
          </div>
      </div>
  </div>

    <?php include 'footer.html'; ?>
