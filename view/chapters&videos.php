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
      <div class="row">
        <?php
        $id = $_GET['course_id'];
        $coursestmt = $pdo->prepare("SELECT * FROM course WHERE id='$id'");
        $coursestmt->execute();
        $course = $coursestmt->fetch(PDO::FETCH_ASSOC);
        // print_r($course);
        ?>
        <div class="col-8" style="">
            <img src="../admin/images/<?php echo $course['image']; ?>" alt="" style="width:90%; height:60%; object-fit:cover;">
            <div class="mt-5 me-5">
              <h4>About Course</h4>
              <p><?php echo $course['content']; ?></p>
              <button type="button" name="button" class="btn btn-primary float-end me-3" style="margin-top:-30px;">
                Start Learning
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
              </button>
            </div>
        </div>
        <div class="col-4 p-0" style="margin:0px;">
          <div class="card ps-4 pt-3 pb-4">
            <h4 class="mt-2 mb-4"><b>Course Features</b></h4>
            <div class="d-flex mb-2 text-secondary">
              <div class="col-9 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-watch" viewBox="0 0 16 16">
                  <path d="M8.5 5a.5.5 0 0 0-1 0v2.5H6a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5z"/>
                  <path d="M5.667 16C4.747 16 4 15.254 4 14.333v-1.86A6 6 0 0 1 2 8c0-1.777.772-3.374 2-4.472V1.667C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v1.86a6 6 0 0 1 1.918 3.48.502.502 0 0 1 .582.493v1a.5.5 0 0 1-.582.493A6 6 0 0 1 12 12.473v1.86c0 .92-.746 1.667-1.667 1.667zM13 8A5 5 0 1 0 3 8a5 5 0 0 0 10 0"/>
                </svg>
                Duration
              </div>
              <div class="col">
                <?php echo $course['duration']; ?>
              </div>
            </div>
            <div class="d-flex mb-2 text-secondary">
              <div class="col-9 me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-btn" viewBox="0 0 16 16">
                  <path d="M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z"/>
                  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                </svg>
                Type
              </div>
              <div class="col">
                <?php echo $course['type']; ?>
              </div>
            </div>
            <div class="d-flex mb-2 text-secondary">
              <div class="col-8 me-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                  <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                  <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z"/>
                </svg>
                Course Fee
              </div>
              <div class="col">
                <?php echo $course['fee'] ." MMK"; ?>
              </div>
            </div>
            <div class="d-flex mb-2 text-secondary">
              <div class="col-10 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                  <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                  <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                </svg>
                Open Discussion Forum
              </div>
              <div class="col">
                Yes
              </div>
            </div>
          </div>

          <div class="text-center text-light p-2 bg-success mt-5" style="height:80px;">
          <h4><?php echo $course['name']; ?></h4>
          <?php
            $countchapterstmt = $pdo->prepare("SELECT COUNT(*) AS total_chapters FROM chapters WHERE course_id='$id'");
            $countchapterstmt->execute();
            $countchapter = $countchapterstmt->fetch(PDO::FETCH_ASSOC); ?>
            <span class="float-start ms-3"><?php if($countchapter['total_chapters'] > 1){ echo $countchapter['total_chapters'] . " Chapters"; }else{ echo $countchapter['total_chapters'] . " Chapter"; } ?></span>
            <span class="float-end me-3">15 Videos</span>
          </div>
          <div class="m-4 pb-3">
          <?php
            $id = $_GET['course_id'];
            $chaptersstmt = $pdo->prepare("SELECT * FROM chapters WHERE course_id='$id'");
            $chaptersstmt->execute();
            $chaptersdatas = $chaptersstmt->fetchall();
            $i = 1;
            foreach ($chaptersdatas as $chaptersdata) {
            ?>
            <div class="chapterdiv pt-2 ps-2" style="border-bottom:1px solid grey;">
              <span style="font-size:12px;">Chapter <?php echo $i; ?></span>
              <h5 data-bs-toggle="collapse" data-bs-target="#demo"><?php echo $chaptersdata['title']; ?></h5>
            </div>
            <?php
            $i++;
          }
           ?>
         </div>
        </div>
      </div>
    </div>
</body>
</html>
