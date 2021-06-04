<?php

  include 'conn.php';
  $id = intval($_GET['id']); //Get contact if from delete btn , make it become integer value


  $sql2 = "DELETE From booking WHERE InvoiceID = '$id';";
  $result2 = mysqli_query($conn,$sql2);
  if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
    echo "<script>alert('Unable to deleta data!');";
    die ("window.history.go(-1);</script>");
  }
  else {
  echo "<script>alert('Data deleted!');</script>";
  //  echo "<script>window.location.href = 'Hall.php';</script>";
  }

  $sql = "DELETE From invoice WHERE InvoiceID = '$id';";
  $result = mysqli_query($conn,$sql);
  //var_dump($sql);
  //check if the data delete or not
  if (mysqli_affected_rows($conn)<=0) {//Not delete, alert msg
    echo "<script>alert('Unable to deleta data!');";
    die ("window.history.go(-1);</script>");
  }
else {
  echo "<script>alert('Data deleted!');</script>";
  echo "<script>window.history.go(-1);</script>";
}


 ?>
