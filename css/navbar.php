<nav class="navbar navbar-expand-lg bg-body-tertiary" style="">
  <div class="container">
    <div style="width:200px; height:50px; overflow:hidden;">
        <!-- <a href="Index.php" style="text-decoration: none;" class="text-dark h2"><b>ProTech</b></a> -->
        <?php
        $link = $_SERVER['PHP_SELF'];
        $link_array = explode('/',$link);
        $page = end($link_array);
        ?>
        <a href="index.php">
          <img src="../images/logo.jpg" alt="" style="width:100%; height:250%; margin-top:-35px;">
        </a>
    </div>
    <div>
        <div class="collapse navbar-collapse p-2" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php if($page != "Index.php"){ echo "../Index.php"; } ?>">Home</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?php if($page != "Index.php"){ echo "about_us.php"; } ?>">About Us</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="<?php if($page != "Index.php"){ echo "course.php"; } ?>">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php if($page != "Index.php"){ echo "contact.php"; } ?>">Donate</a>
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
                  <a class="nav-link" href="<?php if($page != "Index.php"){ echo "../login.php"; } ?>">Login</a>
                </li>
                <li class="nav-item">
                    <span class="nav-link">|</span>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php if($page != "Index.php"){ echo "../register.php"; } ?>" style="background-color:rgb(5, 82, 237); color:white; border-radius:3px;">Register</a>
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
