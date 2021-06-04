<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Add Timeslot",$buffer);
  echo $buffer;
  include 'LayoutAdmin2.php';
  include 'conn.php';
  $id = $_GET['id'];



  ?>

  <div class="container">

      <div id="AddTimeSlotForm">
        <form id="timeslotform" action="inserttimeslot.php" method="post">
          <fieldset>
            <legend class="FormTitle">
              Add New Time Slot
            </legend>
            <table class="tbltimeslot">

                <?php
                if ($id != NULL) {
                  echo "<tr>";
                    echo "<th class='thlabel'>Movie ID: </th>";
                  echo "<td><input class='timeslotinfo' type='text' value ='$id' name='movieid' readonly/></td>";
                  echo "</tr>";
                }
                ?>

              </tr>
              <tr>
                <th class="thlabel">Movie Name: </th>
                <?php
                $sql="SELECT * FROM movie WHERE MovieID = $id";
                $result = mysqli_query($conn,$sql);
                if ($rows = mysqli_fetch_array($result)) {
                  $MovieTitle = $rows['MovieTitle'];
                  $MovieRunningTime = $rows['MovieRunningTime'];
                }
                else {
                  echo "<script>alert('No selected movie! Techinical error!');</script>";
                  //die ("<script>window.history.go(-1);</script>");
                }?>

                <th class="thlabel"><?php echo $MovieTitle; ?></th>
              </tr>
              <tr>
                <th class="thlabel">Duration: </th>
                <th class="thlabel"><?php echo $MovieRunningTime; ?> minutes</th>
              </tr>
              <tr>
                <th class="thlabel">Show Date: </th>
                <td><input class="timeslotinfo" type="date" name="showdate" placeholder="Show Date" required /></td>
              </tr>
              <tr>
                <th class="thlabel">Start Time (example:23:59): </th>
                <td><input class="timeslotinfo" type="text" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" name="starttime" placeholder="HH:MM" required /></td>
              </tr>
              <tr>
                <th class="thlabel">Hall: </th>
                <td>
                  <select name="hallid" class="cmbtimeslotinfo" style="width: 110%;">
                    <?php
                    $sql2 = "SELECT * FROM hall;";
                    $result2 = mysqli_query($conn,$sql2);
                    while ($rows2 = mysqli_fetch_array($result2)) {
                      $HallName = $rows2['HallName'];
                      $HallID = $rows2['HallID'];
                      echo "<option value='$HallID'>$HallName</option>";
                    }
                     ?>
                   </td>
                  </select>

              </tr>
              <tr>
                <th class="thlabel">Number of Ticket: </th>
                <td><input class="timeslotinfo" type="number" name="ticketnum" placeholder="Number of Ticket" required /></td>
              </tr>
              <tr>
                <th class="thlabel">Adult Price: </th>
                <td><input class="timeslotinfo" name="adultprice" type="number" placeholder="Adult Price" required/></td>
              </tr>
              <tr>
                <th class="thlabel">Children Price: </th>
                <td><input class="timeslotinfo" name="childrenprice" type="number" placeholder="Children Price" required/></td>
              </tr>
              <tr>
                <th colspan="2"><input id="btntimeslotadd" type="submit" value="Add"/></th>
              </tr>
            </table>

          </fieldset>
        </form>
      </div>

  </div>
