<?php

    $title = $_POST['movietitle'];
    $desc = $_POST['moviedesc'];
    $director = $_POST['moviedirector'];
    $distributor = $_POST['moviedistributor'];
    $releasedate = $_POST['moviereleasedate'];
    $genre = $_POST['moviegenre'];
    $language = $_POST['movielanguage'];
    $subtitle = $_POST['moviesubtitle'];
    $runtime = $_POST['movieruntime'];
    $status = $_POST['moviestatus'];


    include 'conn.php';

    $target_dir = "uploadsmovie/"; //specifies the directory where the file is going to be placed
    $target_file = $target_dir .basename($_FILES["movieimg"]["name"]); //specific path of the file to be uploaded
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //set extention to lower case

    //check if image file is a actual img
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
      die ("<script>window.history.go(-1);</script>");
      $uploadOk = 0;
    }
    //check file type
    if($imageFileType !="jpg" && $imageFileType !="jpeg" && $imageFileType !="png" & $imageFileType !="gif"){
      echo "<script>alert('Sorry, only allowed JPG, JPEG, PNG and GIF files.');</script>";
      $uploadOk=0;
    }

    If ($uploadOk == 0){
      echo "<script>alert('Sorry, your files was not uploaded.');</script>";
      die ("<script>window.history.go(-1);</script>");
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

    $sql = "INSERT INTO movie (MovieTitle,MovieGenre,MovieDescription,MovieDirector,MovieReleaseDate,MovieDistributor,MovieSubtitle,MovieLanguage,MovieRunningTime,MovieImgPath,MovieStatus) VALUES ".
    "('$title','$genre','$desc','$director','$releasedate','$distributor','$subtitle','$language','$runtime','$target_file','$status');";

    mysqli_query($conn,$sql);

    if (mysqli_affected_rows($conn)<=0){
      var_dump($sql);
      echo "<script>alert('Unable to add information! Please try again.');</script>";
//      die("window.history.go(-1);</script>");
    }
    else {
      echo "<script>alert('Added Successfully.');";
      echo "window.location.href = 'AdminMovie.php';</script>";
    }

 ?>
