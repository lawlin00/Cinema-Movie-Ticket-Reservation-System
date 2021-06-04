<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Admin Movie",$buffer);
  echo $buffer;
  include 'LayoutAdmin.php'; ?>


    <div id="AdminMovie">
      <legend>
        Movie Information
      </legend>
      <div class="option">
      <a href="AddMovieForm.php"><button class="add" type="button"><i class="material-icons" style="font-size:18px; padding-right:5px;">add</i>Add Movie</button></a>
      <div class="adminmoviesearch">
        <form action="searchmovie.php" method="post">
          <input class="admoviesearch" type="text" placeholder="Search Movie..." name="searchkey" />
          <button class="btniconsearch" type="submit"><i class = "fa fa-search"></i></button>
          <?php
              include 'conn.php';

              $searchkey= isset($_POST['searchkey'])?
              $_POST['searchkey']:'';

              if ($searchkey == NULL){
  //              $sql="SELECT * FROM movie";
    //            $result = mysqli_query($conn,$sql);
//
  //              if(mysqli_num_rows($result)<=0){
  //                die("<script>alert('Please add movie information!')</script>");

                  echo "<script>window.location.href = 'AdminMovie.php';</script>";
                }

              else {
                $sql="SELECT * FROM movie Where MovieTitle LIKE '%".$searchkey."%'";
                $result = mysqli_query($conn,$sql);

                if (mysqli_num_rows($result) <=0){
                    echo "<script>alert('No Result!');</script>";
                    echo "<script>window.location.href = 'AdminMovie.php';</script>";
                }
                else {
                  echo "</div>";
                  echo  "</div>";
                  echo  "<center>";
                  echo  "<table id='tblAdminMovie'>";
                  echo  "<tr>";
                  echo  "<th>Image</th>";
                  echo  "<th>Title</th>";
                  echo  "<th>Running Time</th>";
                  echo  "<th>Status</th>";
                  echo  "</tr>";

                  //read from database and put into table
                  while ($rows = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td class = 'tdinfo' rowspan  ='3'><img class='imgmovie' src='".$rows['MovieImgPath']." '/></td>";
                    echo "<td class = 'tdinfo' rowspan  ='3'>".$rows['MovieTitle']."</td>";
                    echo "<td class = 'tdinfo' rowspan  ='3'>".$rows['MovieRunningTime']."</td>";
                    echo "<td class = 'tdinfo2'><a href = 'EditMovieForm.php?id=".$rows['MovieID']."'><button class = 'tdbtn'>Edit</button></a></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td class = 'tdinfo2'><a href = 'deletemovie.php?id=".$rows['MovieID']."'><button class = 'tdbtn'>Delete</button></a><br /></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td class = 'tdinfo3'><a href = 'Showtime2.php?id=".$rows['MovieID']."'><button class = 'tdbtn'>Showtime</button></a></td>";
                    echo "</tr>";
                  }


                  echo "</table>";
                }

              }

           ?>
        </form>
      </center>
    </div>




  </center>
<?php include 'footer.php'; ?>
