<?php
include 'Controllers/query.ctr.php';
$query = new Query();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    .headerimg{
      background-image: url('images/homeimg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      height:80%;
      background-position: 100% 80%;
    }

    .navbar{
      background: rgb(255,255,255);
      /* background: linear-gradient(82deg, rgba(0,0,0,0.1) 0%, rgba(255,255,255,1) 100%); */
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 255, 0.2);
    }
    </style>
</head>
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
                <!-- <li class="nav-item">
                    <a class="nav-link" href="view/about_us.php">About Us</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="view/course.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view/contact.php">Donate</a>
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
    <div class="headerimg">
          <h1 class="text-light" style="font-size:50px; padding-top:30%; padding-left:4%; font-weight:bold;">Welcome From Our Universe</h1>
    </div>
</body>
</html>
