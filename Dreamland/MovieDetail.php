<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Dreamland",$buffer);
  echo $buffer;
  include 'Layout2.php';
  $id = $_GET['id'];
  include 'conn.php';

  $sql = "SELECT * FROM timeslotview WHERE MovieID = $id order by showdate asc;";
  $result = mysqli_query($conn,$sql);

  if ($rows = mysqli_fetch_array($result)) {
    if ($rows['MovieStatus'] == 1) {
      $Title = $rows['MovieTitle'];
      $Genre = $rows['MovieGenre'];
      $ReleaseDate = $rows['MovieReleaseDate'];
      $Director = $rows['MovieDirector'];
      $Distributor = $rows['MovieDistributor'];
      $Language = $rows['MovieLanguage'];
      $Subtitle = $rows['MovieSubtitle'];
      $RuntimeMinute = $rows['MovieRunningTime'];
      $Showdate = $rows['showdate'];
      $StartTime = $rows['starttime'];
      $ImgPath = $rows['MovieImgPath'];
      $Description = $rows['MovieDescription'];
      $showtime = $Showdate." ".$StartTime;
      $_SESSION['Movieid'] = $rows['MovieID'];
    }
  }
  else {

    echo "<script>alert('No information about the movie or showtime! Technical Errors.');</script>'";

  }

  ?>

  <div class="MDImage">
      <div class="MDimgdiv">
        <img class="MDimg" src="<?php echo $ImgPath; ?>" alt="img" />
      </div>
  </div>

  <div class="Overview">
    <h1 class="Title"><?php echo $Title; ?></h1><br />
    <div class="Overview-content">
    <h1 class="Overview-title">Overview</h1><br />
    <p class="Overview-subtitle">Synopsis:</p><br />
    <p class="Overview-desc">
      <?php echo $Description; ?>
    </p>
    <table class="Overview-table">
      <tr>
        <th class="MDth">Title</th>
        <th class="MDth">: </th>
        <td class="MDtd"><?php echo $Title; ?></td>
      </tr>
      <tr>
        <th class="MDth">Genre </th>
        <th class="MDth">: </th>
        <td class="MDtd"><?php echo $Genre; ?></td>
      </tr>
      <tr>
        <th class="MDth">Release Date </th>
        <th class="MDth">: </th>
        <td class="MDtd"><?php echo $ReleaseDate; ?></td>
      </tr>
      <tr>
        <th class="MDth">Director </th>
        <th class="MDth">: </th>
        <td class="MDtd"><?php echo $Director; ?></td>
      </tr>
      <tr>
        <th class="MDth">Distributor </th>
        <th class="MDth">: </th>
        <td class="MDtd"><?php echo $Distributor; ?></td>
      </tr>
      <tr>
        <th class="MDth">Language </th>
        <th class="MDth">: </th>
        <td class="MDtd"><?php echo $Language; ?></td>
      </tr>
      <tr>
        <th class="MDth">Subtitle </th>
        <th class="MDth">: </th>
        <td class="MDtd"><?php echo $Subtitle; ?></td>
      </tr>
      <tr>
        <th class="MDth">Runtime Minutes </th>
        <th class="MDth">: </th>
        <td class="MDtd"><?php echo $RuntimeMinute; ?></td>
      </tr>

    </table>
    </div>
  </div>

  <div class="Overview">
    <div class="Overview-content">
    <h1 class="Overview-title">Showtime</h1>
    <form method="post" action="seat2.php?id=<?php echo $_SESSION['Movieid'];?>" id="ShowtimeForm">
    <select class="cmbshowtime" name="Showtime">
      <option value="Please Select">Please Select</option>

      <?php


          echo "<option value='".$rows['showdate']."|".$rows['starttime']."'>".$rows['showdate']." ".$rows['starttime']."</option>";
           while ($rows = mysqli_fetch_array($result)) {
             echo "<option value='".$rows['showdate']."|".$rows['starttime']."'>".$rows['showdate']." ".$rows['starttime']."</option>";

            }

        //https://stackoverflow.com/questions/3245967/can-an-option-in-a-select-tag-carry-multiple-values
          //$value = filter_input(INPUT_POST ,'Showtime');
          //$explode_value = explode('|', $value);
          //$value1 = $explode_value[0];
          //$value2 = $explode_value[1];

       ?>
    </select><br />
    <button class="btnPurchases" type="submit" form="ShowtimeForm" value="submit" >Purchase</button>
    </form>

    </div>
  </div>
<?php include 'footer.php'; ?>
