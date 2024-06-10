<?php
  session_start();
  require '../config/config.php';
  require '../config/common.php';

  if ($_POST) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
      $stmt->bindValue(':email',$email);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
           if (password_verify($password, $user['password'])) {
                 $_SESSION['user_id'] = $user['id'];
                 $_SESSION['name'] = $user['name'];
                 $_SESSION['logged_in'] = time();

                 $role_idstmt = $pdo->prepare("SELECT * FROM role_user WHERE user_id=:user_id");
                 $role_idstmt->execute(
                   array(':user_id' => $user['id'])
                 );
                 $role_iddata = $role_idstmt->fetch(PDO::FETCH_ASSOC);
                 $role_id = $role_iddata['role_id'];

                 $role_namestmt = $pdo->prepare("SELECT * FROM roles WHERE id=:role_id");
                 $role_namestmt->execute(
                   array(':role_id' => $role_id)
                 );
                 $role_namedata = $role_namestmt->fetch(PDO::FETCH_ASSOC);
                 $role_name = $role_namedata['role_name'];

                 $_SESSION['role'] = $role_name;
                 if ($_SESSION['role'] == "admin") {
                   header('location: index.php');
                 }else{
                   header('location: login.php');
                 }
                 // echo "<script>window.location.href='index.php';</script>";
                   // header('location: index.php');
           }else{
           // header('location: login.php');
           echo "<script>alert('Invalid Credential')</script>";
         }
       }

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>ProTech | Log in</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
   <!-- icheck bootstrap -->
   <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="dist/css/adminlte.min.css">
 </head>
 <body class="hold-transition login-page">
 <div class="login-box">
   <div class="login-logo">
     <a href="#"><b>ProTech </b> Admin Panel</a>
   </div>
   <!-- /.login-logo -->
   <div class="card">
     <div class="card-body login-card-body">
       <p class="login-box-msg">Sign in to start your session</p>

       <form action="login.php" method="post">
         <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
         <div class="input-group mb-3">
           <input type="email" class="form-control" name="email" placeholder="Email">
           <div class="input-group-append">
             <div class="input-group-text">
               <span class="fas fa-envelope"></span>
             </div>
           </div>
         </div>
         <div class="input-group mb-3">
           <input type="password" class="form-control" name="password" placeholder="Password">
           <div class="input-group-append">
             <div class="input-group-text">
               <span class="fas fa-lock"></span>
             </div>
           </div>
         </div>
         <div class="row">
           <!-- /.col -->
           <div class="col-4">
             <button type="submit" class="btn btn-primary btn-block">Log In</button>
           </div>
           <!-- /.col -->
         </div>
       </form>
     </div>
     <!-- /.login-card-body -->
   </div>
 </div>
 <!-- /.login-box -->

 <!-- jQuery -->
 <script src="plugins/jquery/jquery.min.js"></script>
 <!-- Bootstrap 4 -->
 <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- AdminLTE App -->
 <script src="dist/js/adminlte.min.js"></script>
 </body>
 </html>
