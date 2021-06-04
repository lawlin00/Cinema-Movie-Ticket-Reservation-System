<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Add Movie",$buffer);
  echo $buffer;
  include 'LayoutAdmin.php'; ?>


  <div class="main" style="height:auto;">
      <center>
    <div id="AddMovieForm">
      <form class="NewMovie" action="insertmovie.php" method="post" enctype="multipart/form-data">
          <center>
        <fieldset>
          <legend>
            Add New Movie
          </legend>
          <table id="movieform">
            <tr>
              <th class="thmovie">Title</th>
              <td><input class="movieinfo" type="text" name="movietitle" placeholder="Title of the Movie" required /></td>
            </tr>
            <tr>
              <th class="thmovie">Description: </th>
              <td><textarea id="moviedesc" name="moviedesc" rows="5" cols="70" placeholder="Please enter some description about the movie..." required></textarea></td>
            </tr>
            <tr>
              <th class="thmovie">Director: </th>
              <td><input class="movieinfo" type="text" name="moviedirector"  placeholder="MovieDirector" required/></td>
            </tr>
            <tr>
              <th class="thmovie">Distributor: </th>
              <td><input class="movieinfo" type="text" name="moviedistributor" placeholder="Distributor" required /></td>
            </tr>
            <tr>
              <th class="thmovie">Release Date: </th>
              <td><input class="movieinfo" type="date" name="moviereleasedate" required/></td>
            </tr>
            <tr>
              <th class="thmovie">Genre: </th>
              <td>
                <select class="cmbmovieinfo" name="moviegenre">
                  <option value="Please Select">Please Select</option>
                  <option value="Action">Action</option>
                  <option value="Anime">Anime</option>
                  <option value="Drama">Drama</option>
                  <option value="Horror">Horror</option>
                </select>
            </td>
          </tr>
            <tr>
              <th class="thmovie">Language: </th>
              <td>
                <select class="cmbmovieinfo" name="movielanguage">
                  <option value="Please Select">Please Select</option>
                  <option value="English">English</option>
                  <option value="Malay">Malay</option>
                  <option value="Chinese">Chinese</option>
                  <option value="Japanese">Japanese</option>
                </select>
              </td>
            </tr>
            <tr>
              <th class="thmovie">Subtitle: </th>
              <td><input class="movieinfo" type="text" name="moviesubtitle" placeholder="Subtitle" required /></td>
            </tr>
            <tr>
              <th class="thmovie">Runtime Minutes: </th>
              <td><input class="movieinfo" type="number" name="movieruntime" placeholder="Running time" required /></td>
            </tr>
            <tr>
              <th class="thmovie">Movie Status: </th>
              <td>
                <select name="moviestatus" class="cmbmovieinfo">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </td>
            </tr>
            <tr>
              <th class="thmovie">Upload Image: </th>
              <td id="tdfile"><input type="file" name="movieimg" required /></td>
            </tr>
            <tr>
              <td colspan="2"><input id="btnmovieadd" type="submit" value="Add"/></td>
            </tr>
          </table>
        </fieldset>
      </form>
      </center>
    </div>
    </center>
    </div>

    <?php include 'footer.php'; ?>
