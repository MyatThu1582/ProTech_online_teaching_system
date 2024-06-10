<?php
// session_start();
// require '../config/common.php';
include '../Controllers/query.ctr.php';
$query = new Query();
include 'header.php';

if($_SESSION['role'] != "admin") {
  header('location: login.php');
}
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
    header('location: login.php');
  }
$nameError = "";
$emailError = "";
$passwordError = "";
$addressError = "";
$phoneError = "";
if ($_POST) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];
    $passHash = password_hash($password, PASSWORD_DEFAULT);
    if(empty($name) || empty($email) || empty($password) || empty($role_id) || strlen($_POST['password']) < 4){

      if (empty($_POST['name'])) {
        $nameError = "The name is required !";
      }
      if (empty($_POST['email'])) {
        $emailError = "The email is required !";
      }
      if (empty($_POST['role_id'])) {
        $emailError = "The role is required !";
      }
      if (empty($_POST['password'])) {
        $passwordError = "The password is invalid !!";
      }
      if (strlen($_POST['password']) < 4) {
        $passwordError = "The password should be 4 characters at least !!";
      }
    }else{
      $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
      $stmt->bindValue(':email',$email);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      print_r($user);
      if ($user) {
        echo "<script>alert('This email is already taken !!');window.location.href = 'addUser.php'</script>";
      }else {
        $status = $query->addUser($name, $email, $role_id, $passHash);
        if ($status) {
          echo "<script>swal(\"Good job!\", \"You clicked the button!\", \"success\");window.location.href = 'index.php'</script>";
        }

      }
    }
  }
 ?>
    <!-- Main content -->
    <div class="container">
    <div class="row">
      <div class="col-3">

      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-body">
            <form class="" action="addUser.php" method="post" style="">
              <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="" class="form-control <?php if (!empty($nameError)) {?>is-invalid<?php  } ?>">
                <span class="text-danger"><?php echo $nameError; ?></span>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="" name="email" value="" class="form-control <?php if (!empty($emailError)) {?>is-invalid<?php  } ?>">
                <span class="text-danger"><?php echo $emailError; ?></span>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="" value="" class="form-control <?php if (!empty($passwordError)) {?>is-invalid<?php  } ?>">
                <span class="text-danger"><?php echo $passwordError; ?></span><br>
                <label>Comfirm Your Password</label>
                <input type="password" name="password" value="" class="form-control <?php if (!empty($passwordError)) {?>is-invalid<?php  } ?>">
                <span class="text-danger"><?php echo $passwordError; ?></span>
              </div>
              <div class="form-group">
                <label>Role</label>
                <select class="form-control <?php if (!empty($roleError)) {?>is-invalid<?php  } ?>" name="role_id">
                  <option>Select Role</option>
                  <?php
                  $rolestmt = $pdo->prepare("SELECT * FROM roles ORDER BY id DESC");
                  $rolestmt->execute();
                  $roledatas = $rolestmt->fetchAll();
                  foreach ($roledatas as $roledata) {
                    ?>
                    <option value="<?php echo $roledata['id']; ?>"><?php echo $roledata['role_name']; ?></option>
                    <?php
                  }
                   ?>
                </select>
              </div>
              <div class="form-group">
                <input type="submit" name="" value="Add" class="btn btn-primary form-control">
              </div>
            </form>
          </div>
        </div>
        </div>
    </div>
  </div>

    <?php include 'footer.html'; ?>
