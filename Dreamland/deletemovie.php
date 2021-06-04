<?php

  include 'conn.php';
  $id = intval($_GET['id']); //Get contact if from delete btn , make it become integer value
  $sql = "DELETE FROM movie WHERE MovieID = $id";
  $result = mysqli_query($conn,$sql);
  //check if the data delete or not
  if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
    echo "<script>alert('Unable to deleta data!');";
    die ("window.location.href = 'AdminMovie.php';</script>");
  }
else {
  echo "<script>alert('Data deleted!');</script>";
  echo "<script>window.location.href = 'AdminMovie.php';</script>";
}

 ?>
