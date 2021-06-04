<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Edit Hall",$buffer);
  echo $buffer;
  include 'LayoutAdmin2.php';

  include 'conn.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM hall WHERE HallID = $id";
  $result = mysqli_query($conn,$sql);

  if ($rows = mysqli_fetch_array($result)){
    $HallID = $rows['HallID'];
    $HallName = $rows['HallName'];
    $SeatMap = $rows['SeatMap'];
    $RowCount = $rows['RowCount'];
    $ColumnCount = $rows['ColumnCount'];
    $TotalSeat =$rows['TotalSeat'];
  }
  else {
    echo "<script>alert('No data from database! Technical errors!');</script>";
    die ("<script>window.location.href='Hall.php';</script>");
  }

  ?>

  <div class="container">

      <div id="AddHallForm">
        <form  action="updatehall.php" method="post">
          <fieldset>
            <legend class="FormTitle">
              Edit Hall
            </legend>
            <table class="tblhallform"> <!--can chage to tblhallform?-->

              <tr>
                <th class="thlabel">Hall ID: </th>
                <td class="tdhallform" colspan="2"><input class="hallinfo" type="number" name="hallid" placeholder="Hall ID" value="<?php echo $HallID; ?>" readonly  /></td>
              </tr>
              <tr>
                <th class="thlabel">Hall Name: </th>
                <td class="tdhallform" colspan="2"><input class="hallinfo" type="text" name="hallname" placeholder="Hall Name" value="<?php echo $HallName; ?>" required /></td>
              </tr>
              <tr>
                <th class="thlabel" style="vertical-align:top;">Seat Map: <br /> (Click to enlarge image)</th>
                <td class="tdhallform">
                  <input class="hallinfo" type="radio" name="seatmap" value="Map1" onclick="rowcolumncount()" <?php if($SeatMap== "Map1")echo "checked='checked'";?>/>Map 1<br />
                  <img src="Image/Map1.JPG" alt="Map1" class="hallmap"/>
                </td>
                <td class="tdhallform">
                  <input class="hallinfo" type="radio" name="seatmap" value="Map2" onclick="rowcolumncount()" <?php if($SeatMap== "Map2")echo "checked='checked'";?>/>Map 2<br />
                  <img src="Image/Map1.JPG" alt="Map1" class="hallmap" />
                </td>

              </tr>
              <tr>
                <th class="thlabel">Row Count: </th>
                <td class="tdhallform" colspan="2"><input class="hallinfo" type="number" name="rowcount" placeholder="Row Count" value="<?php echo $RowCount; ?>" readonly /></td>
              </tr>
              <tr>
                <th class="thlabel">Column Count: </th>
                <td class="tdhallform" colspan="2"><input class="hallinfo" type="number" name="columncount" placeholder="Column Count"  value="<?php echo $ColumnCount; ?>" readonly /></td>
              </tr>
              <tr>
                <th class="thlabel">Total Seat: </th>
                <td class="tdhallform" colspan="2"><input id="TotalSeat" class="hallinfo" type="number" name="totalseat" placeholder="Total Seat" value="<?php echo $TotalSeat; ?>" readonly /></td>
              </tr>
              <tr>
                <th colspan="3"><input id="btntimeslotadd" type="submit" value="Save"/></th>
              </tr>
            </table>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script>

            function rowcolumncount(){
              var value = $("input[name='seatmap']:checked").val();
              if (value = "Map1"){
                $("input[name='rowcount']").val(10);
                $("input[name='columncount']").val(12);
              }
              if (value = "Map2"){
                $("input[name='rowcount']").val(10);
                $("input[name='columncount']").val(12);
              }
              var row = $('input[name="rowcount"]').val();
              var column = $('input[name="columncount"]').val();
              var totalseat = parseInt(row) * parseInt(column);
              $("#TotalSeat").val(totalseat);
            }

            </script>
          </fieldset>
        </form>
      </div>

  </div>
<?php include 'footer.php'; ?>
