<?php

session_start();
require '../config/config.php';
if (empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
    header('location: login.php');
}

if (!empty($_GET['table_name']) && !empty($_GET['id'])) {
  if ($_GET['table_name'] == "courses") {
    $stmt = $pdo->prepare("DELETE FROM course WHERE id=".$_GET['id']);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>window.location.href = 'courses.php';</script>";
    }
  }elseif ($_GET['table_name'] == "users") {
    $user_stmt = $pdo->prepare("DELETE FROM users WHERE id=".$_GET['id']);
    $result1 = $user_stmt->execute();

    $roleuser_stmt = $pdo->prepare("DELETE FROM role_user WHERE user_id=".$_GET['id']);
    $result2 = $roleuser_stmt->execute();
    if ($result1 && $result2) {
      echo "<script>window.location.href = 'index.php';</script>";
    }
  }elseif ($_GET['table_name'] == "chapters") {
    $stmt = $pdo->prepare("DELETE FROM chapters WHERE id=".$_GET['id']);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>window.location.href = 'chapters.php';</script>";
    }
  }
}
