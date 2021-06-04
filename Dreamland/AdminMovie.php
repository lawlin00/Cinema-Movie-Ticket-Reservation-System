<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Admin Movie",$buffer);
  echo $buffer;
  include 'LayoutAdmin.php'; ?>


    <div id="AdminMovie" style="height:auto;">
      <legend>
        Movie Information
      </legend>
      <div class="option">
      <a href="AddMovieForm.php"><button class="add" type="button"><i class="material-icons" style="font-size:18px; padding-right:5px;">add</i>Add Movie</button></a>
      <div class="adminmoviesearch">
        <form action="searchmovie.php" method="post">
          <input class="admoviesearch" type="text" placeholder="Search Movie..." name="searchkey" />
          <button class="btniconsearch" type="submit"><i class = "fa fa-search"></i></button>
        </form>

      </div>
      <form action="" method="post" id="moviestatus">
        <select class="cmbactivation" name="status" onchange="moviestatus.submit()">
          <option value="">Select Movie Status</option>
          <option value="All">All</option>
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </form>

      </div>
      <center>
        <table id="tblAdminMovie">
          <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Running Time</th>
            <th>Status</th>
          </tr>

          <?php

          include 'conn.php';
              if (!isset($_POST['status'])) {
                $sql="SELECT * FROM movie;";
              }
              elseif ($_POST['status'] == 'Active') {
                $sql="SELECT * FROM movie Where MovieStatus = '1';";
              }
              elseif ($_POST['status'] == 'Inactive') {
                $sql="SELECT * FROM movie Where MovieStatus = '0';";
              }
              else{
                $sql="SELECT * FROM movie;";
              }

              $result = mysqli_query($conn,$sql);

              if(mysqli_num_rows($result)<=0){
                die("<script>alert('Please add movie information!')</script>");
              }

              while ($rows = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td class = 'tdinfo' rowspan  ='3'><img class='imgmovie' src='".$rows['MovieImgPath']." '/></td>";
                echo "<td class = 'tdinfo' rowspan  ='3'>".$rows['MovieTitle']."</td>";
                echo "<td class = 'tdinfo' rowspan  ='3'>".$rows['MovieRunningTime']."</td>";
                echo "<td class = 'tdinfo2'><a href = 'EditMovieForm.php?id=".$rows['MovieID']."'><button class = 'tdbtn'>Edit</button></a></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class = 'tdinfo2'><a href = 'deletemovie.php?id=".$rows['MovieID']."'><button class = 'tdbtn'  onclick =\"return confirm('Do you really want to delete the information?');\">Delete</button></a><br /></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class = 'tdinfo3'><a href = 'showtime2.php?id=".$rows['MovieID']."'><button class = 'tdbtn'>Showtime</button></a></td>";
                echo "</tr>";
              }

           ?>

        </table>
      </center>
    </div>
    <?php include 'footer.php'; ?>
