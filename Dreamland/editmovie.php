<?php
include 'conn.php';
$id = $_GET['id'];
$sql = "SELECT * FROM movie WHERE MovieID = $id";
$result = mysqli_query($conn,$sql);

if ($rows = mysqli_fetch_array($result)) {
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
  $status = $_POST['moviestatus'];
}
else {
  echo"<script>alert('No data from db!Technical errors!');</script>";
  die ("<script>window.location.href='AdminMovie.php';</script>");
}



 ?>
