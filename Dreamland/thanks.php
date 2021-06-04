<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Select Seat",$buffer);
  echo $buffer;
  include 'Layout2.php';

  include  'conn.php';

  $user = $_SESSION['user'];

  $timeslotID = $_SESSION['timeslotID'];

  $sqlmoviedetails = "SELECT * from timeslotview WHERE TimeslotID = '$timeslotID';";
  $result = mysqli_query($conn,$sqlmoviedetails);

  if ($rows = mysqli_fetch_array($result)) {
    $MovieID = $rows['MovieID'];
    $MovieTitle = $rows['MovieTitle'];
    $Date = $rows['showdate'];
    $StartTime = $rows['starttime'];
    $HallName = $rows['HallName'];
    $AdultPrice = $rows['AdultPrice'];
    $ChildPrice = $rows['ChildrenPrice'];
  }
  else {
  echo "<script>alert('No information about movie, Technical Errors!');</script>";

  }


  $sqlcheckaccdetail= "SELECT * FROM member WHERE AccUsername = '".$_SESSION['user']."'";
  $result2 = mysqli_query($conn,$sqlcheckaccdetail);
  if ($accrow = mysqli_fetch_array($result2) ) {
    $AccID = $accrow['AccID'];
    $_SESSION['MemberID'] = $AccID;
    $Name = $accrow['MemberName'];
    $Email = $accrow['MemberEmail'];
  }
  else {
    echo "<script>alert('Unable to get Acc Info');</script>";
  }

  $sqlinvoice = "SELECT * FROM invoice Where TimeslotID = $timeslotID Order by OrderDatetime DESC LIMIT 1;";
  $result3 = mysqli_query($conn,$sqlinvoice);
  if ($invoicerow = mysqli_fetch_array($result3) ) {
    $InvoiceID = $invoicerow['InvoiceID'];
    $AdultNumber = $invoicerow['AdultNumber'];
    $ChildrenNumber = $invoicerow['ChildrenNumber'];
    $TotalPrice = $invoicerow['TotalPrice'];
  }
  else {
    echo "<script>alert('Unable to get invoice Info');</script>";
  }

  $sqlbooking = "SELECT MemberID,TimeslotID,InvoiceID, GROUP_CONCAT(SeatID ORDER BY SeatID  ASC SEPARATOR ', ') As SeatID ".
  "FROM booking WHERE TimeslotID = '$timeslotID' AND MemberID = '$AccID' AND InvoiceID = $InvoiceID GROUP BY MemberID, TimeslotID,InvoiceID;";
  $result4 = mysqli_query($conn,$sqlbooking);
  //var_dump($sqlbooking);
  if ($bookingrow = mysqli_fetch_array($result4) ) {
    $SelectedSeat= $bookingrow['SeatID'];
  }
  else {
    echo "<script>alert('Unable to get invoice Info');</script>";
  }



  ?>
    <h2 class="h1title">Transaction Successfully</h1>
    <h2 class="thanks">Thank you for the purchase! Hope you Enjoy!</h2>
  <div class="container">
    <div class="w3le-reg">
      <div class="mr_agilemain">

        <table class="PaymentDetails">
          <tr>
            <th colspan="3" class="PaymentDetails">Payment Information</th>
          </tr>
          <tr>
            <th class="PaymentDetails1">Movie Title </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" name="MovieTitle" type="text" value="<?php echo $MovieTitle;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Date </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" name="Date" type="text" value="<?php echo $Date;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Time </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" name="Time" type="text"  value="<?php echo $StartTime;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Hall </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" name="Hall" type="text"  value="<?php echo $HallName;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Number of Adult Tickets(s) </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" name="adultNum" type="text"  value="<?php echo $AdultNumber;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Number of Children Ticket(s) </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" name="childNum" type="text"  value="<?php echo $ChildrenNumber;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Selected Seat(s) </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" name="seatid" type="text"  value="<?php echo $SelectedSeat;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Total Amount </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" name="TotalPrice" type="text"  value="<?php echo $TotalPrice;?>" readonly/></td>
          </tr>
        </table>
      </div>
      <?php
        unset($_SESSION['timeslotid']);
        unset($_SESSION['Movieid']);
      ?>
      <center>
        <a href="Home.php"><button class="comfirm">Back to Home</button></a>
      </center>
    </div>
  </div>
    
      <?php include 'footer.php'; ?>
