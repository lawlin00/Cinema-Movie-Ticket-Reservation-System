<?php
  ob_start();
  include("header.php");
  $buffer=ob_get_contents();
  ob_end_clean();

  $buffer=str_replace("%title%","User Profile",$buffer);
  echo $buffer;
  include 'Layout3.php';
  include 'conn.php';
  $id = $_SESSION['user'];
  $sql = "SELECT * From member Where AccUsername = '$id'";
  $result = mysqli_query($conn,$sql);
  //var_dump($sql);

  if ($rows = mysqli_fetch_array($result)){
    $AccID = $rows['AccID'];
    $Name = $rows['MemberName'];
    $Email = $rows['MemberEmail'];
    $Contact = $rows['MemberContact'];
    $IC = $rows['MemberIC'];
    $Dob =$rows['MemberDob'];
    $Gender =$rows['MemberGender'];
    $Username =$rows['AccUsername'];
    $Psw =$rows['AccPsw'];
    $Role =$rows['UserRole'];
  }
  else {
    echo "<script>alert('No data from database! Technical errors!');</script>";
    //die ("<script>window.location.href='Hall.php';</script>");
  }


  ?>


  <h1 class="h1title">User Profile</h1>

<div class="container">
<div class="w3le-reg2">
  <form action="updateaccount.php" method="post">
  <div class="mragilemain">

    <table class="OrderDetails">
        <input class="PaymentMethod" name="id" type="hidden" value="<?php echo $AccID;?>" readonly/>
        <input  class="PaymentMethod" name="role" type="hidden" value="<?php echo $Role;?>" placeholder = "Email"/>
      <tr>
        <th colspan="3" class="PaymentDetails" style="border:0px;">Basic Information</th>
      </tr>
      <tr>
        <th class="OrderDetails">Full Name</th>
        <th class="OrderDetails">: </th>
        <td class="OrderDetails"><input class="PaymentMethod" name="name" type="text" value="<?php echo $Name;?>" required/></td>
      </tr>
      <tr>
        <th class="OrderDetails">Email Address </th>
        <th class="OrderDetails">: </th>
        <td class="OrderDetails"><input class="PaymentMethod" name="email" type="email" value="<?php echo $Email;?>" required/></td>
      </tr>
      <tr>
        <th class="OrderDetails">Contact Number </th>
        <th class="OrderDetails">: </th>
        <td class="OrderDetails"><input class="PaymentMethod" name="contact" type="text" value="<?php echo $Contact;?>" required/></td>
      </tr>
      <tr>
        <th class="OrderDetails">New IC Number </th>
        <th class="OrderDetails">: </th>
        <td class="OrderDetails"><input class="PaymentMethod" name="ic" type="number"  value="<?php echo $IC;?>" required/></td>
      </tr>
      <tr>
        <th class="OrderDetails">Date of Birth </th>
        <th class="OrderDetails">: </th>
        <td class="OrderDetails"><input class="PaymentMethod3" name="dob" type="date"  value="<?php echo $Dob;?>" required/></td>
      </tr>
      <tr>
        <th class="OrderDetails">Gender </th>
        <th class="OrderDetails">: </th>
        <td class="OrderDetails">
          <select name="gender" class="cmbpaymentmethod">
            <option value="Male" <?php if($Gender == "Male"){echo "selected";}?>>Male</option>
            <<option value="Female" <?php if($Gender == "Female"){echo "selected";}?>>Female</option>
          </select>
      </tr>
    </table>
  </div>

      <div class="PaymentMethod">
        <table class="PaymentDetails2">
          <tr>
            <th colspan="3" class="PaymentDetails">Login Details</th>
          </tr>
          <tr>
            <th class="PaymentDetails1">Userame </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails1"><input class="PaymentMethod" name="username" type="text" placeholder="Name" value="<?php echo $Username;?>" required/></td>
          </tr>
          <tr>
            <th class="PaymentDetails1">Change Password </th>
            <th class="PaymentDetails1">: </th>
            <td class="PaymentDetails1"><input  class="PaymentMethod" name="psw" type="text"  placeholder = "Change Password" /></td>
          </tr>

          </table>
      </div>
      <center>
      <button class="comfirm" value="submit" >Save</button>
      </center>
    </form>

</div>
</div>
<?php include 'footer.php'; ?>
