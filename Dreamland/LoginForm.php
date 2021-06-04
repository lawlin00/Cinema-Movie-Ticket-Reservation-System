<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Login",$buffer);
  echo $buffer;
  include 'Layout.php'; ?>

<div id="LoginMain">
  <div class="login">
    <form id="Form" action="Login.php" method="POST">
      <fieldset>
        <legend>Login to Your Account</legend>
        <img src="Image/Login.png" class="imglogin" alt="Login"/>
        <p class="instruction">Please enter username and password.</p>
        <input type="text" name="username" placeholder="Username" required/><br />
        <input type="password" name="password" placeholder="Password" required/><br />
        <a href="SignUpForm.php" class="register">Don't have account? Register Here.</a><br />
        <button type="button" id="forgotpsw" class="register" style="background:none;border:none;padding:0px;" onclick="alertmsg()">Forget Password?</button>
        <br />
        <input id="LoginSubmit" type="submit" value="Login" />
      </fieldset>
    </form>
  </div>

</div>


<script>
  function alertmsg() {
    alert("Please Email with your contact number to dreamlandfeedback@gmail.com to request change password! Thank you!");
  }

</script>
<?php include 'footer.php'; ?>
