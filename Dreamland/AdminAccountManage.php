<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Order List",$buffer);
  echo $buffer;
  include 'LayoutAdmin3.php'; ?>

  <h1 class="h1title">Account Information</h1>
  <div class="container">
  <div class="w3le-reg">
    <div class="mragilemain">

      <table class="PaymentDetails">>
        <tr>
          <th class="PaymentDetails2">Username </th>
          <th class="PaymentDetails2">Email </th>
          <th class="PaymentDetails2">Role </th>
          <th> </th>
        </tr>

        <?php

        include 'conn.php';

        $sql = "SELECT * From Member";
        $result = mysqli_query($conn,$sql);

        while ($rows = mysqli_fetch_array($result) ) {
          echo "<tr>";
          echo "<td class = 'PaymentDetails'>".$rows['AccUsername']."</td>";
          echo "<td class = 'PaymentDetails'>".$rows['MemberEmail']."</td>";
          echo "<td class = 'PaymentDetails'>".$rows['UserRole']."</td>";
          echo "<td class = 'PaymentDetails'><a href = 'editacc.php?id=".$rows['AccID']."'><button class = 'tdbtn'>Edit</button></a><br />".
          "<a href = 'deleteacc.php?id=".$rows['AccID']."'><button class = 'tdbtn'  onclick =\"return confirm('Do you really want to delete the information?');\">Delete</button></a><br /></td>";
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
