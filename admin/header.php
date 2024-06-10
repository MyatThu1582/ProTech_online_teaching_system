<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ProTech | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->

  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
  <style media="screen">
    body{
      font-family: "Titillium Web", sans-serif;
      font-weight: 600;
      font-style: normal;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light p-3">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <?php
        $link = $_SERVER['PHP_SELF'];
        $linkary = explode('/',$link);
        $page = end($linkary);
        if ($page == "index.php") {
          ?>
          <h1 class="card-title"><b>Manage Users</b></h1>
          <?php
        }elseif($page == "courses.php"){
          ?>
          <h1 class="card-title"><b>Manage Courses</b></h1>
          <?php
        }elseif($page == "video.php"){
         ?>
         <h1 class="card-title"><b>Manage Videos</b></h1>
        <?php
      }elseif($page == "chapters.php"){
         ?>
         <h1 class="card-title"><b>Manage Chapters</b></h1>
        <?php
        }elseif($page == "addUser.php"){
         ?>
         <h1 class="card-title"><b>Add New User</b></h1>
         <?php
        }elseif($page == "editUser.php"){
           ?>
           <h1 class="card-title"><b>Edit User</b></h1>
           <?php
        }elseif($page == "addCourse.php"){
            ?>
            <h1 class="card-title"><b>Add New Course</b></h1>
            <?php
        }elseif($page == "addChapter.php"){
            ?>
            <h1 class="card-title"><b>Add New Chapters</b></h1>
            <?php
        }elseif($page == "editCourse.php"){
            ?>
            <h1 class="card-title"><b>Edit Course</b></h1>
            <?php
        }elseif($page == "editChapter.php"){
            ?>
            <h1 class="card-title"><b>Edit Chapter</b></h1>
            <?php
        }
            ?>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <?php
        $link = $_SERVER['PHP_SELF'];
        $linkary = explode('/',$link);
        $page = end($linkary);
        if ($page == "index.php") {
          ?>
          <a href="addUser.php" class="btn btn-success btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
            Add New User
          </a>
          <?php
        }elseif($page == "courses.php"){
          ?>
          <a href="addCourse.php" class="btn btn-success btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
            Add New Course
          </a>
          <?php
        }elseif($page == "video.php"){
         ?>
         <a href="addCat.php" class="btn btn-success btn-sm">
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
             <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
           </svg>
           Add New Video
         </a>
         <?php
       }elseif($page == "chapters.php"){
        ?>
        <a href="addChapter.php" class="btn btn-success btn-sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
          </svg>
          Add New Chapters
        </a>
        <?php
       }elseif($page == "addUser.php" || $page == "editUser.php"){
         ?>
         <a href="index.php" class="btn btn-danger ml-1 btn-sm">Back</a>
         <?php
       }elseif($page == "addCourse.php" || $page == "editCourse.php"){
          ?>
          <a href="courses.php" class="btn btn-danger ml-1 btn-sm">Back</a>
          <?php
        }elseif($page == "addChapter.php" || $page == "editChapter.php"){
            ?>
            <a href="chapters.php" class="btn btn-danger ml-1 btn-sm">Back</a>
            <?php
           }
          ?>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="logo" style="width:100%; height:20%; overflow:hidden;">
      <a href="index3.html" class="brand-link">
        <img src="../images/logo.jpg" alt="" style="width:100%; height:100%;">
      </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 text-center">
        <div class="info text-light">
          <?php echo $_SESSION['name']; ?>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item ml-1">
           <a href="index.php" class="nav-link">
             <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
               <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
             </svg>
             <p class="ml-1">
               User
             </p>
           </a>
          </li>
          <li class="nav-item">
            <a href="courses.php" class="nav-link">
              <i class="nav-icon  fas fa-list"></i>
              <p>
                Course
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="chapters.php" class="nav-link">
              <i class="nav-icon  fas fa-list"></i>
              <p>
                Chapters
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Video
              </p>
            </a>
          </li>
        </ul>
        </ul>
      </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="width:81.1%;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
