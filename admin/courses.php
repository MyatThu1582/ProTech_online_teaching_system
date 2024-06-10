<?php

session_start();
require '../config/config.php';
require '../config/common.php';

if($_SESSION['role'] != "admin") {
  header('location: login.php');
}
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
    header('location: login.php');
  }

 ?>

<?php include 'header.php' ?>
    <!-- Main content -->
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 10px">Id</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Content</th>
                  <th>Duration</th>
                  <th>Type</th>
                  <th>Fee</th>
                  <th>Image</th>
                  <th style="width:100px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $coursestmt = $pdo->prepare("SELECT * FROM course ORDER BY id DESC");
                $coursestmt->execute();
                $coursedatas = $coursestmt->fetchAll();
                $i = 1;
                foreach ($coursedatas as $coursedata) {
                  ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo escape($coursedata['name']);?></td>
                    <td><?php echo escape($coursedata['description']); ?></td>
                    <td><?php echo escape(substr($coursedata['content'], 0,50)); ?></td>
                    <td><?php echo escape($coursedata['duration']); ?></td>
                    <td><?php echo escape($coursedata['type']); ?></td>
                    <td><?php echo escape($coursedata['fee']) . " MMK"; ?></td>
                    <td style="width:10%;">
                      <img src="images/<?php echo escape($coursedata['image']); ?>" alt="" style="width:100%;">
                    </td>
                    <td>
                      <a href="editCourse.php?id=<?php echo $coursedata['id']; ?>" type="button" class="btn btn-warning text-light btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                      </a>
                      <a href="delete.php?table_name=courses&id=<?php echo $coursedata['id']; ?>" type="button" class="btn btn-danger btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                      </a>
                    </td>
                  </tr>
                  <?php
                  $i++;
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
