<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Hall",$buffer);
  echo $buffer;
  include 'LayoutAdmin2.php';

  ?>
  <h1 class="h1title">Hall List</h1>
  <center style="margin-bottom:10px;">
    <div class="option">
      <a href=AddHall.php><button class="add" type="button"><i class="material-icons" style="font-size:18px; padding-right:5px;">add</i>Add Hall</button></a>
    </div>
    <div class="container2">
      <div id="HallInfo">
        <div>
        <table class="tblHall">
          <tr>
            <th class="thlabel2">Hall ID</th>
            <th class="thlabel2">Hall Name</th>
            <th class="thlabel2"> </th>
          </tr>

          <?php
            include 'conn.php';
            $sql = "SELECT * FROM hall";
            $result = mysqli_query($conn,$sql);

            if (mysqli_num_rows($result)<=0){
              echo "<script>alert('No Hall added! Please add new hall.');</script>";;

            }

            while ($rows = mysqli_fetch_array($result)) {
              echo "<tr>";
              echo "<td class = 'tdinfo'>".$rows['HallID']."</td>";
              echo "<td class = 'tdinfo'>".$rows['HallName']."</td>";
              echo "<td class='tdinfo'><a href='edithall.php?id=".$rows['HallID']."'><button class='tdbtn'>Edit</button></a><br />".
              "<a href = 'deletehall.php?id=".$rows['HallID']."'><button class = 'tdbtn'  onclick =\"return confirm('Do you really want to delete the information?');\">Delete</button></a></td>";
              echo "</tr>";
            }

           ?>

        </table>
        </div>
      </div>
    </div>
  </center>
</div>
<?php include 'footer.php'; ?>
