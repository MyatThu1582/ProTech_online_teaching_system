<?php

session_start();
require '../config/config.php';
require '../config/common.php';

if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
    header('location: login.php');
  }
// if($_SESSION['role'] === 0) {
//   header('location: login.php');
// }


 ?>

<?php include 'header.php' ?>
    <!-- Main content -->
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-10 mt-2">
                <h1 class="card-title">Product Listing</h1>
              </div>
              <div class="col-2">
                <a href="add.php" class="btn btn-success">New Blog Post</a>
              </div>
            </div>
          </div>

           <?php

          if (!empty($_POST['search'])) {
            setcookie('search',$_POST['search'], time() + (86400 * 30), "/");
          }else{
            if (empty($_GET['pageno'])) {
              unset($_COOKIE['search']);
              setcookie('search', null, -1 , '/');
            }
          }

           if (!empty($_GET['pageno'])) {
             $pageno = $_GET['pageno'];
           }else{
             $pageno = 1;
           }

           $numofrecs = 3;
           $offset = ($pageno - 1) * $numofrecs;

          if (empty($_POST['search'])) {
            $stmt = $pdo->prepare("SELECT * FROM posts");
            $stmt->execute();
            $rawdatas = $stmt->fetchAll();
            $totalpages = ceil(count($rawdatas) / $numofrecs);

            $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numofrecs");
            $stmt->execute();
            $datas = $stmt->fetchAll();
          }else{
            // $search = $_POST['search'];
            if (!empty($_POST['search'])) {
              $search = $_POST['search'];
            }else{
              $search = $_COOKIE['search'];
            }
            $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$search%'");
            $stmt->execute();
            $rawdatas = $stmt->fetchAll();
            $totalpages = ceil(count($rawdatas) / $numofrecs);

            $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY id DESC LIMIT $offset,$numofrecs");
            $stmt->execute();
            $datas = $stmt->fetchAll();
          }
          ?>

            <!-- <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th style="width: 40px">Actios</th>
                </tr>
              </thead> -->
              <tbody>
                <?php
                $i = 1;
                foreach ($datas as $data) {
                  ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo escape($data['title']); ?></td>
                    <td><?php echo escape(substr($data['content'], 0,50)); ?></td>

                    <td>
                      <div class="btn-group">
                        <div class="container">
                          <a href="edit.php?id=<?php echo $data['id']?>" class="btn btn-warning">Edit</a>
                        </div>
                        <div class="container">
                          <a href="delete.php?id=<?php echo $data['id']?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item')">Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php
                  $i++;
                }
                 ?>
              </tbody>
            </table><br>
            <nav class="" style="float:right ;">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>

                <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>">
                  <a class="page-link" href="?pageno=<?php if ($pageno <= 1) { echo '#'; }else{ echo $pageno - 1; } ?>">Previous</a>
                </li>

                <li class="page-item">
                  <a class="page-link" href="#"><?php echo $pageno; ?></a>
                </li>

                <li class="page-item <?php if ($pageno >= $totalpages) { echo 'disabled'; } ?>">
                  <a class="page-link" href="?pageno=<?php if ($pageno >= $totalpages) { echo '#'; }else{ echo $pageno + 1; } ?>">Next</a>
                </li>

                <li class="page-item"><a class="page-link" href="?pageno=<?php  echo $totalpages; ?>">Last</a></li>
              </ul>

          </div>

          </nav>
        </div>
        </div>
      </div>
    </div>

    <?php include 'footer.html'; ?>
