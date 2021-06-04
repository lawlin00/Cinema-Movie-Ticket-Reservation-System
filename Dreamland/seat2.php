<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Select Seat",$buffer);
  echo $buffer;
  include 'SeatLayout.php';

  include  'conn.php';
  //select username,



  if (!isset($_SESSION['user'])) {
    die("<script>alert('Please Login First before proceed!'); window.location.href ='
    LoginForm.php';</script>");
  }
  else {
    $username = $_SESSION['user'];
    $MovieID = $_SESSION['Movieid'];
    $showtime = $_POST['Showtime'];
    $showtimesplit = explode("|",$showtime);
    $showdate = $showtimesplit[0];
    $starttime = $showtimesplit[1];
  }


  $checktimeslot = "SELECT * from timeslotview where MovieID = '$MovieID' and showdate = '$showdate' and starttime = '$starttime';";

  $result = mysqli_query($conn,$checktimeslot);
  if ($row = mysqli_fetch_array($result)) {
    $timeslotID = $row['TimeslotID'];
    $_SESSION['timeslotID'] = $row['TimeslotID'];
    $AdultPrice = $row['AdultPrice'];
    $ChildrenPrice = $row['ChildrenPrice'];
    $hallID = $row['HallID'];

    $sql = "SELECT * FROM booking Where TimeslotID = '$timeslotID';";
    $result2 = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result2) > 0 ){
		while ($rows = mysqli_fetch_array($result2)) {
		$SeatID[] = $rows['SeatID'];
    }
  }
  }

  if (!$result2) {
    die("<script>alert('Fail to search seat');</script>");
  }

$sqlcheckhall  = "SELECT * FROM hall Where HallID = '$hallID' ;";
$resulthall = mysqli_query($conn,$sqlcheckhall);
if ($rows2 = mysqli_fetch_array($resulthall)) {
  $SeatMap = $rows2['SeatMap'];
}
else {
  echo "<script>alert('Fail to search SeatMap. Techinical Errors.');</script>";
}


   ?>

<h1>Movie Seat Selection</h1>
<div class="container" style="margin-bottom:20px;">
  <div class="w3le-reg">
  <div class="mr_agilemain">
    <div id="SeatOptionform">

    <table id="SeatOptiontable">
      <tr class="SeatOption">
        <th class="SeatOption" colspan="2">Number of Seats</th>
      </tr>
      <tr>
        <td class="SeatOption1">Adults (RM<?php echo $AdultPrice;  ?>) : </td>
        <td class="SeatOption2"><input type="number" id="adultseat" value="0" min="0" max="10"/></td>
      </tr>
      <tr>
        <td class="SeatOption1">Children (RM<?php echo $ChildrenPrice;  ?>) : </td>
        <td class="SeatOption2"><input type="number" id="childseat" value="0" min="0" max="10"/></td>
      </tr>

    </table>
  </div>
  </div>


  <button onclick="takeData();totalseat()" >Start Selecting</button>
  <button onclick="reset();">Reset</button>
  <label>Number of Seats: </label>
  <input id="TotalSeat" type="text" readonly />

  <ul class="seat_w3ls">
    <li class="smallBox greenBox">Selected Seat</li>
    <li class="smallBox redBox">Reserved Seat</li>
    <li class="smallBox emptyBox">Empty Seat</li>
  </ul>

  <div class="seatStructure">
    <table id="seatsBlock">
      <p id="notification"></p>

<!-- use while loop here -->
      <?php
          $rowcount =1;
          $colcount = 0;
          $rowid =1;
          $colid=1;

   if ($SeatMap == 'Map1') {

             echo '<tr>';
             echo '<td></td>';
             echo '<td>1</td>';
             echo '<td>2</td>';
             echo '<td>3</td>';
             echo '<td>4</td>';
             echo '<td>5</td>';
             echo '<td>6</td>';
             echo '<td class="seatGap"></td>';
             echo '<td>7</td>';
             echo '<td>8</td>';
             echo '<td>9</td>';
             echo '<td>10</td>';
             echo '<td>11</td>';
             echo '<td>12</td>';
             echo '</tr>';
             $char_sequence = ['A', 'B', 'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    while ($rowcount <= 12) {

      $row_char = null;
      if(count($char_sequence) >= $rowcount && $rowcount - 1 >= 0) {
         $row_char = $char_sequence[$rowcount - 1];
      } else {
         $row_char = $rowcount;
      }

          if ($colcount == 0){
            echo "<tr>";
            echo "<td>".$row_char."</td>";

          }

          if ($colcount == 6) {
            echo "<td class='seatGap'></td>";
          }
		if (isset($SeatID)){
              if (in_array($row_char.$colid,$SeatID,true)){
                echo "<td><input type='checkbox' class='seats reserved' value='$row_char$colid' checked onclick = 'return false;'></td>'";
              }else{
                echo "<td><input type='checkbox' class='seats empty' value='$row_char$colid'></td>";
              }}
              else{
                echo "<td><input type='checkbox' class='seats empty' value='$row_char$colid'></td>";
              }

          $colcount++;
          $colid++;

          if ($colcount == 12){
            echo "</tr>";
            $colcount = 0;
            $rowcount ++;
            $rowid++;
            $colid = 1;
          }

        }
      }else {

        echo '<tr>';
        echo '<td></td>';
        echo '<td>1</td>';
        echo '<td>2</td>';
        echo '<td>3</td>';
        echo '<td class="seatGap"></td>';
        echo '<td>4</td>';
        echo '<td>5</td>';
        echo '<td>6</td>';
        echo '<td>7</td>';
        echo '<td>8</td>';
        echo '<td>9</td>';
        echo '<td class="seatGap"></td>';
        echo '<td>10</td>';
        echo '<td>11</td>';
        echo '<td>12</td>';
        echo '</tr>';
        $char_sequence = ['A', 'B', 'C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        while ($rowcount <= 12) {
              $row_char = null;
              if(count($char_sequence) >= $rowcount && $rowcount - 1 >= 0) {
                 $row_char = $char_sequence[$rowcount - 1];
              } else {
                 $row_char = $rowcount;
              }

              if ($colcount == 0){
                echo "<tr>";
                echo "<td>".($row_char)."</td>";

              }

              if ($colcount == 3 || $colcount ==9) {
                echo "<td class='seatGap'></td>";
              }
			  if (isset($SeatID)){
              if (in_array($row_char.$colid,$SeatID,true)){
                echo "<td><input type='checkbox' class='seats reserved' value='$row_char$colid' checked onclick = 'return false;'></td>'";
              }else{
                echo "<td><input type='checkbox' class='seats empty' value='$row_char$colid'></td>";
              }}
              else{
                echo "<td><input type='checkbox' class='seats empty' value='$row_char$colid'></td>";
              }
              $colcount++;
              $colid++;

              if ($colcount == 12){
                echo "</tr>";
                $colcount = 0;
                $rowcount ++;
                $rowid++;
                $colid = 1;
              }

            }
      }


        /*  echo '<td><input type="checkbox" class="seats reserved" value="A1" checked></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A2"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A3"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A4"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A5"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A6"></td>';
          echo '<td class="seatGap"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A7"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A8"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A9"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A10"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A11"></td>';
          echo '<td><input type="checkbox" class="seats empty" value="A12"></td>';*/
          //echo '</tr>';
        //}


       ?>

 <!--End While -->
      </table>
      <div class="screen">
          <h2 class="wthree">Screen this way</h2>
      </div>
      <button onclick="updateTextArea()">Confirm Selection</button>
      </div>

      <div class="displayerBoxes">
    <form action="payment.php" method="post">
        <table class="Displaytable w3ls-table" width="100%">
            <tr>
                <th>Name</th>
                <th>Adult Number</th>
                <th>Children Number</th>
                <th>Total Seats</th>
                <th>Seats</th>
            </tr>
            <tr>
                <td>
                    <textarea id="nameDisplay" name="username" placeholder="<?php echo $username;?>" readonly></textarea> <!--put username here -->
                </td>
                <td>
                    <textarea style="width:20px;" id="adultNum" name="adultNum" readonly></textarea>
                </td>
                <td>
                    <textarea style="width:20px;" id="childNum" name="childNum" readonly></textarea>
                </td>
                <td>
                    <textarea style="width:20px;" id="NumberDisplay" name="Numberofseat" readonly></textarea>
                </td>
                <td>
                    <textarea id="seatsDisplay" name="seatid" readonly></textarea>
                </td>
            </tr>
        </table>
      </div>
      <center>
      <input type="submit" value="Continues" />
      </center>
      </form>

      </div>
    </div>

      <?php include 'footer.php'; ?>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script>

      //if not enter name and num of seat, disable the section
      function onLoaderFunc(){
        $(".seatStructure *").prop("disabled",true);
        //$(".displayerBoxes *").prop("disabled",true);

      }

      function takeData() {
        var adultseatnum = parseInt($("#adultseat").val());
        var childseatnum = parseInt($("#childseat").val());
        if (($("#adultseat").val(adultseatnum))  == 0 && ($("#childseat").val(childseatnum)) == 0 ) {
          alert("Please Enter Number of Seats");
        } else { //else enable it
          $("#SeatOptionform *").prop("disabled",true);
          $(".seatStructure *").prop("disabled",false);

        }
      }

            function reset(){
              var adultseatnum = $("#adultseat").val(0);
              var childseatnum = $("#childseat").val(0);
              $("#SeatOptionform *").prop("disabled",false);
              $(".seatStructure *").prop("disabled",true);
              $("input:checked.empty").prop("checked",false);
            }

            function totalseat(){
                var adultseatnum = $("#adultseat").val();
                var childseatnum = $("#childseat").val();
                var Numseats = parseInt(adultseatnum) + parseInt(childseatnum);
                $("#TotalSeat").val(Numseats);
              }

            function updateTextArea(){
              if ($("input:checked.empty").length == $("#TotalSeat").val()){
                $(".seatStructure *").prop("disabled",true);

                //var allNameVals = [];
                var allNumberVals = [];
                var allSeatsVals = [];

                //Storing in Array
              //  allNameVals.push($("#Username").val());
                allNumberVals.push($("#TotalSeat").val());
                $('#seatsBlock :checked.empty').each(function () {
                    allSeatsVals.push($(this).val());
                });
                var adultseatnum = parseInt($("#adultseat").val());
                var childseatnum = parseInt($("#childseat").val());

                //Displaying
                //$('#nameDisplay').val(allNameVals);
                $('#NumberDisplay').val(allNumberVals);
                $('#adultNum').val(adultseatnum);
                $('#childNum').val(childseatnum);
                $('#seatsDisplay').val(allSeatsVals);
            } else {
                alert("Please select " + ($("#TotalSeat").val()) + " seats")
            }
              }

              function myFunction() {
                  alert($("input:checked").length);
              }

              $(":checkbox").click(function () {
                  if ($("input:checked.empty").length == ($("#TotalSeat").val())) {
                      $(":checkbox").prop('disabled', true);
                      $(':checked').prop('disabled', false);
                  } else {
                      $(":checkbox").prop('disabled', false);
                  }
              });

      </script>
