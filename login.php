<?php
include 'Controllers/query.ctr.php';
$query = new Query();

if(!empty($_SESSION['auth'])){
  $query->redirect('Index.php');
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php //include 'link.php'; ?>
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <script src="boostrap/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <style media="screen">
    body{
      font-family: "Titillium Web", sans-serif;
      font-weight: 600;
      font-style: normal;
    }
    .main-div{
      background-image: url("images/login-background copy2.jpg");
      background-size: cover;
      background-repeat: no-repeat;
    }
    .login-inputs{
      background-color: transparent;
      color: white;
    }
    .navbar{
      background: rgb(255,255,255);
      /* background: linear-gradient(82deg, rgba(0,0,0,0.1) 0%, rgba(255,255,255,1) 100%); */
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 255, 0.2);
    }
    </style>
</head>
<body>
<?php

$emailerror = "";
$passworderror = "";
  if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
      if (empty($email)) {
        $emailerror = "The email is required";
      }
      if (empty($password)) {
        $passworderror = "The password is required";
      }
    }else{
      if(strlen($password) <= 6){
        $passworderror = "The Password have to be atleast 6";
      }else{
        $status = $query->login($email, $password);
      }
    }
  }
 ?>
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
                   <a class="nav-link" href="#">About Us</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="view/course.php">Courses</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="#">Contact</a>
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
     <div class="container main-div mt-5 pb-5 pt-2 text-light" style="margin-top:200px;">
      <div class="row mt-5 ms-5">
        <div class="col-4 me-5 p-5">
          <h2 class="mb-4">Join Our Galaxies</h2>
          <form action="" method="post">
              <div class="form-group mb-2">
                  <label for="email">Email</label>
                  <input type="email" class="form-control login-inputs" autocomplete="off" id="email" name="email" required>
              </div>
              <div class="form-group mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control login-inputs" autocomplete="off" id="password" name="password" required>
                  <span class="text-danger"><?php if(!empty($status)){ echo $status; }; ?></span>
              </div>
              <button type="submit" class="btn btn-primary form-control mt-2">Log In</button>
            </form>
        </div>
        <div class="col-6 text-center ms-5">
          <!-- <img src="images/hello.jpg" alt="" style="width:100%; height:100%;"> -->
        </div>
      </div>
    </div>
</body>
</html>
