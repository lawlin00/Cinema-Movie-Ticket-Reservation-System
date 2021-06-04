<?php

  include "conn.php";
  //escape variable for security
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $contact = mysqli_real_escape_string($conn,$_POST['contact']);
  $ic = mysqli_real_escape_string($conn,$_POST['ic']);
  $dob = mysqli_real_escape_string($conn,$_POST['dob']);
  $gender = mysqli_real_escape_string($conn,$_POST['gender']);
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $psw = mysqli_real_escape_string($conn,$_POST['password']);
  $repsw = mysqli_real_escape_string($conn,$_POST['confirmpsw']);



  if ($psw !== $repsw){
    echo"<script>alert('Password and confirm password not same!');";
    die("window.history.go(-1);</script>");
  }

  $passwordhash = password_hash($psw, PASSWORD_BCRYPT);

  $sql = "INSERT INTO member (MemberName, MemberEmail, MemberContact, MemberIC, MemberDob, MemberGender, AccUsername, AccPsw) VALUES ".
  "('$name','$email','$contact','$ic','$dob','$gender','$username','".$passwordhash."');";

  mysqli_query($conn,$sql);

  if (mysqli_affected_rows($conn)<=0){
    echo "<script>alert('Unable to sign up!  Your name, email or username have been used! Please try again!');";
    die("window.history.go(-1);</script>");
  }
  else {
    echo "<script>alert('Register Successfully! Please Login Now!');";
    echo "window.location.href = 'LoginForm.php';</script>";
  }
 ?>
