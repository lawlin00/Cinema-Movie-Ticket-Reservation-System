<?php

  $HallName = $_POST['hallname'];
  $SeatMap = $_POST['seatmap'];
  $RowCount = $_POST['rowcount'];
  $ColumnCount = $_POST['columncount'];
  $TotalSeat =$_POST['totalseat'];

  include 'conn.php';

  $sql = "INSERT INTO hall (HallName, SeatMap, RowCount,ColumnCount,TotalSeat) VALUES ('$HallName','$SeatMap','$RowCount','$ColumnCount','$TotalSeat');";

  mysqli_query($conn,$sql);

  if (mysqli_affected_rows($conn)<=0) {
    echo "<script>alert('Unable to add information!Please Try again.');</script>";
  }

  else {
    echo "<script>alert('Added Successfully.');";
    echo "window.location.href = 'Hall.php';</script>";
  }

 ?>
