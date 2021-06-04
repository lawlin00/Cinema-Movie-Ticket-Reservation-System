<?php

  include 'conn.php';
  $id = intval($_GET['id']); //Get contact if from delete btn , make it become integer value
  $sql = "DELETE FROM member WHERE AccID = $id";
  $result = mysqli_query($conn,$sql);
  //check if the data delete or not
  if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
    echo "<script>alert('Unable to deleta data!');</script>";
    die ("<script>window.history.go(-1);</script>");
  }
else {
  echo "<script>alert('Data deleted!');</script>";
  echo "<script>window.history.go(-1);</script>";
}

 ?>
