<?php
session_start();
include "database.php";

class Query
{
  public function register_role_attach($user_id, $role_id)
  {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO role_user(role_id, user_id) VALUES('$role_id', '$user_id')");
    $stmt->execute();

    if ($stmt) {
      return ['status'=> 'success'];
    }else{
      return ['status'=> 'failed'];
    }
  }

  public function auth($role_id)
  {
    $_SESSION['auth'] = [
      'auth' => 'true',
      'role' => $role_id,
    ];
  }

  public function redirect($location)
  {
    header("location:". $location);
  }

  public function register($name, $email, $password){

    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (name,email,password) VALUES('$name', '$email', '$password')");
    $stmt->execute();
    if ($stmt) {
      $latestaddeduserstmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
      $latestaddeduserstmt->execute();
      $userdata = $latestaddeduserstmt->fetch(PDO::FETCH_ASSOC);

      $rolestmt = $pdo->prepare("SELECT * FROM `roles` WHERE `role_name` = 'user'");
      $rolestmt->execute();
      $roledata = $rolestmt->fetch(PDO::FETCH_ASSOC);
      $role = $this->register_role_attach($userdata['id'], $roledata['id']);
      if ($role['status'] == 'success') {
        return ['status' => 'success'];
      }
    }else{
      return ['status' => 'error'];
    }
  }

  public function login($email, $password){
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = '$email'");
    $stmt->execute();
    $userdatas = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userdatas) {
      if($userdatas['password'] == $password){
        $user_id = $userdatas['id'];
        $stmt = $pdo->prepare("SELECT * FROM role_user WHERE user_id = '$user_id'");
        $stmt->execute();
        $roledata = $stmt->fetch(PDO::FETCH_ASSOC);
        $role_id = $roledata['role_id'];
        $rolestmt = $pdo->prepare("SELECT * FROM roles WHERE id = '$role_id'");
        $rolestmt->execute();
        $role = $rolestmt->fetch(PDO::FETCH_ASSOC);
        $this->auth($role['role_name']);
        if($role['role_name'] == 'admin'){
          $this->redirect('admin/dashboard.php');
        }else{
          $this->redirect('Index.php');
        }
      }else{
        return "Invalid Cridential";
      }
    }else{
      return "Invalid Cridential";
    }
  }


// Admin Panel query


public function addUser($name, $email, $role_id, $passHash)
{
  global $pdo;

  $userstmt = $pdo->prepare("INSERT INTO users (name,email,password) VALUES (:name,:email,:password)");
  $result1 = $userstmt->execute(
    array
    (':name' => $name, ':email' => $email, ':password' => $passHash)
  );

  $user_idstmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
  $user_idstmt->execute();
  $user_id = $user_idstmt->fetch(PDO::FETCH_ASSOC);
  $userid = $user_id['id'];
  $role_userstmt = $pdo->prepare("INSERT INTO role_user (role_id, user_id) VALUES (:role_id, :user_id)");
  $result2 = $role_userstmt->execute(
    array
    (':role_id' => $role_id, ':user_id' => $userid)
  );

  if ($result1 && $result2) {
    // echo '<script>swal("Good job!", "You clicked the button!", "success");</script>';
    echo '<script>';
    echo 'swal("Success!", "User Created Successfully", "success").then(function() {';
    echo '   window.location.href = "index.php";';
    echo '});';
    echo '</script>';
  }
}

public function editUser($name, $email, $password, $role_id, $id)
{
  global $pdo;

  $date = date("Y-m-d");
  $time = date("h:i:s");
  $updated_at = $date . " " . $time;
    $passHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email AND id!=:id");
    $stmt->execute(
      array (':email'=>$email,':id'=>$id)
    );
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      echo '<script>swal("Sorry", "This email is already exist !!", "error");</script>';
    }else{
      if ($password != null) {
        $stmt = $pdo->prepare("UPDATE users SET name='$name', email='$email', password='$passHash', updated_at='$updated_at' WHERE id='$id'");
      }else{
        $stmt = $pdo->prepare("UPDATE users SET name='$name', email='$email', updated_at='$updated_at' WHERE id='$id'");
      }
      $result1 = $stmt->execute();

      $role_userstmt = $pdo->prepare("UPDATE role_user SET role_id=:role_id WHERE user_id='$id'");
      $result2 = $role_userstmt->execute(
        array(':role_id' => $role_id)
      );

      if ($result1 && $result2) {
        echo '<script>';
        echo 'swal("Success", "Updated Successfully", "success").then(function() {';
        echo '   window.location.href = "index.php";';
        echo '});';
        echo '</script>';
      }
    }
}
public function addCourse($name, $desc, $content, $image, $duration, $type, $fee)
{
  global $pdo;

  $coursestmt = $pdo->prepare("INSERT INTO course(name,description,content,duration,type,fee,image) VALUES (:name,:desc,:content,:image,:duration,:type,:fee)");
  $courseresult = $coursestmt->execute(
    array(':name' => $name, ':desc' => $desc, ':content' => $content, ':image' => $image, ':duration' => $duration, ':type' => $type, ':fee' => $fee)
  );
  if ($courseresult) {
    echo '<script>';
    echo 'swal("Success", "Added Course Successfully", "success").then(function() {';
    echo '   window.location.href = "courses.php";';
    echo '});';
    echo '</script>';
  }
}

public function editCoursewithimage($name, $desc, $content, $duration, $type, $fee, $image, $id)
{
  global $pdo;

  $stmt = $pdo->prepare("UPDATE course SET name=:name, description=:desc, content=:content, duration=:duration, type=:type, fee=:fee, image=:image WHERE id='$id'");
  $result = $stmt->execute(
    array(':name' => $name, ':desc' => $desc, ':content' => $content, ':duration' => $duration, ':type' => $type, ':fee' => $fee, ':image' => $image)
  );
  if ($result) {
    echo "<script>alert('Course Updated Successfully');window.location.href = 'index.php';</script>";
  }
}

public function editCoursewithoutimage($name, $desc, $content, $duration, $type, $fee, $id)
{
  global $pdo;

  $stmt = $pdo->prepare("UPDATE course SET name=:name, description=:desc, content=:content, duration=:duration, type=:type, fee=:fee WHERE id='$id'");
  $result = $stmt->execute(
    array(':name' => $name, ':desc' => $desc, ':content' => $content, ':duration' => $duration, ':type' => $type, ':fee' => $fee)
  );
  if ($result) {
    echo "<script>alert('Course Updated Successfully');window.location.href = 'courses.php';</script>";
      echo '<script>';
      echo 'swal("Success", "Added Course Successfully", "success").then(function() {';
      echo '   window.location.href = "courses.php";';
      echo '});';
      echo '</script>';
  }
}

public function addChapter($title, $course_id)
{
  global $pdo;

  $userstmt = $pdo->prepare("INSERT INTO chapters (title,course_id) VALUES (:title,:course_id)");
  $result1 = $userstmt->execute(
    array
    (':title' => $title, ':course_id' => $course_id)
  );
  // if ($result1) {
  //   echo "<script>alert(\"SUCCESS\");</script>";
  // }
  if ($result1) {
    echo '<script>';
    echo 'swal("Success!", "Chapter Created Successfully", "success").then(function() {';
    echo '   window.location.href = "chapters.php";';
    echo '});';
    echo '</script>';
  }
}

public function editChapter($title, $course_id, $id)
{
  global $pdo;

  $userstmt = $pdo->prepare("UPDATE chapters SET title=:title,course_id=:course_id WHERE id='$id'");
  $result1 = $userstmt->execute(
    array
    (':title' => $title, ':course_id' => $course_id)
  );
  if ($result1) {
    echo '<script>';
    echo 'swal("Success!", "Chapter Edited Successfully", "success").then(function() {';
    echo '   window.location.href = "chapters.php";';
    echo '});';
    echo '</script>';
  }
}

}
