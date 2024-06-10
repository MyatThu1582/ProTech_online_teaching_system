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
              <div class="col-11 mt-2">
                <h1 class="card-title">Order Detail</h1>
              </div>
              <div class="col-1">
                <a href="order.php" class="btn btn-danger">Back</a>
              </div>
            </div>
          </div>
          <?php

          if (!empty($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
          }else{
            $pageno = 1;
          }

          $numofrecs = 1;
          $offset = ($pageno - 1) * $numofrecs;
          $id = $_GET['id'];
          $stmt = $pdo->prepare("SELECT * FROM sale_order_details WHERE sale_order_id='$id'");
          $stmt->execute();
          $rawdatas = $stmt->fetchAll();
          $totalpages = ceil(count($rawdatas) / $numofrecs);
          $stmt = $pdo->prepare("SELECT * FROM sale_order_details WHERE sale_order_id='$id' LIMIT $offset,$numofrecs");
          $stmt->execute();
          $datas = $stmt->fetchAll();
          // print "<pre>";
          // print_r($datas);
          // exit();
         ?>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Order Date</th>
                  <th>Image</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($datas as $data) {
                  ?>
                  <?php
                  $stmt = $pdo->prepare("SELECT * FROM products WHERE id=".$data['product_id']);
                  $stmt->execute();
                  $proresult = $stmt->fetchAll();
                  // print "<pre>";
                  // print_r($proresult[0]['image']);
                  // exit();
                   ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo escape($proresult[0]['name']); ?></td>
                    <td><?php echo escape($data['quantity']); ?></td>
                    <td><?php echo escape(date('Y-m-d',strtotime($data['order_date']))); ?></td>
                    <td>
                      <img src="images/<?php echo $proresult[0]['image']; ?>" alt="" width="100">
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
                <li class="page-item"><a class="page-link" href="?id=<?= $_GET['id']; ?>&pageno=1">First</a></li>

                <li class="page-item <?php if ($pageno <= 1) { echo 'disabled'; } ?>">
                  <a class="page-link" href="<?php if ($pageno <= 1) { echo '#'; }else{ echo "?id=" . $_GET['id'] . "&pageno=" . $pageno - 1 ;} ?>">Previous</a>
                </li>

                <li class="page-item">
                  <a class="page-link" href="#"><?php echo $pageno; ?></a>
                </li>

                <li class="page-item <?php if ($pageno >= $totalpages) { echo 'disabled'; } ?>">
                  <a class="page-link" href="?id=<?= $_GET['id']; ?>&pageno=<?php if ($pageno >= $totalpages) { echo '#'; }else{ echo $pageno + 1; } ?>">Next</a>
                </li>

                <li class="page-item"><a class="page-link" href="?id=<?= $_GET['id']; ?>&pageno=<?php  echo $totalpages; ?>">Last</a></li>
              </ul>
            </nav>
          </div>
        </div>
        </div>
      </div>


    <?php include 'footer.html'; ?>
