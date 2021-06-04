<?php
include 'conn.php';

session_start();

$sqlcheckaccdetail= "SELECT * FROM member WHERE AccUsername = '".$_SESSION['user']."'";
$result2 = mysqli_query($conn,$sqlcheckaccdetail);
if ($accrow = mysqli_fetch_array($result2) ) {
  $MemberID = $accrow['AccID'];
  $Name = $accrow['MemberName'];
  $Email = $accrow['MemberEmail'];
}
else {
  echo "<script>alert('Unable to get Acc Info');</script>";
}

  $timeslotID = $_SESSION['timeslotID'];
  $PaymentMethod = $_POST['PaymentMethod'];
  $CardNumber = $_POST['CardNumber'];
  $CardExpirationMonth = $_POST['Month'];
  $CardExpirationYear = $_POST['Year'];
  $SecurityCode = $_POST['SecurityCode'];
  $AdultNumber = $_POST['adultNum'];
  $ChildNumber = $_POST['childNum'];
  $TotalPrice = $_POST['TotalPrice'];
  $BillingName = $_POST['Name'];
  $BillingEmail = $_POST['Email'];
  $SelectedSeat = $_POST['seatid'];







  $sql = "INSERT INTO invoice (TimeslotID, PaymentMethod, CardNumber,CardExpirationMonth,CardExpirationYear, SecurityCode,MemberID,AdultNumber,ChildrenNumber,TotalPrice,BillingName,BillingEmail) VALUES ".
  "('$timeslotID','$PaymentMethod','$CardNumber','$CardExpirationMonth','$CardExpirationYear','$SecurityCode','$MemberID','$AdultNumber','$ChildNumber','$TotalPrice','$BillingName','$BillingEmail');";

  var_dump($sql);
  mysqli_query($conn,$sql);

  if (mysqli_affected_rows($conn)<=0) {
    echo "<script>alert('Invoice Insert failure');</script>";
    //die ("<script>window.location.href='Home.php'</script>");
  }else {
      echo "<script>alert('Invoice Insert Successfully');</script>";
      $sqlinvoiceid = "SELECT * FROM invoice Order by OrderDatetime DESC LIMIT 1;";
      $InvoiceIDGet = mysqli_query($conn,$sqlinvoiceid);

        if ($invoicerow = mysqli_fetch_array($InvoiceIDGet)) {
          $InvoiceID = $invoicerow['InvoiceID'];
        }
        else {
          echo "<script>alert('Unable to get invoice Info');</script>";
        }
    }





  $sqlbooking = "INSERT INTO booking (MemberID,TimeslotID, SeatID,InvoiceID) VALUES ";

  $Seatid = explode(",",$SelectedSeat);



  foreach ($Seatid as $key => $value) {

      $sqlbooking.= "('$MemberID','$timeslotID','$value','$InvoiceID'), ";

      // $sqlbooking.= "('$MemberID,'$Seatid[$key]','$timeslotID'),";

  }
  $sqlbooking = rtrim($sqlbooking,', ');
  //var_dump($sqlbooking);

  mysqli_query($conn,$sqlbooking);


  if (mysqli_affected_rows($conn)<=0) {
    echo "<script>alert('Booking Insert failure');</script>";
   // die ("<script>window.location.href='Home.php'</script>");
  }else{
    echo "<script>alert('Booking Insert Successfully! Payment Successfully!');</script>";
    echo "<script>window.location.href ='thanks.php';</script>";
  }




 ?>
