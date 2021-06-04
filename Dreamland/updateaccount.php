<?php

  include 'conn.php';

  $id = $_POST['id'];
  $Name = $_POST['name'];
  $Email = $_POST['email'];
  $Contact = $_POST['contact'];
  $IC = $_POST['ic'];
  $Dob =$_POST['dob'];
  $Gender =$_POST['gender'];
  $Username =$_POST['username'];
  $Role =$_POST['role'];


  $Psw = $_POST['psw'];
  $passwordhash = password_hash($Psw, PASSWORD_BCRYPT);


    if (isset($_POST['psw'])) {
      $sql = "Update member SET MemberName = '$Name', MemberEmail = '$Email', MemberContact = '$Contact', MemberIC = '$IC', MemberDob = '$Dob' , MemberGender = '$Gender' , AccUsername = '$Username', UserRole = '$Role', AccPsw = '$passwordhash' WHERE AccID = $id;";
    }else {
      $sql ="Update member SET MemberName = '$Name', MemberEmail = '$Email', MemberContact = '$Contact', MemberIC = '$IC', MemberDob = '$Dob' , MemberGender = '$Gender' , AccUsername = '$Username', UserRole = '$Role' WHERE AccID = $id;";
    }

  mysqli_query($conn,$sql);

  if (mysqli_affected_rows($conn)<=0){
      echo "<script>alert('Cannot Update Data!');</script>";
      die ("<script>window.history.go(-1);</script>");
  }
  else {
    echo "<script>alert('Successfully update data!');</script>";
    echo "<script>window.location.href = 'userprofile.php';</script>";
  }

 ?>
