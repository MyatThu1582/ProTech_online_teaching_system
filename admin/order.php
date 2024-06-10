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
if (!empty($_POST['search'])) {
  setcookie('search',$_POST['search'], time() + (86400 * 30), "/");
}else{
  if (empty($_GET['pageno'])) {
    unset($_COOKIE['search']);
    setcookie('search', null, -1 , '/');
  }
}

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
                <h1 class="card-title">Order Listing</h1>
              </div>
              <div class="col-2">
                <a href="addCat.php" class="btn btn-success">New Category</a>
              </div>
            </div>
          </div>
          <?php

          if (!empty($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
          }else{
            $pageno = 1;
          }

          $numofrecs = 3;
          $offset = ($pageno - 1) * $numofrecs;

          $stmt = $pdo->prepare("SELECT * FROM sale_orders");
          $stmt->execute();
          $rawdatas = $stmt->fetchAll();
          $totalpages = ceil(count($rawdatas) / $numofrecs);

          $stmt = $pdo->prepare("SELECT * FROM sale_orders ORDER BY id DESC LIMIT $offset,$numofrecs");
          $stmt->execute();
          $datas = $stmt->fetchAll();

         ?>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>User</th>
                  <th>Total Price</th>
                  <th>Order Date</th>
                  <th style="width: 40px">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($datas as $data) {

                  $stmt = $pdo->prepare("SELECT * FROM users WHERE id=".$data['user_id']);
                  $stmt->execute();
                  $userresult = $stmt->fetchAll();

                  ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo escape($userresult[0]['name']); ?></td>
                    <td><?php echo escape($data['total_prices']); ?></td>
                    <td><?php echo escape(date('Y-m-d',strtotime($data['order_date']))); ?></td>
                    <td>
                      <div class="btn-group">
                        <div class="container">
                          <a href="orderdetail.php?id=<?php echo $data['id']?>" class="btn btn-default">View</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php
                  $i++;
                }
                 ?>
              </tbody>
            </table>
          </div>
            <nav class="" style="margin-left:777px;">
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
            </nav>
          </div>
        </div>
        </div>
      </div>


    <?php include 'footer.html'; ?>
