<?php
    ob_start();
    include ("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer = str_replace ("%title%", "MoneyManager - Edit Budget", $buffer);
    echo $buffer;
    include 'Layout6.php';

    include "conn.php";
    $budgetplan = '1';
    $sql = "SELECT * from budget where BudgetPlanID = '$budgetplan'";
    $result = mysqli_query($conn, $sql);
    $amountSQL = "SELECT BudgetAmount from budget where BudgetPlanID = '$budgetplan'";
    $amountRESULT = mysqli_query($conn, $amountSQL);
    $rowcount = mysqli_num_rows($amountRESULT);
    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_array($result);
      }

    function callcategory(){
        include "conn.php";
        $budgetplan = '1';
        $CategoryIncomeSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$budgetplan' AND CategoryType = 'Income' AND CategoryStatus = '0' Order BY CategoryName asc;";
        $CategoryIncomeResult = mysqli_query($conn,$CategoryIncomeSQL);
        $CategoryExpensesSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$budgetplan' AND CategoryType = 'Expenses' AND CategoryStatus = '0' Order BY CategoryName asc;";
        $CategoryExpensesResult = mysqli_query($conn,$CategoryExpensesSQL);
        if (mysqli_num_rows($CategoryIncomeResult)<=0 && mysqli_num_rows($CategoryExpensesResult)<=0 ){
            echo "<script>alert('No Category Data, Please Add Category.')</script>";
        }else {
            echo "<optgroup label='Income' >";
            while ($CategoryIncomeRows = mysqli_fetch_array($CategoryIncomeResult)) {
            $DBInCategoryID =  $CategoryIncomeRows['CategoryID'];
            $DBInCategoryType =  $CategoryIncomeRows['CategoryType'];
            $DBInCategoryName =  $CategoryIncomeRows['CategoryName'];
            echo "<option value='$DBInCategoryID'>$DBInCategoryName</option>";
            }
            echo "<optgroup label='Expenses' >";
            while ($CategoryExpensesRows = mysqli_fetch_array($CategoryExpensesResult)) {
            $DBExCategoryID =  $CategoryExpensesRows['CategoryID'];
            $DBExCategoryType =  $CategoryExpensesRows['CategoryType'];
            $DBExCategoryName =  $CategoryExpensesRows['CategoryName'];
            echo "<option value='$DBExCategoryID'>$DBExCategoryName</option>";
            }
        }
    }
?>

<div class="d-flex justify-content-center">
  <div class="form-custom w-75 p-3">
  <form action="EditBudget_function.php" id="insert_form" method="post" name="newbudgetform">

    <div class="form-group row">
        <div class="col-md-12"><label for="month">Month</label></div>
        <div class="col-md-4"><input type="month" class="form-control form-control-lg" name="month" id="month" value="<?php if(!empty($row['BudgetMonth'])){echo $row['BudgetMonth'];}?>" required></div>
    </div>

    <div class="form-group row">
        <div class="col-md-12"><label for="type">Type</label></div>
        <div class="col-md-4"><select class="form-control form-control-lg" id="type" name="type" required>
        <option <?php if($row['BudgetType'] == 'Income'){echo"selected='selected'";}?>>Income</option>
        <option <?php if($row['BudgetType'] == 'Expenses'){echo"selected='selected'";}?>>Expenses</option>
        </select></div>
    </div>

    <div name="table" id="table">
        <div class="form-group row">
            <div class="col-md-3 text-center"><label for="category">Category</label></div>
            <div class="col-md-4 text-center"><label for="amount">Amount</label></div>
            <div class="col-md-4 text-center"><label for="desc">Description</label></div>
        </div>

        <div class="form-group row">
            <?php
                if ($rowcount<=0){
                    echo "<div class='col-md-12'><p>No budget is set.</p></div>";
                }else{
                    for ($i = 0; $i < $rowcount; $i++){
                        echo "<div class='col-md-3'>";
                        echo "<select class='form-control form-control-lg' id='category[]' name='category[]' required>";
                        include "conn.php";
                        $budgetplan = '1';
                        $CategoryIncomeSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$budgetplan' AND CategoryType = 'Income' AND CategoryStatus = '0' Order BY CategoryName asc;";
                        $CategoryIncomeResult = mysqli_query($conn,$CategoryIncomeSQL);
                        $CategoryExpensesSQL = "SELECT * FROM Category WHERE BudgetPlanID = '$budgetplan' AND CategoryType = 'Expenses' AND CategoryStatus = '0' Order BY CategoryName asc;";
                        $CategoryExpensesResult = mysqli_query($conn,$CategoryExpensesSQL);
                        if (mysqli_num_rows($CategoryIncomeResult)<=0 && mysqli_num_rows($CategoryExpensesResult)<=0 ){
                            echo "<script>alert('No Category Data, Please Add Category.')</script>";
                        }else {
                            echo "<optgroup label='Income' >";
                            while ($CategoryIncomeRows = mysqli_fetch_array($CategoryIncomeResult)) {
                            $DBInCategoryID =  $CategoryIncomeRows['CategoryID'];
                            $DBInCategoryType =  $CategoryIncomeRows['CategoryType'];
                            $DBInCategoryName =  $CategoryIncomeRows['CategoryName'];
                            echo "<option value='$DBInCategoryID'>$DBInCategoryName</option>";
                            }
                            echo "<optgroup label='Expenses' >";
                            while ($CategoryExpensesRows = mysqli_fetch_array($CategoryExpensesResult)) {
                            $DBExCategoryID =  $CategoryExpensesRows['CategoryID'];
                            $DBExCategoryType =  $CategoryExpensesRows['CategoryType'];
                            $DBExCategoryName =  $CategoryExpensesRows['CategoryName'];
                            echo "<option value='$DBExCategoryID'>$DBExCategoryName</option>";
                            }
                        }
                        if ($DBExCategoryID != $CategoryID){
                            echo"<option value='$DBExCategoryID'>$DBExCategoryName</option>";
                        }else{
                            echo "<option value='$DBInCategoryID' selected>$DBExCategoryName</option>";
                        }
                        echo "</select></div>";

                        echo "<div class='col-md-4'><input type='number' class='form-control form-control-lg' name='amount[]' id='amount[]' value='".$row['BudgetAmount']."' required></div>";

                        echo "<div class='col-md-4'><input type='text' class='form-control form-control-lg' name='desc[]' id='desc[]' value='".$row['BudgetDesc']."' required></div>";

                        echo "<div class='col-md-1'><button type='button' name='addline' id='addline' class='btn btn-success btn-sm add' aria-label='Left Align'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button></div>";
                    }
                }
            ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12 text-center"><button type="submit" name="save" id="save" class="btn btn-primary">Save</button></div>
    </div>

    </form>
  </div>
</div>

<?php include 'footer.php' ?>

<script>
$(document).ready(function(){

 $(document).on('click', '.add', function(){
  var html = '';
  html += '<div class="form-group row">';
  html += '<div class="col-md-3"><select class="form-control form-control-lg" id="category[]" name="category[]" required><?php callcategory(); ?></select></div>';
  html += '<div class="col-md-4"><input type="number" class="form-control form-control-lg" name="amount[]" id="amount[]" placeholder="Amount" required></div>';
  html += '<div class="col-md-4"><input type="text" class="form-control form-control-lg" name="desc[]" id="desc[]" placeholder="Description" required></div></div>';
  //html += '<div class="col-md-1><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></div></div>';
  $('#table').append(html);
 });

 $(document).on('click', '.remove', function(){
  $(this).closest('div class="form-group row"').remove();
 });

 $('#insert_form').on('add', function(event){
  event.preventDefault();
  var error = '';
  $('.category').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select category at "+count+"</p>";
    return false;
   }
   count = count + 1;
  });

  $('.amount').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Budget Amount at "+count+"</p>";
    return false;
   }
   count = count + 1;
  });

  $('.desc').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Budget Description at "+count+"</p>";
    return false;
   }
   count = count + 1;
  });
  var form_data = $(this).serialize();
  if(error == '')
  {
   $.ajax({
    url:"InsertNewBudget_function.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     if(data == 'ok')
     {
      $('#table').find("tr:gt(0)").remove();
      $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
     }
    }
   });
  }
  else
  {
   $('#error').html('<div class="alert alert-danger">'+error+'</div>');
  }
 });

});
</script>
