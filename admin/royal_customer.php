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
                <h1 class="card-title">Weekly Report</h1>
              </div>
            </div>
          </div>
          <div class="card-body">
            <?php
            // $currentDate = date("Y-m-d");
            // $fromDate = date("Y-m-d", strtotime($currentDate . '+1 day'));
            // $toDate = date("Y-m-d", strtotime($currentDate . '-7 day'));
            $stmt = $pdo->prepare("SELECT * FROM sale_orders WHERE total_prices >= :money ORDER BY id DESC");
            $stmt->execute([':money'=>100000]);
            $result = $stmt->fetchAll();
            // print "<pre>";
            // print_r($result);
            // exit();
            ?>

            <table class="table table-bordered" id="d-table">
              <thead>
                <tr>
                  <th style="width: 10px">Id</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Total Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                  foreach ($result as $value) {
                    $user_id = $value['user_id'];

                    $userstmt = $pdo->prepare("SELECT * FROM users WHERE id=:user_id ORDER BY id DESC");
                    $userstmt->execute([':user_id'=>$user_id]);
                    $userresult = $userstmt->fetch(PDO::FETCH_ASSOC);
                 ?>
                 <tr>
                   <td><?php echo $no; ?></td>
                   <td><?php echo $userresult['name']; ?></td>
                   <td><?php echo $userresult['email']; ?></td>
                   <td><?php echo $userresult['phone']; ?></td>
                   <td><?php echo $userresult['address']; ?></td>
                   <td><?php echo $value['total_prices']; ?></td>
                 </tr>
                 <?php
                 $no++;
               }
               ?>
              </tbody>
            </table>
          </div>
      </div>
          </div>
        </div>
        </div>

    <?php include 'footer.html'; ?>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#d-table').DataTable();
    })
      // let table = new DataTable('#d-table');
    </script>
