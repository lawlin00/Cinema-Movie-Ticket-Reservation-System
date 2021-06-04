<?php

  session_start();
  include "conn.php";

  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);

  //Check normal user
  $sql = "SELECT * FROM member where AccUsername = '".$username."'";

  $result = mysqli_query($conn,$sql);


  if (mysqli_num_rows($result) >0) {
    $rows = mysqli_fetch_array($result);
      $_SESSION['user'] = $rows['AccUsername'];
      $_SESSION['password'] = $rows['AccPsw'];
      $_SESSION['role'] = $rows['UserRole'];

    if (password_verify($password,$rows['AccPsw'])) {
      if ($_SESSION['role']==="0"){
        echo "<script>alert('Successfully Login. Welcome!".$_SESSION['user']."');window.location.href ='Home.php';</script>";
      }
      elseif ($_SESSION['role']==="1") {
        echo "<script>alert('Welcome back! admin');</script>";
        echo "<script>window.location.href = 'AdminMovie.php';</script>";
      }
    }
    else {
      echo "<script>alert('Wrong Username or Password! Please Try Again.');";
      die ("window.history.go(-1);</script>");
  }
  }

//use session to record variable







 ?>
