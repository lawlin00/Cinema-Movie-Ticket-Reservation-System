<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","Sign Up",$buffer);
  echo $buffer;
  include 'Layout.php'; ?>

<div class="main" style="height:auto;">
  <div class="registerform">
    <Form id="Form" action="SignUp.php" method="POST">
      <fieldset>
        <legend>Sign Up</legend>
        <p class="instruction">Please fill in this form to create an acoount.</p>
        <p class="section">Section 1 - Basic Information</p>
        <input type="text" name="name" placeholder="Full Name" required /><br />
        <input type="email" name="email" placeholder="Email Address" required /><br />
        <input type="tel" name="contact" placeholder="Contact Number" onKeyPress="if(this.value.length==10) return false;" pattern="+60-[0-9]{2}-[0-9]{4}-[0-9]{3}" required /><br />
        <input type="text" name="ic" onKeyPress="if(this.value.length==12) return false;" placeholder="New IC Number" required /><br />
        <label id="lbldob">Date of Birth: </label>
        <input type="date" name="dob" placeholder="Date of Birth" required />
        <label id="lblgender">Gender: </label>
        <input type="radio" name="gender" value="Male"  /><p class="radioselection">Male</p>
        <input type="radio" name="gender" value="Female"  /><p class="radioselection">Female</p>
        <hr />
        <p class="section">Section 2 - Login Detail</p>
        <input type="text" name="username" placeholder="Username" title="Please Enter your desire username" required/><br />
        <input type="password" name="password" pattern=".{8-64}" title="Minimum 8 characters or number" placeholder="Password" required/><br />
        <input type="password" name="confirmpsw" pattern=".{8-64}" title="Minimum 8 characters or number" placeholder="Re-type your Password" required /><br />
        <br />
        <input type="submit" value="Submit" />
      </fieldset>
    </Form>

  </div>
</div>

<?php include 'footer.php'; ?>
