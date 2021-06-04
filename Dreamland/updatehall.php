<?php

  include 'conn.php';

  $HallID = $_POST['hallid'];
  $HallName = $_POST['hallname'];
  $SeatMap = $_POST['seatmap'];
  $RowCount = $_POST['rowcount'];
  $ColumnCount = $_POST['columncount'];
  $TotalSeat =$_POST['totalseat'];

  $sql = "Update hall SET HallName = '$HallName', SeatMap = '$SeatMap', RowCount = '$RowCount', ColumnCount = '$ColumnCount', TotalSeat = '$TotalSeat' WHERE HallID = $HallID;";

  mysqli_query($conn,$sql);

  if (mysqli_affected_rows($conn)<=0){
      echo "<script>alert('Cannot Update Data!');</script>";
      die ("<script>window.history.go(-1);</script>");
  }
  else {
    echo "<script>alert('Successfully update data!');</script>";
    echo "<script>window.location.href = 'Hall.php';</script>";
  }

 ?>
