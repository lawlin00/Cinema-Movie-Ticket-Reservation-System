<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Order List",$buffer);
  echo $buffer;
  include 'LayoutAdmin3.php'; ?>

  <h1 class="h1title">All Showtimes</h1>
  <h1 class="h1title" style="font-size:18px;">Please add new timeslot through Movie List Page.</h1>
  <div class="container">
  <div class="w3le-reg">
    <div class="option">
      <a href=AdminMovie.php><button class="add" type="button">Movie List</button></a>
    <center>
      <form action="searchtimeslot.php" method="post">
      <input type="text" name="tsearch" placeholder="Search" class="PaymentDetails" style="border:1px solid white; margin:5px;"/>
      <button class="Search" value="submit">Search</button>
      </form>
    </center>

    </div>
    <div class="mragilemain">

      <table class="PaymentDetails" >
        <tr>
          <th colspan="4" class="PaymentDetails2">Showtimes</th>
        </tr>
        <tr>

          <th class="PaymentDetails2">Movie Title </th>
          <th class="PaymentDetails2">Showtimes </th>
          <th class="PaymentDetails2">Number of Ticket </th>

          <th> </th>
        </tr>

        <?php

        include 'conn.php';

        $sql = "SELECT * FROM timeslotview ORDER BY showdate DESC;";
        $result = mysqli_query($conn,$sql);
        while ($rows = mysqli_fetch_array($result) ) {
          echo "<tr>";

          echo "<td class = 'PaymentDetails'>".$rows['MovieTitle']."</td>";
          echo "<td class = 'PaymentDetails'>".$rows['showdate']." ".$rows['starttime']."</td>";
          echo "<td class = 'PaymentDetails'>".$rows['TicketNum']."</td>";
          echo "<td class = 'PaymentDetails'><a href = 'edittimeslot.php?id=".$rows['TimeslotID']."'><button class = 'tdbtn'>Edit</button></a><br />".
          "<a href = 'deletetimeslot.php?id=".$rows['TimeslotID']."'><button class = 'tdbtn' onclick =\"return confirm('Do you really want to delete the information?');\">Delete</button></a><br /></td>";
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
