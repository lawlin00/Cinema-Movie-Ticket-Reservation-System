<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Edit Movie Details",$buffer);
  echo $buffer;
  include 'LayoutAdmin.php'; ?>

  <?php
  include 'conn.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM movie WHERE MovieID = $id";
  $result = mysqli_query($conn,$sql);

  if ($rows = mysqli_fetch_array($result)) {
    $title = $rows['MovieTitle'];
    $desc = $rows['MovieDescription'];
    $director = $rows['MovieDirector'];
    $distributor = $rows['MovieDistributor'];
    $releasedate = $rows['MovieReleaseDate'];
    $genre = $rows['MovieGenre'];
    $language = $rows['MovieLanguage'];
    $subtitle = $rows['MovieSubtitle'];
    $runtime = $rows['MovieRunningTime'];
    $status = $rows['MovieStatus'];
    $img = $rows['MovieImgPath'];
  }
  else {
    echo"<script>alert('No data from db!Technical errors!');</script>";
    die ("<script>window.location.href='AdminMovie.php';</script>");
  }
   ?>


  <div class="main" style="height:auto;">
      <center>
    <div id="AddMovieForm">
      <form class="NewMovie" action="updatemovie.php" method="post" enctype="multipart/form-data">
        <center>
        <fieldset>
          <legend>
            Edit Movie Details
          </legend>
          <table id="movieform">
            <tr>
              <th class="thmovie">MovieID</th>
              <td><input class="movieinfo" type="text" name="movieid"  value="<?php echo $id;?>" required /></td>
            </tr>
            <tr>
              <th class="thmovie">Title</th>
              <td><input class="movieinfo" type="text" name="movietitle"  value="<?php echo $title;?>" required /></td>
            </tr>
            <tr>
              <th class="thmovie">Description: </th>
              <td><textarea id="moviedesc" name="moviedesc" rows="5" cols="70" required><?php echo $desc;?></textarea></td>
            </tr>
            <tr>
              <th class="thmovie">Director: </th>
              <td><input class="movieinfo" type="text" name="moviedirector"   value="<?php echo $director;?>" required/></td>
            </tr>
            <tr>
              <th class="thmovie">Distributor: </th>
              <td><input class="movieinfo" type="text" name="moviedistributor" value="<?php echo $distributor;?>" required /></td>
            </tr>
            <tr>
              <th class="thmovie">Release Date: </th>
              <td><input class="movieinfo" type="date" name="moviereleasedate" value="<?php echo $releasedate;?>" required/></td>
            </tr>
            <tr>
              <th class="thmovie">Genre: </th>
              <td>
                <select class="cmbmovieinfo" name="moviegenre">
                  <option value="Please Select">Please Select</option>
                  <option value="Action" <?php if ($genre == "Action") echo "selected ='selected'"; ?>>Action</option>
                  <option value="Anime" <?php if ($genre == "Anime") echo "selected ='selected'"; ?>>Anime</option>
                  <option value="Drama" <?php if ($genre == "Drama") echo "selected ='selected'"; ?>>Drama</option>
                  <option value="Horror" <?php if ($genre == "Horror") echo "selected ='selected'"; ?>>Horror</option>
                </select>
            </td>
          </tr>
            <tr>
              <th class="thmovie">Language: </th>
              <td>
                <select class="cmbmovieinfo" name="movielanguage" value="<?php echo $language;?>">
                  <option value="Please Select">Please Select</option>
                  <option value="English" <?php if ($language == "English") echo "selected ='selected'"; ?>>English</option>
                  <option value="Malay" <?php if ($language == "Malay") echo "selected ='selected'"; ?>>Malay</option>
                  <option value="Chinese" <?php if ($language == "Chinese") echo "selected ='selected'"; ?>>Chinese</option>
                  <option value="Japanese" <?php if ($language == "Japanese") echo "selected ='selected'"; ?>>Japanese</option>
                </select>
              </td>
            </tr>
            <tr>
              <th class="thmovie">Subtitle: </th>
              <td><input class="movieinfo" type="text" name="moviesubtitle" value="<?php echo $subtitle;?>" required /></td>
            </tr>
            <tr>
              <th class="thmovie">Runtime Minutes: </th>
              <td><input class="movieinfo" type="number" name="movieruntime" value="<?php echo $runtime;?>"required /></td>
            </tr>
            <tr>
              <th class="thmovie">Movie Status: </th>
              <td>
                <select name="moviestatus" class="cmbmovieinfo">
                  <option value="1" <?php if ($status == "1") echo "selected ='selected'"; ?>>Active</option>
                  <option value="0" <?php if ($status == "0") echo "selected ='selected'"; ?>>Inactive</option>
                </select>
              </td>
            </tr>
            <tr>
              <th class="thmovie">Upload Image: </th>
              <td id="tdfile"><input type="file" name="movieimg" value = <?php echo $img; ?> /><img src="<?php echo $img; ?>" width="100px" height="80px"></td>
            </tr>
            <tr>
              <td colspan="2"><input id="btnmovieadd" type="submit" value="Save"/></td>
            </tr>
          </table>

        </fieldset>
        </center>
      </form>
    </div>
      </center>
</div>
      <?php include 'footer.php'; ?>
