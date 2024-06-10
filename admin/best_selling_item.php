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
                <h1 class="card-title">Best Selling Item</h1>
              </div>
            </div>
          </div>
          <div class="card-body">
            <?php

            $bestselleritemstmt = $pdo->prepare("SELECT * FROM sale_order_details GROUP BY product_id HAVING SUM(quantity) > 5");
            $bestselleritemstmt->execute();
            $bestselleritems = $bestselleritemstmt->fetchAll();
            ?>
            <table class="table table-bordered" id="d-table">
              <thead>
                <tr>
                  <th>Item Id</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Image</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                  foreach ($bestselleritems as $bestselleritem) {
                    $bestseller = $bestselleritem['product_id'];

                    $bestitemstmt = $pdo->prepare("SELECT * FROM products WHERE id=:bestseller ORDER BY id DESC");
                    $bestitemstmt->execute([':bestseller'=>$bestseller]);
                    $bestitemresult = $bestitemstmt->fetch(PDO::FETCH_ASSOC);

                    $category_id = $bestitemresult['category_id'];

                    $categoryidstmt = $pdo->prepare("SELECT * FROM categories WHERE id=:categoryid ORDER BY id DESC");
                    $categoryidstmt->execute([':categoryid'=>$category_id]);
                    $categoryidresult = $categoryidstmt->fetch(PDO::FETCH_ASSOC);


                 ?>
                 <tr>
                   <td><?php echo $no; ?></td>
                   <td><?php echo $bestitemresult['name']; ?></td>
                   <td><?php echo $categoryidresult['name']; ?></td>
                   <td><?php echo $bestitemresult['quantity']; ?></td>
                   <td><?php echo $bestitemresult['price']; ?></td>
                   <td>
                    <img src="images/<?php echo $bestitemresult['image']; ?>" alt="" width="80" height="80">
                  </td>
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
