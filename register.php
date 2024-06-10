<?php
include 'Controllers/query.ctr.php';
$query = new Query();

if(!empty($_SESSION['auth'])){
  $query->redirect('Index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <?php// include 'link.php'; ?>
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <script src="boostrap/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <style media="screen">
    body{
      font-family: "Titillium Web", sans-serif;
      font-weight: 600;
      font-style: normal;
    }

    .register-div{
      background-image: url("images/register (2).jpg");
      background-size: cover;
      background-repeat: no-repeat;
    }
    .navbar{
      background: rgb(255,255,255);
      /* background: linear-gradient(82deg, rgba(0,0,0,0.1) 0%, rgba(255,255,255,1) 100%); */
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 255, 0.2);
    }
</style>
</head>
<?php

$nameerror = "";
$emailerror = "";
$passworderror = "";
$comfirmpassworderror = "";
  if ($_POST) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
      if (empty($name)) {
        $nameerror = "The name is required";
      }
      if (empty($email)) {
        $emailerror = "The email is required";
      }
      if (empty($password)) {
        $passworderror = "The password is required";
      }
      if (empty($confirm_password)) {
        $comfirmpassworderror = "The comfirmpassword is required";
      }
    }else{
      if(strlen($password) <= 6){
        $passworderror = "The Password have to be atleast 6";
      }else{
        if($password != $confirm_password){
          $comfirmpassworderror = "The confirm password does not match";
        }else{
          $stmt = $pdo->prepare("SELECT * FROM users WHERE email = '$email'");
          $stmt->execute();
          $user_datas = $stmt->fetch(PDO::FETCH_ASSOC);

          if ($user_datas) {
            $emailerror = "The email is already exist";
          }else{
              $query->register($name, $email, $password);
          }
        }
      }
    }
  }
 ?>
<body>
  <div class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="">
      <div class="container">
        <div style="width:200px; height:50px; overflow:hidden;">
            <!-- <a href="Index.php" style="text-decoration: none;" class="text-dark h2"><b>ProTech</b></a> -->
            <a href="index.php">
              <img src="images/logo.jpg" alt="" style="width:100%; height:250%; margin-top:-35px;">
            </a>
        </div>
        <div>
            <div class="collapse navbar-collapse p-2" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view/about_us.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view/course.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view/contact.php">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"></a>
                </li>
                <?php
                  if(!empty($_SESSION['auth']['auth'])){
                    ?>
                    <li class="nav-item">
                      <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">|</span>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="logout.php" style="background-color:rgb(5, 82, 237); color:white; border-radius:3px;">LogOut</a>
                    </li>
                    <?php
                  }else{
                    ?>
                    <li class="nav-item">
                      <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">|</span>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="register.php" style="background-color:rgb(5, 82, 237); color:white; border-radius:3px;">Register</a>
                    </li>
                    <?php
                  }
                ?>
            </ul>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            </div>
        </div>
      </div>
    </nav>
  </div>
  <br>
  <br>
  <br>
    <div class="container register-div mt-5 text-light">
      <div class="row mt-5 pb-5 pt-3">
        <div class="col-7 text-center">
          <!-- <img src="images/sign_up.png" alt=""> -->
        </div>
        <div class="col-4 ps-5 pe-5 ms-5 pt-3">
          <h2 class="text-center mb-4">Sign Up</h2>
          <form action="" method="post">
              <div class="form-group mb-2" style="height:70px;">
                  <label for="username">Username</label>
                  <input type="text" class="form-control login-inputs" id="username" name="username">
                  <span class="text-danger"><?php echo $nameerror; ?></span>
              </div>
              <div class="form-group mb-2" style="height:70px;">
                  <label for="email">Email</label>
                  <input type="email" class="form-control login-inputs" id="email" name="email">
                  <span class="text-danger"><?php echo $emailerror; ?></span>
              </div>
              <div class="form-group mb-2" style="height:70px;">
                  <label for="password">Password</label>
                  <input type="password" class="form-control login-inputs" id="password" name="password">
                  <span class="text-danger"><?php echo $passworderror; ?></span>
              </div>
              <div class="form-group mb-4" style="height:70px;">
                  <label for="confirm-password">Confirm Password</label>
                  <input type="password" class="form-control login-inputs" id="confirm-password" name="confirm_password">
                  <span class="text-danger"><?php echo $comfirmpassworderror; ?></span>
              </div>
              <button type="submit" class="btn btn-primary form-control">Register</button>
          </form>
        </div>
      </div>
    </div>
</body>
</html>
