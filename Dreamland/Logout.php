<?php

  session_start();

  echo "<script>alert('You already logged out! Thank you. ".$_SESSION['user']."!');</script>";

  session_destroy();
  echo "<script>window.location.href='LoginForm.php'</script>";

  ?>
