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
  $sql = "SELECT * FROM seat Where MovieID = '$MovieID' AND timeslotID1 = '$timeslotID'  Order By RowID, ColumnID;";
  $result2 = mysqli_query($conn,$sql);
  }

  if (!$result2) {
    die("<script>alert('Fail to search Seat');</script>");
  }


   ?>

<h1>Movie Seat Selection</h1>
<div class="container">
  <div class="w3le-reg">
  <div class="mr_agilemain">
    <form id="SeatOptionform">
    <table id="SeatOptiontable">
      <tr class="SeatOption">
        <th class="SeatOption" colspan="2">Number of Seats</th>
      </tr>
      <tr>
        <td class="SeatOption1">Adults: </td>
        <td class="SeatOption2"><input type="number" id="adultseat" value="0" min="0" max="10"/></td>
      </tr>
      <tr>
        <td class="SeatOption1">Children: </td>
        <td class="SeatOption2"><input type="number" id="childseat" value="0" min="0" max="10"/></td>
      </tr>
    </table>
  </form>
  </div>

  <button onclick="takeData();totalseat();">Start Selecting</button>
  <button onclick="reset()">Reset</button>
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
      <tr>
        <td></td>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td class="seatGap"></td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
      </tr>
<!-- use while loop here -->
      <?php
          $count = 0;
        while ($rows = mysqli_fetch_array($result2)) {
          $Status = $rows['Status'];
          $RowID = $rows['RowID'];
          $ColumnID = $rows['ColumnID'];

          if ($count == 0){
            echo "<tr>";
            echo "<td>".$RowID."</td>";
          }

          if ($count == 6) {
            echo "<td class='seatGap'></td>";
          }

          if ($Status == 0) {
            echo "<td><input type='checkbox' class='seats empty' value='".$RowID.$ColumnID."'></td>";
          }
          else{
            echo "<td><input type='checkbox' class='seats reserved' value='' checked></td>'";
          }
          $count++;

          if ($count == 12){
            echo "</tr>";
            $count = 0;
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
        }


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
                <th>Number of Seats</th>
                <th>Seats</th>
            </tr>
            <tr>
                <td>
                    <textarea id="nameDisplay" name="username" placeholder="<?php echo $username;?>"></textarea> <!--put username here -->
                </td>
                <td>
                    <textarea id="NumberDisplay" name="Numberofseat"></textarea>
                </td>
                <td>
                    <textarea id="seatsDisplay" name="seatid"></textarea>
                </td>
            </tr>
        </table>
      </div>
      <center>
        <button>Continues</button>
      </center>
      </form>

      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script>

      //if not enter name and num of seat, disable the section
      function onLoaderFunc(){
        $(".seatStructure *").prop("disabled",true);
        $(".displayerBoxes *").prop("disabled",true);

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

                //Displaying
                //$('#nameDisplay').val(allNameVals);
                $('#NumberDisplay').val(allNumberVals);
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
      </body>
