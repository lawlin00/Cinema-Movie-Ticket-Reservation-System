<?php

  include 'conn.php';

  $id = $_GET['id'];
  $MovieID = $_POST['movieid'];
  $Showdate = $_POST['showdate'];
  $StartTime = $_POST['starttime'].':00';
  $HallID = $_POST['hallid'];
  $TicketNum = $_POST['ticketnum'];
  $AdultPrice = $_POST['adultprice'];
  $ChildrenPrice = $_POST['childrenprice'];

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

  if ($TicketNum > $TotalSeat) {
    echo"<script>alert('This hall only can fit ".$TotalSeat." people. Please Change your Ticket Number!');</script>";
    die ("<script>window.history.go(-1);</script>");
  }else {
    if ($Showdate == $date2 && $StartTime == $time) {
      echo"<script>alert('This timeslot and hall is booked! Please change your timeslot.');</script>";
    die ("<script>window.history.go(-1);</script>");
    }else {
      $sql = "Update timeslot SET ".
      "showdate = '$Showdate',".
      "starttime = '$StartTime',".
      "HallID = '$HallID',".
      "TicketNum = '$TicketNum',".
      "AdultPrice = '$AdultPrice',".
      "ChildrenPrice = '$ChildrenPrice' WHERE TimeslotID = $id ;";

      mysqli_query($conn,$sql);
    //if the connection database affected rows <=0, alert msg
      if (mysqli_affected_rows($conn)<=0){
          echo "<script>alert('Cannot Update Data!');</script>";
          die ("<script>window.history.go(-1);</script>");
      }
      else {
        echo "<script>alert('Successfully update data!');</script>";
        echo "<script>window.history.go(-2);</script>";
      }
    }
  }




 ?>
