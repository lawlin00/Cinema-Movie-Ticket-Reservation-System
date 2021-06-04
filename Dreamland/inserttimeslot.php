<?php

  $MovieID = $_POST['movieid'];
  $Showdate = $_POST['showdate'];
  $StartTime = $_POST['starttime'].':00';
  $HallID = $_POST['hallid'];
  $TicketNum = $_POST['ticketnum'];
  $AdultPrice = $_POST['adultprice'];
  $ChildrenPrice = $_POST['childrenprice'];


  include 'conn.php';

  $selectsql = "SELECT * FROM hall WHERE HallID = $HallID";
  $result = mysqli_query($conn,$selectsql);
  if ($rows=mysqli_fetch_array($result)) {
    $HallID = $rows['HallID'];
    $HallName = $rows['HallName'];
    $SeatMap = $rows['SeatMap'];
    $RowCount = $rows['RowCount'];
    $ColumnCount = $rows['ColumnCount'];
    $TotalSeat =$rows['TotalSeat'];
  }
  else {
    echo"<script>alert('No hall data from db!Technical errors!');</script>";
  }

  $timeslotsql = "SELECT * From timeslot WHERE HallID = $HallID";
  $timeslotresult =mysqli_query($conn,$timeslotsql);
  while ($timeslot = mysqli_fetch_array($timeslotresult)) {
    $date2 = $timeslot['showdate'];
    $time = $timeslot['starttime'];
    $Hall = $timeslot['HallID'];
  }

//mysqli_autocommit($conn,False);

if ($TicketNum > $TotalSeat) {
  echo"<script>alert('This hall only can fit ".$TotalSeat." people. Please Change your Ticket Number!');</script>";
  die ("<script>window.history.go(-1);</script>");
}else {
  # code...
  if ($Showdate == $date2 && $StartTime == $time) {
    echo"<script>alert('This timeslot and hall is booked! Please change your timeslot.');</script>";
    die ("<script>window.history.go(-1);</script>");
  }
  else {
    $sql = "INSERT INTO timeslot (showdate,starttime,HallID,MovieID,TicketNum,AdultPrice,ChildrenPrice) VALUES ".
    "('$Showdate','$StartTime','$HallID','$MovieID','$TicketNum','$AdultPrice','$ChildrenPrice');";
    mysqli_query($conn,$sql);
  //var_dump(mysqli_affected_rows($conn));
  //var_dump($sql);
  //if (!mysqli_commit($conn)){
    if (mysqli_affected_rows($conn)<=0) {
      echo "<script>alert('Unable to add information! Please try again.');</script>;";
      die ("<script>window.history.go(-1);</script>");
    }
    else {
      echo "<script>alert('Added Successfully.');</script>";
      echo "<script>window.history.go(-2);</script>";
    }
  }
}





  //mysqli_free_result($conn);


//INSERT INTO seat (RowID, ColumnID, MovieID)
//VALUES ('B','1','7'),('B','2','7'),('B','3','7'),('B','4','7'),('B','5','7'),
//('B','7','7'),('B','8','7'),('B','9','7'),('B','10','7'),('B','11','7'),('B','12','7');



//Reference for insert select :https://stackoverflow.com/questions/25969/insert-into-values-select-from (34)

 ?>
