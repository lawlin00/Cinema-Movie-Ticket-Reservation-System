<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Admin Showtime",$buffer);
  echo $buffer;
  include 'LayoutAdmin.php';
  include 'conn.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM movie WHERE MovieID = $id";
  $result = mysqli_query($conn,$sql);


  if (mysqli_num_rows($result)<=0) {
    die ("<script>alert('No Timeslot added! Please Insert Timeslot');</script>");
  }
  $rows = mysqli_fetch_array($result)

  ?>

<center>
    <div id="AdminMovie">
      <legend>
        Showtime
      </legend>
      <div class="option">
      <a href=<?php echo "addtimeslotform.php?id=".$id;  ?>><button class="add" type="button"><i class="material-icons" style="font-size:18px; padding-right:5px;">add</i>Add Time Slot</button></a>
      <center>
      <div>
        <h3 class="txttimeslot">Movie: <?php echo $rows['MovieTitle'];?> </h3><br /><br />
        <h3 class="txttimeslot">Duration: <?php echo $rows['MovieRunningTime'];?> minutes </h3>
      </div>
      </center>
      </div>
      <center>
        <table id="tblAdminMovie">
          <tr>
            <th>Showtime</th>
            <th>Hall</th>
            <th>Number of Ticket</th>
            <th>Adult Price</th>
            <th>Children Price</th>
            <th> </th>
          </tr>

          <?php
          $sql = "SELECT * FROM timeslotview WHERE MovieID = $id";
          $result = mysqli_query($conn,$sql);


          if (mysqli_num_rows($result)<=0) {
            die ("<script>alert('No Timeslot added! Please Insert Timeslot');</script>");
          }

          while ($rows = mysqli_fetch_array($result)) {

            echo "<tr>";
            echo "<td class='tdinfo'>".$rows['showdate']." ".$rows['starttime']."</td>";
            echo "<td class='tdinfo'>".$rows['HallName']."</td>";
            echo "<td class='tdinfo'>".$rows['TicketNum']."</td>";
            echo "<td class='tdinfo'>".$rows['AdultPrice']."</td>";
            echo "<td class='tdinfo'>".$rows['ChildrenPrice']."</td>";
            echo "<td class='tdinfo'><a href='edittimeslot.php?id=".$rows['TimeslotID']."'><button class='tdbtn'>Edit</button></a><br />".
            "<a href = 'deletetimeslot.php?id=".$rows['TimeslotID']."'><button class = 'tdbtn'  onclick =\"return confirm('Do you really want to delete the information?');\">Delete</button></a></td>";
            echo "</tr>";

          }

           ?>

        </table>
      </center>
    </div>
    
