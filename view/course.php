<?php
include '../Controllers/query.ctr.php';
$query = new Query();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../css/link.php'; ?>
</head>
<body>
  <div class="fixed-top">
    <?php
    include '../css/navbar.php';
    ?>
  </div>
    <div class="container" style="margin-top:120px;">
      <div class="row m-5 p-3">
        <div class="col-6 mt-3 mb-5">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad sicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim a minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          <a href="#" class="btn btn-info text-light mt-3">Messenger</a>
        </div>
        <div class="col-6 mt-3 mb-5">
          <img src="../images/courseimg.png" alt="" style="width:100%; height:100%;">
        </div>
      </div>
      <div class="row m-5" style="height:650px;">
        <?php
        $coursestmt = $pdo->prepare("SELECT * FROM course ORDER BY id DESC");
        $coursestmt->execute();
        $coursedatas = $coursestmt->fetchall();
        foreach ($coursedatas as $coursedata) {
          ?>
          <div class="col-6 p-4">
            <div class="course">
              <div class="" style="width:100%; height:300px;">
                <img src="../admin/images/<?php echo $coursedata['image']; ?>" alt="" style="width:100%; height:100%; object-fit:cover;">
              </div>
              <div class="course_content">
                <h4 class="mt-1 mb-2"><?php echo $coursedata['name']; ?></h4>
                <span class="mb-5" style="color:grey;"># <?php echo $coursedata['description']; ?></span>
                <p><?php echo substr($coursedata['content'], 0, 250); ?></p>
              </div>
              <hr>
              <div class="row mb-3">
                <div class="col-7 ms-3 mt-2">
                  0 - Kyats
                </div>
                <div class="col">
                  <a href="chapters&videos.php?course_id=<?php echo $coursedata['id']; ?>" name="button" class="btn btn-success ms-4">Whatch Now</a>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
         ?>
      </div>
    </div>
</body>
</html>
