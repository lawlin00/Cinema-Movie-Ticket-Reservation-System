<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Order List",$buffer);
  echo $buffer;
  include 'LayoutAdmin3.php'; ?>

  <h1 class="h1title">Payment Information</h1>
  <div class="container">
  <div class="w3le-reg">
    <div class="mragilemain">

      <table class="PaymentDetails">
        <tr>
          <th colspan="6" class="PaymentDetails2">Ticket Details</th>
        </tr>
        <tr>
          <th class="PaymentDetails2">Name </th>
          <th class="PaymentDetails2">Movie Title </th>
          <th class="PaymentDetails2">Showtimes </th>
          <th class="PaymentDetails2">Adult Number </th>
          <th class="PaymentDetails2">Children Number </th>
          <th> </th>
        </tr>

        <?php

        include 'conn.php';

        $sql = "SELECT InvoiceID,`i`.`TimeslotID`,`i`.`MemberID`,AdultNumber,ChildrenNumber,BillingName, MemberName, MovieTitle,showdate,starttime FROM invoice i\n"
            . "INNER JOIN timeslotview t ON t.TimeslotID = i.TimeslotID \n"
            . "INNER JOIN Member m ON i.MemberId = m.AccID\n"
            . "ORDER BY InvoiceID DESC";
        $result = mysqli_query($conn,$sql);
        while ($rows = mysqli_fetch_array($result) ) {
          echo "<tr>";
          echo "<td class = 'PaymentDetails'>".$rows['BillingName']."</td>";
          echo "<td class = 'PaymentDetails'>".$rows['MovieTitle']."</td>";
          echo "<td class = 'PaymentDetails'>".$rows['showdate']." ".$rows['starttime']."</td>";
          echo "<td class = 'PaymentDetails'>".$rows['AdultNumber']."</td>";
          echo "<td class = 'PaymentDetails'>".$rows['ChildrenNumber']."</td>";
          echo "<td class = 'PaymentDetails'><a href = viewinvoicedetails.php?id=".$rows['InvoiceID']."'><button class = 'tdbtn'>View</button></a><br />".
          "<a href = 'deleteinvoicebooking.php?id=".$rows['InvoiceID']."'><button class = 'tdbtn' onclick =\"return confirm('Do you really want to delete the information?');\">Delete</button></a><br /></td>";
          echo "</tr>";
        }
        if(mysqli_num_rows($result)<=0){
          echo "<script>alert('Unable to get Acc Info');</script>";
        }



         ?>


      </table>
    </div>


        </div>
  </div>
  </div>
<?php include 'footer.php'; ?>
