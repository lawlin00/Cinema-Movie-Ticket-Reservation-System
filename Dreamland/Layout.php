<?php
session_start()
 ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Layout.css" type="text/css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>

  <div id="sidenavbar" class="sidenav">
    <div class="sidebtnlogo">
    <button class="btnmenu" onclick="closeNav()"><i class="fa fa-bars"Menu></i></button>
    <a href="Home.php"><img src="Image/Logo4.png" class="sidelogo" alt="Logo"/></a>

    </div>
    <div class="sidemenu">
      <a href="Home.php">Home</a><br />
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
    <ul>
      <button class="btnmenu" onclick="openNav()"><i class="fa fa-bars"Menu></i></button>
      <a href="#Home"><img src="Image/Logo4.png" class="logo" alt="Logo"/></a>
      <?php
          if (isset($_SESSION['user'])){
            echo "<li><a href = 'userprofile.php'>My Profile</a></li>";
            echo "<li><a href = 'Logout.php'>Logout</a></li>";

          }
          else{
            echo "<li><a href = 'LoginForm.php'>Login</a></li>";
            echo "<li><a href = 'SignUpForm.php'>Sign Up</a></li>";
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
