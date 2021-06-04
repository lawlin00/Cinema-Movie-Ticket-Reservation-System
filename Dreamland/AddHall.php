<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Add Hall",$buffer);
  echo $buffer;
  include 'LayoutAdmin2.php';

  ?>

  <div class="container">

      <div id="AddHallForm">
        <form  action="inserthall.php" method="post">
          <fieldset>
            <legend class="FormTitle">
              Add New Hall
            </legend>
            <table class="tblhallform"> <!--can chage to tblhallform?-->

              <tr>
                <th class="thlabel">Hall Name: </th>
                <td class="tdhallform" colspan="2"><input class="hallinfo" type="text" name="hallname" placeholder="Hall Name" required /></td>
              </tr>
              <tr>
                <th class="thlabel" style="vertical-align:top;">Seat Map: <br /> (Click to enlarge image)</th>
                <td class="tdhallform">
                  <input class="hallinfo" type="radio" name="seatmap" value="Map1" onclick="rowcolumncount()"/>Map 1<br />
                  <img src="Image/Map1.jpg" alt="Map1" class="hallmap"/>
                </td>
                <td class="tdhallform">
                  <input class="hallinfo" type="radio" name="seatmap" value="Map2" onclick="rowcolumncount()"/>Map 2<br />
                  <img src="Image/Map2.JPG" alt="Map1" class="hallmap" />
                </td>

              </tr>
              <tr>
                <th class="thlabel">Row Count: </th>
                <td class="tdhallform" colspan="2"><input class="hallinfo" type="number" name="rowcount" placeholder="Hall Name" readonly /></td>
              </tr>
              <tr>
                <th class="thlabel">Column Count: </th>
                <td class="tdhallform" colspan="2"><input class="hallinfo" type="number" name="columncount" placeholder="Hall Name" readonly /></td>
              </tr>
              <tr>
                <th class="thlabel">Total Seat: </th>
                <td class="tdhallform" colspan="2"><input id="TotalSeat" class="hallinfo" type="number" name="totalseat" placeholder="Total Seat" readonly /></td>
              </tr>
              <tr>
                <th colspan="3"><input id="btntimeslotadd" type="submit" value="Add"/></th>
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
