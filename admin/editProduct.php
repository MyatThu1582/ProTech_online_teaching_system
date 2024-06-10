<?php

session_start();
require '../config/config.php';
require '../config/common.php';

if($_SESSION['role'] != 1) {
  header('location: login.php');
}
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
    header('location: login.php');
  }

$nameError = "";
$descError = "";
$catError = "";
$quanError = "";
$priceError = "";
$imageError = "";


if ($_POST) {

  if(is_numeric($_POST['quan']) != 1) {
      $quanError = "Quantity should be integer value";
  }
  if(is_numeric($_POST['price']) != 1) {
      $priceError = "Price should be integer value";
  }
  if(empty($_POST['name']) || empty($_POST['desc']) || empty($_POST['category']) || empty($_POST['quan']) || empty($_POST['price'])){

    if (empty($_POST['name'])) {
      $nameError = "The name is invalid !!";
    }
    if (empty($_POST['desc'])) {
      $descError = "The description is invalid !!";
    }
    if (empty($_POST['category'])) {
      $catError = "The category is invalid !!";
    }
    if (empty($_POST['quan'])) {
      $quanError = "The quan is invalid !!";
     }
    if (empty($_POST['price'])) {
      $priceError = "The price is invalid !!";
    }
    if (empty($_FILES['image']['name'])) {
      $imageError = "The image is invalid !!";
    }
  }else{
    if ($_FILES['image']['name'] != null) {
      $file = 'images/'.($_FILES['image']['name']);
      $imageType = pathinfo($file,PATHINFO_EXTENSION);
      if ($imageType == 'jpg' || $imageType == 'jpeg' || $imageType == 'png') {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $category = $_POST['category'];
        $quan = $_POST['quan'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $file);
        $stmt = $pdo->prepare("UPDATE products SET name=:name, description=:desc, category_id=:id, quantity=:quan, price=:price, image=:image WHERE id=".$_GET['id']);
        $result = $stmt->execute(
          array(':name' => $name, ':desc' => $desc, ':id' => $category, ':quan' => $quan, ':price' => $price, ':image' => $image)
        );
        if ($result) {
          echo "<script>alert('Product Updated Successfully');window.location.href = 'index.php';</script>";
        }
      }else{
        echo "<script>alert('Image must be PNG, JPG, JPEEG')</script>";
      }
    }else{
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $category = $_POST['category'];
        $quan = $_POST['quan'];
        $price = $_POST['price'];
        $stmt = $pdo->prepare("UPDATE products SET name=:name, description=:desc, category_id=:id, quantity=:quan, price=:price WHERE id=".$_GET['id']);
        $result = $stmt->execute(
          array(':name' => $name, ':desc' => $desc, ':id' => $category, ':quan' => $quan, ':price' => $price)
        );
        if ($result) {
          echo "<script>alert('Product Updated Successfully');window.location.href = 'index.php';</script>";
        }
    }
    }
}


 ?>

<?php include 'header.php'; ?>


    <!-- Main content -->
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id=".$_GET['id']);
            $stmt->execute();
            $proresult = $stmt->fetchAll();
            // print"<pre>";
            // print_r($result[0]);
            // // exit();
             ?>
            <form class="" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $proresult[0]['name'];?>" class="form-control <?php if (!empty($nameError)) {?> is-invalid <?php } ?>">
                <span class="text-danger"><?php echo $nameError; ?></span>
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea name="desc" rows="8" cols="80" class="form-control<?php if (!empty($descError)) {?> is-invalid <?php } ?>"><?php echo $proresult[0]['description'];?></textarea>
                <span class="text-danger"><?php echo $descError; ?></span>
              </div>

              <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-control<?php if (!empty($catError)) {?> is-invalid <?php } ?>">
                  <option>SELECT CATEGORY</option>
                  <?php
                  $stmt = $pdo->prepare("SELECT * FROM categories");
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                  foreach ($result as $value) {?>
                    <?php if ($value['id'] == $proresult[0]['category_id']): ?>
                      <option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']; ?></option>
                    <?php else : ?>
                      <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                    <?php endif; ?>
                    <?php
                  }
                  ?>
                </select>
                <span class="text-danger"><?php echo $catError; ?></span>
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="text" name="quan" value="<?php echo $proresult[0]['quantity'];?>" class="form-control <?php if (!empty($nameError)) {?> is-invalid <?php } ?>">
                <span class="text-danger"><?php echo $quanError; ?></span>
              </div>
              <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" value="<?php echo $proresult[0]['price']; ?>" class="form-control <?php if (!empty($priceError)) {?> is-invalid <?php } ?>">
                <span class="text-danger"><?php echo $priceError; ?></span>
              </div>
              <div class="form-group mt-4">
                <label>Image</label>
                <input type="file" name="image" class="form-control <?php if (!empty($imageError)) {?> is-invalid <?php } ?>">
                <span class="text-danger"><?php echo $imageError; ?></span>
                <img src="images/<?php echo $proresult[0]['image']; ?>" alt="">
              </div>
              <div class="form-group">
                <input type="submit" name="" value="Submit" class="btn btn-primary">
                <a href="index.php" class="btn btn-danger ml-1">Back</a>
              </div>
            </form>
          </div>
        </div>
        </div>
    </div>
  </div>

    <?php include 'footer.html'; ?>
