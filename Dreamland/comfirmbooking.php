<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Select Seat",$buffer);
  echo $buffer;
  include 'Layout2.php';

  include  'conn.php';

  $AdultNumber = $_POST['adultNum'];
  $ChildNumber = $_POST['childNum'];
  $SelectedSeat = $_POST['seatid'];

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


  $AdultTotalPrice = $AdultPrice * $AdultNumber;
  $ChildTotalPrice = $ChildPrice * $ChildNumber;
  $TotalPrice = $AdultTotalPrice + $ChildTotalPrice;

  $sqlcheckaccdetail= "SELECT * FROM member WHERE AccUsername = '".$_SESSION['user']."'";
  $result2 = mysqli_query($conn,$sqlcheckaccdetail);
  if ($accrow = mysqli_fetch_array($result2) ) {
    $AccID = $accrow['AccID'];
    $Name = $accrow['MemberName'];
    $Email = $accrow['MemberEmail'];
  }
  else {
    echo "<script>alert('Unable to get Acc Info');</script>";
  }



  ?>
    <h1 class="h1title">Comfirm Payment Information</h1>
  <div class="container">
    <form action="comfirmbooking.php" method="post">
    <div class="w3le-reg">
      <div class="mr_agilemain">

        <table class="PaymentDetails">
          <tr>
            <th colspan="3" class="PaymentDetails">Ticket Details</th>
          </tr>
          <tr>
            <th class="PaymentDetails1">Movie Title </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" type="text" value="<?php echo $MovieTitle;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Date </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" type="text" value="<?php echo $Date;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Time </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" type="text"  value="<?php echo $StartTime;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Hall </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" type="text"  value="<?php echo $HallName;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Number of Adult Tickets(s) </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" type="text"  value="<?php echo $AdultNumber;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Number of Children Ticket(s) </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" type="text"  value="<?php echo $ChildNumber;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Selected Seat(s) </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" type="text"  value="<?php echo $SelectedSeat;?>" readonly/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Total Amount </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails"><input class="PaymentDetails" type="text"  value="RM <?php echo $TotalPrice;?>" readonly/></td>
          </tr>
        </table>
      </div>
      <div class="PaymentMethod">
        <table class="PaymentDetails2">
          <tr>
            <th colspan="3" class="PaymentDetails">Payment Information</th>
          </tr>
          </table>

          <label class="lblPaymentMethod">Please Select a Payment Method:</label>><br />
          <select class="cmbpaymentmethod" name="PaymentMethod">
            <option value="Visa">Visa</option>
            <option value="Master Card">Master Card</option>
          </select>><br />
          <label class="lblPaymentMethod">Card Number</label><br />
          <input type="number" class="PaymentMethod" onKeyPress="if(this.value.length==16) return false;" placeholder="---- ---- ---- ----" required/><br />
          <label class="lblPaymentMethod">Expiration Date and Security Code</label><br />
          <select class="cmbsecuritycode" name="Month">
            <option value="--">--</option>
            <option value="01">01</option>
            <option value="01">02</option>
            <option value="01">03</option>
            <option value="01">04</option>
            <option value="01">05</option>
            <option value="01">06</option>
            <option value="01">07</option>
            <option value="01">08</option>
            <option value="01">09</option>
            <option value="01">10</option>
            <option value="01">11</option>
            <option value="01">12</option>
          </select>
          <input type="number"  class="PaymentMethod2" onKeyPress="if(this.value.length==4) return false;" placeholder="Year (----)" required/>
          <input type="number"  class="PaymentMethod2" onKeyPress="if(this.value.length==3) return false;" placeholder="Security Code (---)" required/>
          </div>
          <div class="PaymentMethod">
            <table class="PaymentDetails2">
              <tr>
                <th colspan="3" class="PaymentDetails">Billing Infomation</th>
              </tr>
              <tr>
                <th class="PaymentDetails1">Name </th>
                <th class="PaymentDetails1">: </th>
                <td class="PaymentDetails"><input class="PaymentMethod" type="text" placeholder="Name" value="<?php echo $Name;?>" required/></td>
              </tr>
              <tr>
                <th class="PaymentDetails1">Email </th>
                <th class="PaymentDetails1">: </th>
                <td class="PaymentDetails"><input  class="PaymentMethod" type="email"  value="<?php echo $Email;?>" placeholder = "Email" required/></td>
              </tr>

              </table>
          </div>
          <a href="Home.php"><button class="cancel">Cancel</button></a>
          <button class="comfirm" value="submit">Purchase</button>
          </form>
    </div>
  </div>
