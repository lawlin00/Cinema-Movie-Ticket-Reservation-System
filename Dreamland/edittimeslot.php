<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Edit Timeslot",$buffer);
  echo $buffer;
  include 'LayoutAdmin2.php';
  include 'conn.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM timeslotview WHERE TimeslotID = $id";
  $result = mysqli_query($conn,$sql);

    if ($rows=mysqli_fetch_array($result)) {
      $MovieID = $rows['MovieID'];
      $MovieTitle = $rows['MovieTitle'];
      $Showdate = $rows['showdate'];
      $StartTime = $rows['starttime'];
      $HallID = $rows['HallID'];
      $HallName = $rows['HallName'];
      $TicketNum = $rows['TicketNum'];
      $AdultPrice = $rows['AdultPrice'];
      $ChildrenPrice = $rows['ChildrenPrice'];
      $MovieRunningTime = $rows['MovieRunningTime'];
      $MovieStatus = $rows['MovieStatus'];
    }
    else {
      echo"<script>alert('No data from db!Technical errors!');</script>";
    }

  ?>

  <div class="container">

      <div id="AddTimeSlotForm">
        <form id="timeslotform" action=<?php echo "updatetimeslot.php?id=".$id;  ?> method="post">
          <fieldset>
            <legend class="FormTitle">
              Edit Time Slot
            </legend>
            <table class="tbltimeslot">
              <tr>
                <th class="thlabel">Movie ID: </th>
                <td><input class="timeslotinfo" type="text" value ="<?php echo $MovieID; ?>" name="movieid" readonly/></td>
              </tr>
              <tr>
                <th class="thlabel">Movie Name: </th>
                <th class="thlabel"><?php echo $MovieTitle; ?></th>
              </tr>
              <tr>
                <th class="thlabel">Duration: </th>
                <th class="thlabel"><?php echo $MovieRunningTime; ?> minutes</th>
              </tr>
              <tr>
                <th class="thlabel">Show Date: </th>
                <td><input class="timeslotinfo" type="date" name="showdate" placeholder="Show Date" value="<?php echo $Showdate;?>" required /></td>
              </tr>
              <tr>
                <th class="thlabel">Start Time (example:23:59): </th>
                <td><input class="timeslotinfo" type="text" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" name="starttime" placeholder="HH:MM" value="<?php echo date('H:i',strtotime($StartTime));?>" required /></td>
              </tr>
              <?php
                if ($MovieStatus == 1) {
                  echo "<tr>";
                  echo "<th class='thlabel'>Hall: </th>";
                  echo "<td>";
                  echo "<select name='hallid' class='cmbtimeslotinfo' style='width: 110%;'>";
                  echo "<option value='$HallID'>$HallName</option>";
                  echo "</select>";
                  echo "</td>";
                  echo "</tr>";

                  echo "<tr>";
                  echo "<th class='thlabel'>Number of Ticket: </th>";
                  echo "<td><input class='timeslotinfo' type='number' name='ticketnum' placeholder='Number of Ticket' value='$TicketNum' readonly /></td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<th class='thlabel'>Adult Price: </th>";
                  echo "<td><input class='timeslotinfo' name='adultprice' type='number' placeholder='Adult Price' value='$AdultPrice' readonly/></td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<th class='thlabel'>Children Price: </th>";
                  echo "<td><input class='timeslotinfo' name='childrenprice' type='number' placeholder='Children Price' value='$ChildrenPrice' readonly/></td>";
                  echo "</tr>";
                }
                else {
                  echo "<tr>";
                  echo "<th class='thlabel'>Hall: </th>";
                  echo "<td>";
                  echo "<select name='hallid' class='cmbtimeslotinfo' style='width: 110%;''>";
                  $sql2 = "SELECT * FROM hall;";
                  $result2 = mysqli_query($conn,$sql2);

                  while ($rows2 = mysqli_fetch_array($result2)) {
                    $HallID2 = $rows2['HallID'];
                      if ($HallID == $HallID2) {
                        echo "<option value='".$rows2['HallID']."' selected>".$rows2['HallName']."</option>";
                      }
                      else {
                        echo "<option value='".$rows2['HallID']."'>".$rows2['HallName']."</option>";
                      }
                    }
                  echo "</select>";
                  echo "</td>";
                  echo "</tr>";

                  echo "<tr>";
                  echo "<th class='thlabel'>Number of Ticket: </th>";
                  echo "<td><input class='timeslotinfo' type='number' name='ticketnum' placeholder='Number of Ticket' value='$TicketNum' required /></td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<th class='thlabel'>Adult Price: </th>";
                  echo "<td><input class='timeslotinfo' name='adultprice' type='number' placeholder='Adult Price' value='$AdultPrice' required/></td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<th class='thlabel'>Children Price: </th>";
                  echo "<td><input class='timeslotinfo' name='childrenprice' type='number' placeholder='Children Price' value='$ChildrenPrice' required/></td>";
                  echo "</tr>";
                }

              ?>

              <tr>
                <th colspan="2"><input id="btntimeslotadd" type="submit" value="Update"/></th>
              </tr>
            </table>

          </fieldset>
        </form>
      </div>

  </div>
<?php include 'footer.php'; ?>
