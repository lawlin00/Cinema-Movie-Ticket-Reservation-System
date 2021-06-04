<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Invoice Details",$buffer);
  echo $buffer;
  include 'LayoutAdmin3.php';

  include  'conn.php';
  $id = intval($_GET['id']);

  $sql = "SELECT InvoiceID,`i`.`TimeslotID`,`i`.`MemberID`,AdultNumber,ChildrenNumber,AdultPrice, ChildrenPrice,BillingName, \n"

      . "BillingEmail,MemberName, MovieTitle,showdate,starttime, HallName, TotalPrice, `i`.`PaymentMethod`, `i`.`CardNumber`,\n"

      . "`i`.`CardExpirationMonth`, `i`.`CardExpirationYear`,`i`.`SecurityCode`,`i`.`OrderDatetime`\n"

      . "FROM invoice i INNER JOIN timeslotview t ON t.TimeslotID = i.TimeslotID INNER JOIN Member m ON i.MemberId = m.AccID \n"

      . "WHERE `i`.`InvoiceID` = '$id';";

      $result = mysqli_query($conn,$sql);

      if ($rows = mysqli_fetch_array($result)) {
        $MovieTitle = $rows['MovieTitle'];
        $Date = $rows['showdate'];
        $StartTime = $rows['starttime'];
        $HallName = $rows['HallName'];
        $AdultPrice = $rows['AdultPrice'];
        $ChildPrice = $rows['ChildrenPrice'];
        $PaymentMethod = $rows['PaymentMethod'];
        $CardNumber = $rows['CardNumber'];
        $Month = $rows['CardExpirationMonth'];
        $CardExpirationYear = $rows['CardExpirationYear'];
        $SecurityCode = $rows['SecurityCode'];
        $BillingName = $rows['BillingName'];
        $BillingEmail = $rows['BillingEmail'];
        $OrderDate = $rows['OrderDatetime'];
        $AccID = $rows['MemberID'];
        $AdultNumber = $rows['AdultNumber'];
        $ChildNumber = $rows['ChildrenNumber'];
        $TotalPrice = $rows['TotalPrice'];
      }
      else {
      echo "<script>alert('No information about invoice, Technical Errors!');</script>";

      }


  $sqlseat = "SELECT MemberID,InvoiceID, GROUP_CONCAT(SeatID ORDER BY SeatID  ASC SEPARATOR ', ') As SeatID ".
  "FROM booking WHERE InvoiceID = '$id' AND MemberID = '$AccID' GROUP BY MemberID, InvoiceID;";
  $result4 = mysqli_query($conn,$sqlseat);
  var_dump($sqlseat);
  if ($bookingrow = mysqli_fetch_array($result4) ) {
      $SelectedSeat= $bookingrow['SeatID'];
  }
  else {
  echo "<script>alert('Unable to get invoice Info');</script>";
  }







  ?>

  <h1 class="h1title">Order Information</h1>
  <div class="container">
  <div class="w3le-reg2">
    <div class="mragilemain">

      <table class="OrderDetails">
        <tr>
          <th colspan="3" class="PaymentDetails" style="border:0px;">Order Details</th>
        </tr>
        <tr>
          <th class="OrderDetails">Order Date </th>
          <th class="OrderDetails">: </th>
          <td class="OrderDetails"><input class="PaymentDetails" name="MovieTitle" type="text" value="<?php echo $OrderDate;?>" readonly/></td>
        </tr>
        <tr>
          <th class="OrderDetails">Movie Title </th>
          <th class="OrderDetails">: </th>
          <td class="OrderDetails"><input class="PaymentDetails" name="MovieTitle" type="text" value="<?php echo $MovieTitle;?>" readonly/></td>
        </tr>
        <tr>
          <th class="OrderDetails">Date </th>
          <th class="OrderDetails">: </th>
          <td class="OrderDetails"><input class="PaymentDetails" name="Date" type="text" value="<?php echo $Date;?>" readonly/></td>
        </tr>
        <tr>
          <th class="OrderDetails">Time </th>
          <th class="OrderDetails">: </th>
          <td class="OrderDetails"><input class="PaymentDetails" name="Time" type="text"  value="<?php echo $StartTime;?>" readonly/></td>
        </tr>
        <tr>
          <th class="OrderDetails">Hall </th>
          <th class="OrderDetails">: </th>
          <td class="OrderDetails"><input class="PaymentDetails" name="Hall" type="text"  value="<?php echo $HallName;?>" readonly/></td>
        </tr>
        <tr>
          <th class="OrderDetails">Number of Adult Tickets(s) </th>
          <th class="OrderDetails">: </th>
          <td class="OrderDetails"><input class="PaymentDetails" name="adultNum" type="text"  value="<?php echo $AdultNumber;?>" readonly/></td>
        </tr>
        <tr>
          <th class="OrderDetails">Number of Children Ticket(s) </th>
          <th class="OrderDetails">: </th>
          <td class="OrderDetails"><input class="PaymentDetails" name="childNum" type="text"  value="<?php echo $ChildNumber;?>" readonly/></td>
        </tr>
        <tr>
          <th class="OrderDetails">Selected Seat(s) </th>
          <th class="OrderDetails">: </th>
          <td class="OrderDetails"><input class="PaymentDetails" name="seatid" type="text"  value="<?php echo $SelectedSeat;?>" readonly/></td>
        </tr>
        <tr>
          <th class="OrderDetails">Total Amount </th>
          <th class="OrderDetails">: </th>
          <td class="OrderDetails"><input class="PaymentDetails" name="TotalPrice" type="text"  value="<?php echo $TotalPrice;?>" readonly/></td>
        </tr>
      </table>
    </div>
    <div class="PaymentMethod">
      <table class="PaymentDetails2">
        <tr>
          <th colspan="3" class="PaymentDetails" style="border:0px;">Payment Method</th>
        </tr>
        </table>

        <label class="lblPaymentMethod">Please Select a Payment Method:</label>><br />
        <select class="cmbpaymentmethod" name="PaymentMethod" readonly>
          <option value="Visa" <?php if ($PaymentMethod == "Visa") echo "selected ='selected'"; ?>>Visa</option>
          <option value="Master Card" <?php if ($PaymentMethod == "Master Card") echo "selected ='selected'"; ?>>Master Card</option>
        </select>><br />
        <label class="lblPaymentMethod">Card Number</label><br />
        <input type="number" name="CardNumber" class="PaymentMethod" value="<?php echo $CardNumber;?>" onKeyPress="if(this.value.length==16) return false;" placeholder="---- ---- ---- ----" readonly/><br />
        <label class="lblPaymentMethod">Expiration Date and Security Code</label><br />
        <select class="cmbsecuritycode" name="Month" readonly>
          <option value="--">--</option>
          <option value="01" <?php if ($Month == "1") echo "selected ='selected'"; ?>>01</option>
          <option value="01" <?php if ($Month == "2") echo "selected ='selected'"; ?>>02</option>
          <option value="01" <?php if ($Month == "3") echo "selected ='selected'"; ?>>03</option>
          <option value="01" <?php if ($Month == "4") echo "selected ='selected'"; ?>>04</option>
          <option value="01" <?php if ($Month == "5") echo "selected ='selected'"; ?>>05</option>
          <option value="01" <?php if ($Month == "6") echo "selected ='selected'"; ?>>06</option>
          <option value="01" <?php if ($Month == "7") echo "selected ='selected'"; ?>>07</option>
          <option value="01" <?php if ($Month == "8") echo "selected ='selected'"; ?>>08</option>
          <option value="01" <?php if ($Month == "9") echo "selected ='selected'"; ?>>09</option>
          <option value="01" <?php if ($Month == "10") echo "selected ='selected'"; ?>>10</option>
          <option value="01" <?php if ($Month == "11") echo "selected ='selected'"; ?>>11</option>
          <option value="01" <?php if ($Month == "12") echo "selected ='selected'"; ?>>12</option>
        </select>
        <input type="number" name="Year" class="PaymentMethod2" value="<?php echo $CardExpirationYear;?>"   onKeyPress="if(this.value.length==4) return false;" placeholder="Year (----)" readonly/>
        <input type="number" name="SecurityCode" class="PaymentMethod2" value="<?php echo $SecurityCode;?>"  onKeyPress="if(this.value.length==3) return false;" placeholder="Security Code (---)" readonly/>
        </div>
        <div class="PaymentMethod">
          <table class="PaymentDetails2">
            <tr>
              <th colspan="3" class="PaymentDetails" style="border:0px;">Billing Infomation</th>
            </tr>
            <tr>
              <th class="PaymentDetails1">Name </th>
              <th class="PaymentDetails1">: </th>
              <td class="PaymentDetails1"><input class="PaymentMethod" name="Name" type="text" placeholder="Name" value="<?php echo $BillingName;?>" readonly/></td>
            </tr>
            <tr>
              <th class="PaymentDetails1">Email </th>
              <th class="PaymentDetails1">: </th>
              <td class="PaymentDetails1"><input  class="PaymentMethod" name="Email" type="email"  value="<?php echo $BillingEmail;?>" placeholder = "Email" readonly/></td>
            </tr>

            </table>
        </div>
        <center>
        <a href="InvoiceList.php"><button class="comfirm" >Back</button></a>
        </center>

  </div>
  </div>
<?php include 'footer.php'; ?>
