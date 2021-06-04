<?php
session_start()
 ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="SeatLayout.css" type="text/css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body onload="onLoaderFunc()">
  <div id="sidenavbar" class="sidenav">
    <div class="sidebtnlogo">
    <button class="btnmenu" onclick="closeNav()"><i class="fa fa-bars"Menu></i></button>
    <a href="Home.php"><img src="Image/Logo4.png" class="sidelogo" alt="Logo"/></a>
    </div>
    <div class="sidemenu">
      <a href="Home.php">Home</a><br />
      <a href="Home.php">Movie</a><br />
      <?php
          if (isset($_SESSION['user'])){
            echo "<li class='menu2'><a href = 'Logout.php'>Logout</a></li>";
          }
          else{
            echo "<li class='menu2'><a href = 'LoginForm.php'>Login</a></li>";
            die("<script>alert('Please Login First before proceed!'); window.location.href ='LoginForm.php';</script>");
          }

       ?>
      <?php
      if (isset($_SESSION['role'])) {
          if ($_SESSION['role']==="0") {
            echo "<a href = 'AdminMovie.php'>AdminMovie</a><br />";
          }
      }
          if (isset($_SESSION['user'])){
            echo "<a href = 'Logout.php'>Logout</a><br />";
          }
          else{
            echo "<a href = 'LoginForm.php'>Login</a><br />";
            echo "<a href = 'SignUpForm.php'>Sign Up</a><br />";
          }

       ?>
    </div>
  </div>

  <div class="header">
    <ul class="menu">
      <button class="btnmenu" onclick="openNav()"><i class="fa fa-bars"Menu></i></button>
      <a href="Home.php"><img src="Image/Logo4.png" class="logo" alt="Logo"/></a>

       <?php
           if (isset($_SESSION['user'])){
             echo "<li class='menu'><a href = 'Logout.php'>Logout</a></li>";
              echo "<li class='menu'><a href = 'userprofile.php'>My Profile</a></li>";

           }
           else{
             echo "<li class='menu'><a href = 'LoginForm.php'>Login</a></li>";
             echo "<li class='menu'><a href = 'SignUpForm.php'>Sign Up</a></li>";
           }

        ?>



    </ul>
  </div>



<script>

  function openNav() {
    document.getElementById("sidenavbar").style.width = "250px";
  }

  function closeNav(){
    document.getElementById("sidenavbar").style.width = "0";
  }

</script>
