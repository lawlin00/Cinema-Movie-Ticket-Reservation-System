<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Dreamland",$buffer);
  echo $buffer;
  include 'Layout2.php';
  include 'conn.php';
    $searchkey= isset($_POST['csearch'])?
    $_POST['csearch']:'';

if ($searchkey == NULL){
  echo "<script>alert('Please key in your search key first!');window.location.href = 'Home.php';</script>";
}
else {
  $sql = "SELECT * FROM movie WHERE MovieStatus = '1' And MovieTitle Like  '%".$searchkey."%' order by MovieTitle asc;";
  $result = mysqli_query($conn,$sql);
//  var_dump($sql);
}
?>


<center><h1 class="title">Now Showing</h1></center>
<div class="search">
<center>
<form action="search.php" method="post">
<input type="text" name="csearch" placeholder="Search" class="PaymentDetails" style="border:1px solid white;margin-top:30px;"/>
<button class="Search" value="submit">Search</button>
</form>
</center>
</div>
<div class="container">


  <div class="grid-container">
    <?php

      if (mysqli_num_rows($result)<=0){
        echo "<script>alert('No results! Please Search Again!');window.location.href = 'Home.php'</script>";
      }

      while ($rows = mysqli_fetch_array($result)) {
        echo "<div class='boximg'>";
        echo "<div>";
        echo "<a href = 'MovieDetail.php?id=".$rows['MovieID']."'><img class='imghome' src='".$rows['MovieImgPath']."' alt='".$rows['MovieImgPath']."' /></a>";
        echo "</div>";
        echo "<div class='boxcontent'>";
        echo "<p class='boxtitle'>".$rows['MovieTitle']."</p>";
        echo "</div>";
        echo "</div>";
      }

     ?>
</div>
</div>

 <?php include 'footer.php'; ?>
