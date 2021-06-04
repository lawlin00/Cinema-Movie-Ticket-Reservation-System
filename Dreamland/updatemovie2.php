<?php

  include 'conn.php';

  $id = $_POST['movieid'];
  $title = $_POST['movietitle'];
  $desc = $_POST['moviedesc'];
  $director = $_POST['moviedirector'];
  $distributor = $_POST['moviedistributor'];
  $releasedate = $_POST['moviereleasedate'];
  $genre = $_POST['moviegenre'];
  $language = $_POST['movielanguage'];
  $subtitle = $_POST['moviesubtitle'];
  $runtime = $_POST['movieruntime'];
  $ticket = $_POST['movieticket'];
  $img = $_FILES['movieimg']['name'];

  $target_dir = "uploadsmovie/"; //specifies the directory where the file is going to be placed
  $target_file = $target_dir .basename($_FILES["movieimg"]["name"]); //specific path of the file to be uploaded
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //set extention to lower case

  if ($img !="") {
    $check = getimagesize($_FILES["movieimg"]["tmp_name"]);
    if($check !== false){
      echo "<script>alert('File is an image -". $check["mime"]."');</script>";
      $uploadOk =1;
    }
    else {
      echo "<script>alert('File is not an image. Please try again!');</script>";
      //die ("<script>window.history.go(-1);</script>");
      $uploadOk =0;
    }

    //check is the file repeat
    if (file_exists($target_file)){
      echo "<script>alert('Sorry, file already exists.');</script>";
      //die ("<script>window.history.go(-1);</script>");
      $uploadOk = 0;
    }
    //check file type
    if($imageFileType !="jpg" && $imageFileType !="jpeg" && $imageFileType !="png" & $imageFileType !="gif"){
      echo "<script>alert('Sorry, only allowed JPG, JPEG, PNG and GIF files.');</script>";
      $uploadOk=0;
    }

    If ($uploadOk == 0){
      echo "<script>alert('Sorry, your files was not uploaded.');</script>";
      //die ("<script>window.history.go(-1);</script>");
    }
    else {
      if(move_uploaded_file($_FILES["movieimg"]["tmp_name"],$target_file)){
        echo "<script>alert('The file". basename($_FILES["movieimg"]["name"])."has been uploaded.');</script>'";
      }
      else {
        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        //die ("<script>window.history.go(-1);</script>");
      }
    }

    $sql = "Update movie SET ".
    "MovieTitle = '$title',".
    "MovieDescription = '$desc',".
    "MovieDirector = '$director',".
    "MovieDistributor = '$distributor',".
    "MovieReleaseDate = '$releasedate',".
    "MovieGenre = '$genre',".
    "MovieLanguage = '$language',".
    "MovieSubtitle = '$subtitle',".
    "MovieRunningTime = '$runtime',".
    "MovieTicketNum = '$ticket',".
    "MovieImgPath = '$target_file' WHERE MovieID = $id";
  }
  else {

      $sql = "Update movie SET ".
      "MovieTitle = '$title',".
      "MovieDescription = '$desc',".
      "MovieDirector = '$director',".
      "MovieDistributor = '$distributor',".
      "MovieReleaseDate = '$releasedate',".
      "MovieGenre = '$genre',".
      "MovieLanguage = '$language',".
      "MovieSubtitle = '$subtitle',".
      "MovieRunningTime = '$runtime',".
      "MovieTicketNum = '$ticket' WHERE MovieID = $id";
  }

  //check if image file is a actual img





  mysqli_query($conn,$sql);
//if the connection database affected rows <=0, alert msg
  if (mysqli_affected_rows($conn)<=0){
      echo "<script>alert('Cannot Update Data!');</script>";
      //die ("<script>window.location.href='EditMovieForm.php?id=$id';</script>");
  }
  else {
    echo "<script>alert('Successfully update data!');</script>";
  //  echo "<script>window.location.href = 'AdminMovie.php'</script>";
  }


 ?>
